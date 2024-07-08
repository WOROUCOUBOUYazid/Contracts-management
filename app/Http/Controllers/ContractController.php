<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contracts.index', [
            'contracts' => Contract::all(),
            'serviceProviders' => ServiceProvider::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contracts.create', [
           'serviceProviders' => ServiceProvider::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        if ($request->hasFile('file')) {
         $file = $request->file("file")->store(options: 'contracts');
         $request->status = "active";
        } else {
            $request->status = "unsigned";
        }

        $request->end_date = Carbon::parse($request->start_date)->addMonths(6)->format('Y-m-d');

        $contract = Contract::create([
            'title' => $request->title,
            'object' => $request->object,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'functions' => $request->functions,
            'earnings' => $request->earnings,
            'salary' => $request->salary,
            'status' => $request->status,
            'file' => $file ?? null,
            'service_provider_id' => $request->service_provider_id,
        ]);

        return redirect(route('contracts.index', absolute: false));
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
    public function edit(string $id)
    {
        return view('contracts.edit', [
            'contract' => Contract::findOrFail(intval($id)),
            'serviceProviders' => ServiceProvider::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contract = Contract::findOrFail(intval($id));

        if ($request->hasFile('file')) {
            if ($contract->file) {
                Storage::delete($contract->file);
            }
            $file = $request->file("file")->store(options: 'contracts');
            $request->status = "active";
        } else {
            $request->status = "unsigned";
        }

        $contract->update([
            'title' => $request->title,
            'object' => $request->object,
            'start_date' => $request->start_date,
            'functions' => $request->functions,
            'earnings' => $request->earnings,
            'salary' => $request->salary,
            'status' => $request->status,
            'file' => $file ?? null,
            'service_provider_id' => $request->service_provider_id,
        ]);

        return redirect(route('contracts.index', absolute: false));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect(route('contracts.index', absolute: false));
    }

    public function showPdf() {
        return view('contracts.pdf', [
            'contract' => Contract::findOrFail(1),
        ]);
    }

    public function download(string $id) {
        ini_set('max_execution_time', '300');
        // dd(intval($id));
        $contract = Contract::findOrFail(intval($id));
        // if($contract->file) {
        //     return response()->file( Storage::disk('contracts')->url($contract->file));

        // } else {
            $pdf = PDF::loadView('contracts.pdf', ['contract' => $contract]);

            return $pdf->download();
            // return $pdf->stream();
        // }
        // $pdf = PDF::loadView('contracts.pdf', ['contract' => $contract]);

        // return $pdf->download();
        // return $pdf->stream();
    }
}
