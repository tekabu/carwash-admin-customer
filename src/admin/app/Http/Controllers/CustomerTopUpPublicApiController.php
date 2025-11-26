<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerTopUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerTopUpPublicApiController extends Controller
{
    /**
     * Store a top-up request on behalf of an unauthenticated third-party client.
     */
    public function store(Customer $customer, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'proof_of_payment' => 'required|file|mimes:jpeg,jpg,png,pdf',
            'top_up_amount' => 'required|numeric|min:0.01',
            'status' => 'nullable|in:Pending,Approved,Disapproved',
            'remarks' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $proofPath = $request->file('proof_of_payment')->store('customer/top-ups', 'public');
        $status = $request->status ?? 'Pending';

        $topUp = CustomerTopUp::create([
            'customer_id' => $customer->id,
            'proof_of_payment' => $proofPath,
            'top_up_amount' => $request->top_up_amount,
            'status' => $status,
            'remarks' => $request->remarks,
        ]);

        if ($status === 'Approved') {
            $topUp->creditCustomerBalance();
        }

        $topUp->load('customer');

        return response()->json([
            'status' => true,
            'message' => 'Top-up request recorded successfully.',
            'data' => $topUp,
        ], 201);
    }
}
