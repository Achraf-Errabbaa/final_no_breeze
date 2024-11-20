<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Show the course creation form and the list of courses on the same page
    public function index()
    {
        $classes = ClassModel::all();

        $courses = Course::all();

        // Pass the courses and classes to the view
        return view('coach.course', compact('courses', 'classes'));
    }
    public function index2()
    {
        $classes = ClassModel::all();

        $courses = Course::all();

        // Pass the courses and classes to the view
        return view('home.home', compact('courses', 'classes'));
    }

    // Store a newly created course in storage
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'class_id' => 'required|exists:classmodels,id',
        ]);


        // Create a new course using the validated data
        Course::create($validated);
        // Redirect to the course management page with a success message
        return redirect()->route('coach.course')->with('success', 'Course created successfully!');
    }
    
}
