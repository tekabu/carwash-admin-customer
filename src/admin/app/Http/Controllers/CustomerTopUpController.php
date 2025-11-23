<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerTopUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerTopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topUps = CustomerTopUp::with('customer')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer_top_ups.customer_top_ups_table', [
            'table' => $topUps,
            'route' => 'customer-top-ups',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view = view('customer_top_ups.customer_top_ups_entry', [
            'route' => 'customer-top-ups',
            'customers' => Customer::all(),
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
            'customer_id' => 'required|exists:customers,id',
            'proof_of_payment' => 'required|file|mimes:jpeg,jpg,png,pdf',
            'status' => 'nullable|in:Pending,Approved,Disapproved',
            'remarks' => 'nullable|string|max:500',
        ]);

        if ($validator->fails())
        {
            $errorMessage = $validator->errors()->first();

            $response = [
                'status' => false,
                'message' => $errorMessage,
            ];

            return response()->json($response, 400);
        }

        $proofPath = $request->file('proof_of_payment')->store('customer-top-ups');

        $topUp = CustomerTopUp::create([
            'customer_id' => $request->customer_id,
            'proof_of_payment' => $proofPath,
            'status' => $request->status ?? 'Pending',
            'remarks' => $request->remarks,
        ]);

        $topUp->load('customer');

        return response()->json([
            'status' => true,
            'message' => 'Top-up request recorded successfully.',
            'data' => $topUp,
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
    public function edit(CustomerTopUp $customerTopUp)
    {
        $view = view('customer_top_ups.customer_top_ups_entry', [
            'route' => 'customer-top-ups',
            'row' => $customerTopUp,
            'customers' => Customer::all(),
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
    public function update(Request $request, CustomerTopUp $customerTopUp)
    {
        $validator = Validator::make($request->all(),
        [
            'customer_id' => 'required|exists:customers,id',
            'proof_of_payment' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'status' => 'required|in:Pending,Approved,Disapproved',
            'remarks' => 'nullable|string|max:500',
        ]);

        if ($validator->fails())
        {
            $errorMessage = $validator->errors()->first();

            $response = [
                'status' => false,
                'message' => $errorMessage,
            ];

            return response()->json($response, 400);
        }

        if ($request->hasFile('proof_of_payment')) {
            $proofPath = $request->file('proof_of_payment')->store('customer-top-ups');

            if ($customerTopUp->proof_of_payment) {
                Storage::delete($customerTopUp->proof_of_payment);
            }

            $customerTopUp->proof_of_payment = $proofPath;
        }

        $customerTopUp->customer_id = $request->customer_id;
        $customerTopUp->status = $request->status;
        $customerTopUp->remarks = $request->remarks;
        $customerTopUp->save();
        $customerTopUp->load('customer');

        return response()->json([
            'status' => true,
            'message' => 'Top-up request updated successfully.',
            'data' => $customerTopUp,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerTopUp $customerTopUp)
    {
        if ($customerTopUp->proof_of_payment) {
            Storage::delete($customerTopUp->proof_of_payment);
        }

        $customerTopUp->delete();

        return response()->json([
            'status' => true,
            'message' => 'Top-up request deleted successfully.',
        ]);
    }
}
