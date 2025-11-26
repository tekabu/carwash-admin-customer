<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\SoapType;

class SoapTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $soapTypes = SoapType::all();

        return view('soap_types.soap_types_table', [
            'table' => $soapTypes,
            'route' => 'soap-types',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view = view('soap_types.soap_types_entry', [
            'route' => 'soap-types',
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
            'soap_type' => 'required|string|max:255|unique:soap_types,soap_type',
            'sub_title' => 'nullable|string|max:500',
            'image_url' => 'nullable|file|mimes:jpeg,jpg,png',
            'amount' => 'required|numeric|min:0',
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

        $imagePath = null;
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('soap-types', 'public');
        }

        $soapType = SoapType::create([
            'soap_type' => $request->soap_type,
            'sub_title' => $request->sub_title,
            'image_url' => $imagePath,
            'amount' => $request->amount,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Soap type created successfully.',
            'data' => $soapType,
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
    public function edit(SoapType $soapType)
    {
        $view = view('soap_types.soap_types_entry', [
            'route' => 'soap-types',
            'row' => $soapType,
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
    public function update(Request $request, SoapType $soapType)
    {
        $validator = Validator::make($request->all(),
        [
            'soap_type' => 'required|string|max:255|unique:soap_types,soap_type,' . $soapType->id,
            'sub_title' => 'nullable|string|max:500',
            'image_url' => 'nullable|file|mimes:jpeg,jpg,png',
            'amount' => 'required|numeric|min:0',
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

        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('soap-types', 'public');

            if ($soapType->image_url) {
                Storage::disk('public')->delete($soapType->image_url);
            }

            $soapType->image_url = $imagePath;
        }

        $soapType->soap_type = $request->soap_type;
        $soapType->sub_title = $request->sub_title;
        $soapType->amount = $request->amount;
        $soapType->save();

        return response()->json([
            'status' => true,
            'message' => 'Soap type updated successfully.',
            'data' => $soapType,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoapType $soapType)
    {
        $checkoutCount = \App\Models\Checkout::where('soap_type_id', $soapType->id)->count();
        $transactionCount = \App\Models\Transaction::where('soap_type_id', $soapType->id)->count();

        if ($checkoutCount > 0 || $transactionCount > 0) {
            return response()->json([
                'status' => false,
                'message' => 'Cannot delete this soap type because it is being used in ' .
                    ($checkoutCount > 0 ? $checkoutCount . ' checkout(s)' : '') .
                    ($checkoutCount > 0 && $transactionCount > 0 ? ' and ' : '') .
                    ($transactionCount > 0 ? $transactionCount . ' transaction(s)' : '') . '.'
            ], 400);
        }

        if ($soapType->image_url) {
            Storage::disk('public')->delete($soapType->image_url);
        }

        $soapType->delete();

        return response()->json([
            'status' => true,
            'message' => 'Soap type deleted successfully.'
        ]);
    }
}
