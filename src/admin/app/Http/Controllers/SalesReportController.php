<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class SalesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')
            ->get();

        return view('sales_reports.sales_reports_table', [
            'table' => $transactions,
            'route' => 'sales-reports',
        ]);
    }
}
