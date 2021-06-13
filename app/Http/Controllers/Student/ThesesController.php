<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Theses;
use Illuminate\Http\Request;

class ThesesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nim = auth()->user()->registration_number;
        $theses = Theses::getByStudentId($nim)->with(['student', 'scienceField'])->first();

        return viewStudent('theses.index', compact('theses'));
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
     * @param  \App\Models\Theses  $theses
     * @return \Illuminate\Http\Response
     */
    public function show(Theses $theses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theses  $theses
     * @return \Illuminate\Http\Response
     */
    public function edit(Theses $theses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Theses  $theses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theses $theses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Theses  $theses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theses $theses)
    {
        //
    }
}
