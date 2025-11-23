<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with(['customer', 'vehicleType', 'packageType'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transactions.transactions_table', [
            'table' => $transactions,
            'route' => 'transactions',
        ]);
    }
}
