<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\User;
use App\Models\Checkout;
use App\Models\VehicleType;
use App\Models\SoapType;
use App\Models\Transaction;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with('user')
        ->get();

        return view('customers.customers_table', [
            'table' => $customers,
            'route' => 'customers',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view = view('customers.customers_entry', [
            'route' => 'customers',
        ])
        ->render();

        return response()->json([
            'status' => true,
            'html' => $view,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'rfid' => 'nullable|string|max:255|unique:customers,rfid',
        ]);

        if ($validator->fails()) 
        {
            $errorMessage = $validator->errors()->first();
            
            $response = [
                "status" => false,
                "message" => $errorMessage
            ];
            
            return response()->json($response, 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'customer',
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'address' => $request->address,
            'name' => $request->name,
            'email' => $request->email,
            'rfid' => $request->rfid,
            'balance' => 0,
            'points' => 0.0,
        ]);

        $customer->refresh();

        return response()->json([
            'status' => true,
            'message' => 'Customer created successfully.',
            'data' => $customer,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $view = view('customers.customers_entry', [
            'route' => 'customers',
            'row' => $customer,
        ])
        ->render();

        return response()->json([
            'status' => true,
            'html' => $view,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $customer->user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'rfid' => 'nullable|string|max:255|unique:customers,rfid,' . $customer->id,
        ]);

        if ($validator->fails()) 
        {
            $errorMessage = $validator->errors()->first();
            
            $response = [
                "status" => false,
                "message" => $errorMessage
            ];
            
            return response()->json($response, 400);
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->rfid = $request->rfid;
        $customer->save();

        $customer->user->name = $request->name;
        $customer->user->email = $request->email;

        if (!empty($request->password)) {
            $customer->user->password = Hash::make($request->password);
        }
        
        $customer->user->save();

        $customer->refresh();

        return response()->json([
            'status' => true,
            'message' => 'Customer updated successfully.',
            'data' => $customer,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Customer deleted successfully.'
        ]);
    }

    /**
     * Show the form for adding balance.
     */
    public function showAddBalanceForm(Customer $customer)
    {
        $view = view('customers.customers_add_balance', [
            'route' => 'customers',
            'row' => $customer,
        ])
        ->render();

        return response()->json([
            'status' => true,
            'html' => $view,
        ]);
    }

    /**
     * Add balance to customer.
     */
    public function addBalance(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(),
        [
            'amount' => 'required|numeric|not_in:0',
        ]);

        if ($validator->fails())
        {
            $errorMessage = $validator->errors()->first();

            $response = [
                "status" => false,
                "message" => $errorMessage
            ];

            return response()->json($response, 400);
        }

        $currentBalance = $customer->balance ?? 0;
        $newBalance = $currentBalance + $request->amount;

        // Check if the new balance would be negative
        if ($newBalance < 0)
        {
            return response()->json([
                'status' => false,
                'message' => 'Insufficient balance. Current balance is ' . number_format($currentBalance, 2) . '. Cannot subtract ' . number_format(abs($request->amount), 2) . '.',
            ], 400);
        }

        $customer->balance = $newBalance;
        $customer->save();

        $message = $request->amount > 0
            ? 'Balance added successfully.'
            : 'Balance deducted successfully.';

        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $customer,
        ]);
    }

    /**
     * Check if a customer exists using RFID.
     */
    public function checkCustomerByRfid($rfid)
    {
        if (empty($rfid)) {
            return response()->json([
                'status' => false,
                'message' => 'RFID is required.',
            ], 400);
        }

        $customer = Customer::where('rfid', $rfid)->first();

        if ($customer) {
            return response()->json([
                'status' => true,
                'message' => 'Customer found.',
                'data' => [
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'phone' => $customer->phone,
                    'rfid' => $customer->rfid,
                    'balance' => $customer->balance,
                    'points' => $customer->points,
                ],
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Customer not found.',
        ], 404);
    }

    /**
     * Check if customer balance is sufficient for cart amount.
     */
    public function checkBalance(Request $request, Customer $customer)
    {
        $cartAmount = $request->input('cart_amount');

        if (empty($cartAmount) && $cartAmount !== 0 && $cartAmount !== '0') {
            return response()->json([
                'status' => false,
                'message' => 'Cart amount is required.',
            ], 400);
        }

        if (!is_numeric($cartAmount)) {
            return response()->json([
                'status' => false,
                'message' => 'Cart amount must be a valid number.',
            ], 400);
        }

        $balance = $customer->balance ?? 0;
        $isSufficient = $balance >= $cartAmount;

        return response()->json([
            'status' => true,
            'message' => $isSufficient ? 'Balance is sufficient.' : 'Insufficient balance.',
            'data' => [
                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
                'balance' => $balance,
                'cart_amount' => (float) $cartAmount,
                'is_sufficient' => $isSufficient,
                'shortfall' => $isSufficient ? 0 : $cartAmount - $balance,
            ],
        ], 200);
    }

    /**
     * Redeem all customer points and convert to balance.
     */
    public function redeemPoints(Customer $customer)
    {
        $points = (float) ($customer->points ?? 0);

        if ($points <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'No points available to redeem.',
            ], 400);
        }

        // Get conversion ratio from .env (default to 1:1)
        $conversionRatio = (int) env('POINTS_TO_BALANCE_RATIO', 1);

        // Convert points to balance using whole numbers only
        $balanceToAdd = floor($points / $conversionRatio);

        if ($balanceToAdd <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'Insufficient points for conversion. Need at least ' . $conversionRatio . ' points.',
            ], 400);
        }

        $oldBalance = $customer->balance ?? 0;
        $oldPoints = $customer->points;

        // Calculate points used and remaining points
        $pointsUsed = round($balanceToAdd * $conversionRatio, 4);
        $remainingPoints = round($oldPoints - $pointsUsed, 4);

        // Update customer
        $customer->balance = $oldBalance + $balanceToAdd;
        $customer->points = $remainingPoints;
        $customer->save();

        return response()->json([
            'status' => true,
            'message' => 'Points redeemed successfully.',
            'data' => [
                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
                'points_redeemed' => $pointsUsed,
                'balance_added' => $balanceToAdd,
                'old_balance' => $oldBalance,
                'new_balance' => $customer->balance,
                'old_points' => $oldPoints,
                'new_points' => $customer->points,
                'remaining_points' => $remainingPoints,
                'conversion_ratio' => $conversionRatio,
            ],
        ], 200);
    }

    /**
     * Create a checkout transaction for the customer.
     */
    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'soap_type_id' => 'required|exists:soap_types,id',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();

            return response()->json([
                'status' => false,
                'message' => $errorMessage,
            ], 400);
        }

        $customer = null;

        if ($request->filled('customer_id')) {
            $customer = Customer::find($request->customer_id);

            if (!$customer) {
                return response()->json([
                    'status' => false,
                    'message' => 'Customer not found.',
                ], 404);
            }
        }

        $vehicleType = VehicleType::find($request->vehicle_type_id);
        $soapType = SoapType::find($request->soap_type_id);

        if (!$vehicleType || !$soapType) {
            return response()->json([
                'status' => false,
                'message' => 'Unable to determine service pricing.',
            ], 404);
        }

        $totalAmount = round((float) $vehicleType->amount + (float) $soapType->amount, 2);

        // Get ratio from .env
        $ratio = (int) env('POINTS_TO_BALANCE_RATIO', 1);

        // Calculate points: points = total_amount * ratio
        $points = round($totalAmount / $ratio, 4);

        $paymentType = $customer ? 'BALANCE DEDUCTION' : 'CASH';

        // Create checkout record
        $reference = (string) Str::orderedUuid();
        $checkout = Checkout::create([
            'customer_id' => $customer?->id,
            'reference' => $reference,
            'vehicle_type_id' => $request->vehicle_type_id,
            'soap_type_id' => $request->soap_type_id,
            'total_amount' => $totalAmount,
            'payment_type' => $paymentType,
            'payment_status' => 'PENDING',
            'points' => $points,
            'ratio' => $ratio,
        ]);

        // Load relationships
        $checkout->load(['vehicleType', 'soapType']);

        return response()->json([
            'status' => true,
            'message' => 'Checkout created successfully.',
            'data' => [
                'checkout_id' => $checkout->id,
                'customer_id' => $customer?->id,
                'customer_name' => $customer?->name,
                'reference' => $checkout->reference,
                'vehicle_type_id' => $checkout->vehicle_type_id,
                'vehicle_type' => $checkout->vehicleType?->vehicle_type,
                'soap_type_id' => $checkout->soap_type_id,
                'soap_type' => $checkout->soapType?->soap_type,
                'total_amount' => $checkout->total_amount,
                'payment_type' => $checkout->payment_type,
                'payment_status' => $checkout->payment_status,
                'points' => $checkout->points,
                'ratio' => $checkout->ratio,
                'created_at' => $checkout->created_at,
            ],
        ], 201);
    }

    /**
     * Finalize the checkout once payment provider confirms success.
     */
    public function checkoutSuccess(string $reference)
    {
        $checkout = Checkout::with(['customer', 'vehicleType', 'soapType'])
            ->where('reference', $reference)
            ->first();

        if (!$checkout) {
            return response()->json([
                'status' => false,
                'message' => 'Checkout reference not found.',
            ], 404);
        }

        if ($checkout->payment_status === 'DONE') {
            return response()->json([
                'status' => false,
                'message' => 'Checkout already completed.',
            ], 409);
        }

        $transaction = DB::transaction(function () use ($checkout) {
            $checkout->payment_status = 'DONE';
            $checkout->save();

            $customer = $checkout->customer;

            if ($customer) {
                $currentPoints = (float) ($customer->points ?? 0);
                $customer->points = round($currentPoints + (float) ($checkout->points ?? 0), 4);
                $customer->save();
            }

            return Transaction::create([
                'is_guest' => $checkout->customer_id ? 0 : 1,
                'customer_id' => $checkout->customer_id,
                'vehicle_type_id' => $checkout->vehicle_type_id,
                'soap_type_id' => $checkout->soap_type_id,
            ]);
        });

        $checkout->refresh()->load(['customer', 'vehicleType', 'soapType']);

        return response()->json([
            'status' => true,
            'message' => 'Checkout completed successfully.',
            'data' => [
                'checkout_id' => $checkout->id,
                'reference' => $checkout->reference,
                'payment_status' => $checkout->payment_status,
                'points_awarded' => $checkout->points,
                'transaction_id' => $transaction->id,
                'is_guest' => $transaction->is_guest,
                'customer_id' => $checkout->customer?->id,
                'customer_name' => $checkout->customer?->name,
                'customer_points' => $checkout->customer?->points,
                'vehicle_type_id' => $checkout->vehicle_type_id,
                'vehicle_type' => $checkout->vehicleType?->vehicle_type,
                'soap_type_id' => $checkout->soap_type_id,
                'soap_type' => $checkout->soapType?->soap_type,
                'completed_at' => $checkout->updated_at,
            ],
        ], 200);
    }
}
