@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-[#22B8BF] mb-6">Course Management</h1>

    <!-- Form to Create a New Course -->
    <h2 class="text-2xl font-semibold  mb-4">Create a New Course</h2>
    <form action="{{ route('coach.store') }}" method="POST" class="bg-blue-50 p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-blue-700">Course Title:</label>
            <input type="text" name="title" id="title" class="w-full p-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-blue-700">Description:</label>
            <textarea name="description" id="description" class="w-full p-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required></textarea>
        </div>
        <div class="mb-4">
            <label for="class_id" class="block text-sm font-medium text-blue-700">Class:</label>
            <select name="class_id" id="class_id" class="w-full p-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                <option value="" disabled selected>Select a class</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">Create Course</button>
    </form>

    <!-- Display Courses -->
    <h2 class="text-2xl font-semibold text-blue-500 mt-8">Existing Courses</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
        @foreach($courses as $course)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-blue-500 text-white px-4 py-2">
                    <h5 class="text-lg font-semibold">{{ $course->title }}</h5>
                </div>
                <div class="p-4">
                    <p class="text-gray-700 mb-2">{{ \Str::limit($course->description, 100) }}</p>
                    <p class="text-sm text-gray-500"><strong>Class:</strong> {{ $course->classes->name }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
