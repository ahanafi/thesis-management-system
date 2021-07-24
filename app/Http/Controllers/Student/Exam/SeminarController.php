<?php

namespace App\Http\Controllers\Student\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeminarController extends Controller
{
    public function index()
    {
        return viewStudent('seminar.index');
    }
}
