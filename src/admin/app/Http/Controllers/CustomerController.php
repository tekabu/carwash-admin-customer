<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\User;

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
            'points' => 0,
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
}
