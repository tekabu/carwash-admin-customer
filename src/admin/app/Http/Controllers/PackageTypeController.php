<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PackageType;

class PackageTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packageTypes = PackageType::all();

        return view('package_types.package_types_table', [
            'table' => $packageTypes,
            'route' => 'package-types',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view = view('package_types.package_types_entry', [
            'route' => 'package-types',
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
            'package_type' => 'required|string|max:255|unique:package_types,package_type',
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

        $packageType = PackageType::create([
            'package_type' => $request->package_type,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Package type created successfully.',
            'data' => $packageType,
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
    public function edit(PackageType $packageType)
    {
        $view = view('package_types.package_types_entry', [
            'route' => 'package-types',
            'row' => $packageType,
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
    public function update(Request $request, PackageType $packageType)
    {
        $validator = Validator::make($request->all(),
        [
            'package_type' => 'required|string|max:255|unique:package_types,package_type,' . $packageType->id,
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

        $packageType->package_type = $request->package_type;
        $packageType->save();

        return response()->json([
            'status' => true,
            'message' => 'Package type updated successfully.',
            'data' => $packageType,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageType $packageType)
    {
        $packageType->delete();

        return response()->json([
            'status' => true,
            'message' => 'Package type deleted successfully.'
        ]);
    }
}
