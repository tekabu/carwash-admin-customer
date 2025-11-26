<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypePublicApiController extends Controller
{
    /**
     * Display a listing of all vehicle types for public API consumption.
     */
    public function index()
    {
        $vehicleTypes = VehicleType::select('id', 'vehicle_type', 'sub_title', 'image_url', 'amount')
            ->orderBy('amount', 'asc')
            ->get()
            ->makeHidden(['action_edit_url', 'action_update_url', 'action_delete_url', 'action_options'])
            ->map(function ($vehicleType) {
                $vehicleType->image_url = $vehicleType->image_url
                    ? url('storage/' . $vehicleType->image_url)
                    : null;
                return $vehicleType;
            });

        return response()->json([
            'status' => true,
            'message' => 'Vehicle types retrieved successfully.',
            'data' => $vehicleTypes,
        ], 200);
    }
}
