<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\VehicleType;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicleTypes = VehicleType::all();

        return view('vehicle_types.vehicle_types_table', [
            'table' => $vehicleTypes,
            'route' => 'vehicle-types',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view = view('vehicle_types.vehicle_types_entry', [
            'route' => 'vehicle-types',
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
            'vehicle_type' => 'required|string|max:255|unique:vehicle_types,vehicle_type',
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

        $vehicleType = VehicleType::create([
            'vehicle_type' => $request->vehicle_type,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Vehicle type created successfully.',
            'data' => $vehicleType,
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
    public function edit(VehicleType $vehicleType)
    {
        $view = view('vehicle_types.vehicle_types_entry', [
            'route' => 'vehicle-types',
            'row' => $vehicleType,
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
    public function update(Request $request, VehicleType $vehicleType)
    {
        $validator = Validator::make($request->all(),
        [
            'vehicle_type' => 'required|string|max:255|unique:vehicle_types,vehicle_type,' . $vehicleType->id,
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

        $vehicleType->vehicle_type = $request->vehicle_type;
        $vehicleType->save();

        return response()->json([
            'status' => true,
            'message' => 'Vehicle type updated successfully.',
            'data' => $vehicleType,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleType $vehicleType)
    {
        $vehicleType->delete();

        return response()->json([
            'status' => true,
            'message' => 'Vehicle type deleted successfully.'
        ]);
    }
}
