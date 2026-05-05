<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function store(Request $request)
{
    Student::create($request->all());

    return redirect()->back()->with('success', 'Student added successfully!');
}

    public function index()
{
    $students       = Student::all();
    $activeStudents = Student::active()->get();

    return view('students', compact('students', 'activeStudents'));
}

    public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);
    $student->update($request->all());

    return redirect()->back()->with('success', 'Student updated successfully!');
}

    public function destroy($id)
{
    $student = Student::findOrFail($id);
    $student->delete();

    return redirect()->back()->with('success', 'Student deleted successfully!');
}
    public function activeStudents()
{
    $activeStudents = Student::active()->get();
    return view('activeStudents', compact('activeStudents'));
}

    public function inactiveStudents()
{
    $inactiveStudents = Student::inactive()->get();
    return view('inactiveStudents', compact('inactiveStudents'));
}
}
