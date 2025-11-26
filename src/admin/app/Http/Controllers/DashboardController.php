<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Customer;
use App\Models\User;
use App\Models\Transaction;
use App\Models\SoapType;
use App\Models\VehicleType;

class DashboardController extends Controller
{
    public function index()
    {
        $customersCount = Customer::count();
        $usersCount = User::where('type', 'admin')->count();
        $transactionsCount = Transaction::count();

        // Get monthly transactions for current year
        $currentYear = date('Y');
        $monthlyTransactions = Transaction::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Fill in missing months with 0
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = $monthlyTransactions[$i] ?? 0;
        }

        // Get soap type demographics
        $soapTypeDemographics = Transaction::select('soap_types.soap_type', DB::raw('COUNT(*) as count'))
            ->join('soap_types', 'transactions.soap_type_id', '=', 'soap_types.id')
            ->groupBy('soap_types.id', 'soap_types.soap_type')
            ->get()
            ->map(function($item) {
                return [
                    'name' => $item->soap_type,
                    'value' => $item->count
                ];
            });

        // Get vehicle type demographics
        $vehicleTypeDemographics = Transaction::select('vehicle_types.vehicle_type', DB::raw('COUNT(*) as count'))
            ->join('vehicle_types', 'transactions.vehicle_type_id', '=', 'vehicle_types.id')
            ->groupBy('vehicle_types.id', 'vehicle_types.vehicle_type')
            ->get()
            ->map(function($item) {
                return [
                    'name' => $item->vehicle_type,
                    'value' => $item->count
                ];
            });

        // Get guest vs customer demographics
        $guestDemographics = Transaction::selectRaw('is_guest, COUNT(*) as count')
            ->groupBy('is_guest')
            ->get()
            ->map(function($item) {
                return [
                    'name' => $item->is_guest ? 'Guest' : 'Customer',
                    'value' => $item->count
                ];
            });

        return view('dashboard', [
            'customersCount' => $customersCount,
            'usersCount' => $usersCount,
            'transactionsCount' => $transactionsCount,
            'monthlyData' => $monthlyData,
            'currentYear' => $currentYear,
            'soapTypeDemographics' => $soapTypeDemographics,
            'vehicleTypeDemographics' => $vehicleTypeDemographics,
            'guestDemographics' => $guestDemographics,
        ]);
    }
}
