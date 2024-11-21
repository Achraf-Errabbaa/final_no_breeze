<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    // Show the form and list of classes
    public function index()
    {
        $classes = ClassModel::all();
        return view('coach.class', compact('classes'));
    }
    public function viewCourses(ClassModel $class)
    {
        $classes = ClassModel::all();
        $courses = $class->courses;
        return view('coach.course', compact('class','classes', 'courses'));
    }


    // Store a newly created class
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'max_participants' => 'required|integer|min:1|max:21',
        ]);

        ClassModel::create($request->only('name', 'max_participants'));

        return redirect()->route('coach.class')->with('success', 'Class created successfully!');
    }

    // Delete a class
    public function destroy(ClassModel $class)
    {
        $class->delete();

        return redirect()->route('coach.class')->with('success', 'Class deleted successfully!');
    }
}
