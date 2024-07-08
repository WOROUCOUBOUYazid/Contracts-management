<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $contract_id)
    {
        return view('tasks.index', [
            'tasks' => Task::where('contract_id', intval($contract_id))->get(),
            'contract' => Contract::where('id',  intval($contract_id))->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $contract_id)
    {
        return view('tasks.create', [
            'contract' => Contract::where('id',  intval($contract_id))->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'end_date' => 'required|date',
            'contract_id' => 'required|integer'
        ]);


        $task = Task::create([
            'name' => $validator['name'],
            'description' => $validator['description'],
            'end_date' => $validator['end_date'],
            'start_date' => Carbon::now()->toDateString(),
            'status' => false,
            'contract_id' => $validator['contract_id'],
        ]);

        return redirect('/contracts/'.$validator['contract_id'].'/tasks');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
