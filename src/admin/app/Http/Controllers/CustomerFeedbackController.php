<?php

namespace App\Http\Controllers;

use App\Models\CustomerFeedback;

class CustomerFeedbackController extends Controller
{
    /**
     * Display a listing of customer feedback messages.
     */
    public function index()
    {
        $feedbacks = CustomerFeedback::orderByDesc('created_at')->get();

        return view('customer_feedbacks.customer_feedbacks_table', [
            'table' => $feedbacks,
            'route' => 'customer-feedbacks',
        ]);
    }
}
