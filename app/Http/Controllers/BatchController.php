<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Department;
use Illuminate\Http\Request;

class BatchController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $batches = Batch::get();

        return view('batches.index', compact('batches'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function data(Batch $batch) {
        return [
            'batches' => $batch,
            'departments' => Department::where('status', 1)->get(['id', 'name'])
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('batches.create', $this->data(new Batch()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'year' => ['required'],
            'department_id' => ['required'],
            'inputState' => ['required']
        ]);

        $batch = Batch::create([
            'name' => $request->name,
            'year' => $request->year,
            'department_id' => $request->department_id,
            'status' => $request->inputState
        ]);

        return redirect()->route('batches.index')
            ->with('success','Batch created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function show(Batch $batch) {
        return view('batches.show', $this->data($batch));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function edit(Batch $batch) {
        return view('batches.edit',  $this->data($batch));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batch $batch) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'year' => ['required'],
            'department_id' => ['required'],
            'inputState' => ['required']
        ]);

        $batch->update([
            'name' => $request->name,
            'year' => $request->year,
            'department_id' => $request->department_id,
            'status' => $request->inputState
        ]);

        return redirect()->route('batches.index')
            ->with('success','Batch update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batch $batch) {
        $batch->delete();

        return redirect()->route('batches.index')
            ->with('success','Batch deleted successfully');
    }

    // API
    public function fetchBatch(Request $request) {
        $data['batches'] = Batch::where([
                ['status', 1],
                ['department_id', $request->department_id]
            ])->get(['id', 'name']);

        return response()->json($data);
    }
}
