<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceProviders = User::where('role_id', 3)->get();
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
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'amount' => 'required|integer',
            'status' => 'required|string',
            'file' => 'nullable|file|max:10240',
            'serviceProvider_id' => 'required|exists:service_providers,id',
        ]);

        if ($validator->fails()) {
            return redirect('/contracts')->withErrors($validator)->withInput();
        }

        dd($errors->all());

        $contract = Contract::create([
            'title' => $request->title,
            'description' => $request->description,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'amount' => $request->amount,
            'status' => $request->status,
            'file' => $request->file,
            'serviceProvider_id' => $request->serviceProvider_id,
        ]);
        dd($contract);

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
