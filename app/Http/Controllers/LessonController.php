<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    // Show the list of lessons and the lesson creation form for a specific course
    public function index(Course $course)
    {
        // Fetch lessons associated with the course
        $lessons = $course->lessons;

        // Pass the lessons and course to the view
        return view('coach.lesson', compact('lessons', 'course'));
    }
    public function lessonView(Course $course, Lesson $lesson)
    {
        $courses = Course::all();
        $lessons = $course->lessons;
        return view('coach.lesson', compact('lessons','course', 'courses', 'lesson'));
    }

    // Store a newly created lesson for a specific course
    public function store(Request $request, Course $course)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file',
            'duration' => 'required|integer',
        ]);

        // $file = $request->file;
        // $fileName = hash("sha256", file_get_contents($file)) . "." . $file->getClientOriginalExtension();
        // $file->move(storage_path("app/public/images"), $fileName);

        $file = $request->file("file")->store("images", "public");
        // Add the course_id to the validated data to associate the lesson with the course
        // $validated['course_id'] = $course->id;
        // $validated['file'] = $file;

        // // Create a new lesson associated with the course
        // Lesson::create($validated);
        lesson::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $file,
            'duration' => $request->duration,
            'course_id' => $course->id,
        ]);

        // Redirect back to the same page with success message
        return redirect()->route('lessons.store', ['course' => $course->id])->with('success', 'Lesson created successfully!');
    }
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('coach.lesson')->with('success', 'Lesson deleted successfully!');
    }
}

