<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceProviders = ServiceProvider::all();
        $contracts = Contract::all();
        return view('manager.contracts', ['contracts' => $contracts, 'serviceProviders' => $serviceProviders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'amount' => 'required|integer',
            'status' => 'required|string',
            'file' => 'nullable|file|max:10240',
            'service_provider_id' => 'required|exists:service_providers,id',
        ]);

        if ($validator->fails()) {
            return redirect('/contracts')->withErrors($validator)->withInput();
        }

        //dd($errors->all());

        $contract = Contract::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'amount' => $request->amount,
            'status' => $request->status,
            'file' => $request->file,
            'service_provider_id' => $request->service_provider_id,
        ]);

        return redirect('/contracts');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
