<!-- resources/views/coach/create-lesson.blade.php -->  
@extends('layouts.app')  

@section('content')  
<div class="max-w-md mx-auto bg-white p-8 border border-gray-300 rounded-lg shadow-lg">  
    <h2 class="text-2xl font-semibold mb-6">Create Lesson</h2>  

    <form action="{{ route('lessons.store') }}" method="POST">  
        @csrf  
        <div class="mb-4">  
            <label for="title" class="block text-sm font-medium text-gray-700">Lesson Title</label>  
            <input type="text" id="title" name="title" required   
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">  
        </div>  
        <div class="mb-4">  
            <label for="content" class="block text-sm font-medium text-gray-700">Lesson Content</label>  
            <textarea id="content" name="content" rows="4" required   
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300"></textarea>  
        </div>  
        <div class="mb-4">  
            <label for="course_id" class="block text-sm font-medium text-gray-700">Select Course</label>  
            <select id="course_id" name="course_id" required   
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">  
                <!-- Populate this from your courses -->  
                @foreach ($courses as $course)  
                    <option value="{{ $course->id }}">{{ $course->title }}</option>  
                @endforeach  
            </select>  
        </div>  
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Create Lesson</button>  
    </form>  
</div>  
@endsection