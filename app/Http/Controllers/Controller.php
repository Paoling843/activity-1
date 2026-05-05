<?php

namespace App\Http\Controllers;

use App\Models\Student;

abstract class Controller
{
    public function index()
{
    $students = Student::all();
    $activeStudents = Student::active()->get();

    return view('students.index', compact('students', 'activeStudents'));
}
}
