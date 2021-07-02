<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nim = auth()->user()->registration_number;
        $thesis = Thesis::getByStudentId($nim)->with([
            'student', 'scienceField', 'firstSupervisor', 'secondSupervisor'
        ])->first();

        return viewStudent('thesis.index', compact('thesis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thesis  $theses
     * @return \Illuminate\Http\Response
     */
    public function show(Thesis $theses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thesis  $theses
     * @return \Illuminate\Http\Response
     */
    public function edit(Thesis $theses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thesis  $theses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thesis $theses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thesis  $theses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thesis $theses)
    {
        //
    }
}
