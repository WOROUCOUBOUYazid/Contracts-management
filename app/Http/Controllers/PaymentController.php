<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $contract_id)
    {
        return view('payments.index', [
            'payments' => Payment::where('contract_id', intval($contract_id))->get(),
            'contract' => Contract::where('id',  intval($contract_id))->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $contract_id)
    {
        return view('payments.create', [
            'contract' => Contract::where('id',  intval($contract_id))->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'amount' => 'required|string|max:255',
            'payment_date' => 'required|date',
            'contract_id' => 'required|integer'
        ]);

        $payment = Payment::create([
            'amount' => $validator['amount'],
            'payment_date' => $validator['payment_date'],
            'contract_id' => $validator['contract_id'],
        ]);

        return redirect('/contracts/'.$validator['contract_id'].'/payments');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
