<?php

namespace App\Http\Controllers;

use App\Models\SoapType;
use Illuminate\Http\Request;

class SoapTypePublicApiController extends Controller
{
    /**
     * Display a listing of all soap types for public API consumption.
     */
    public function index()
    {
        $soapTypes = SoapType::select('id', 'soap_type', 'sub_title', 'image_url', 'amount')
            ->orderBy('amount', 'asc')
            ->get()
            ->makeHidden(['action_edit_url', 'action_update_url', 'action_delete_url', 'action_options'])
            ->map(function ($soapType) {
                $soapType->image_url = $soapType->image_url
                    ? url('storage/' . $soapType->image_url)
                    : null;
                return $soapType;
            });

        return response()->json([
            'status' => true,
            'message' => 'Soap types retrieved successfully.',
            'data' => $soapTypes,
        ], 200);
    }
}
