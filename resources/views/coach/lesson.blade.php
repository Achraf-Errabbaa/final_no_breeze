@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-[#22B8BF] mb-6">Create a New Lesson for "{{ $course->title }}"</h1>

    <!-- Lesson creation form -->
    <form action="{{ route('lessons.store', ['course' => $course->id]) }}" method="POST" enctype="multipart/form-data" class="bg-blue-50 p-6 rounded-lg shadow-md mb-8">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-blue-700">Lesson Title:</label>
            <input type="text" name="title" id="title" class="w-full p-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-blue-700">Description:</label>
            <textarea name="description" id="description" class="w-full p-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required></textarea>
        </div>
        <div class="mb-4">
            <label for="file" class="block text-sm font-medium text-blue-700">Upload File:</label>
            <input type="file" name="file" id="file" class="w-full p-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="mb-4">
            <label for="duration" class="block text-sm font-medium text-blue-700">Duration (in minutes):</label>
            <input type="number" name="duration" id="duration" class="w-full p-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">Create Lesson</button>
    </form>

    <!-- Display existing lessons -->
    <h2 class="text-2xl font-semibold text-blue-500 mt-8 mb-4">Existing Lessons</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($lessons as $lesson)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-blue-500 text-white px-4 py-2">
                    <h5 class="text-lg font-semibold">{{ $lesson->title }}</h5>
                </div>
                <div>
                    <img class="w-[400px] h-[250px] object-cover" src="{{ asset('storage/' . $lesson->file) }}" alt="{{ $lesson->title }}">
                </div>
                <div class="p-4">
                    <p class="text-gray-700 mb-2">{{ \Str::limit($lesson->description, 100) }}</p>
                    <p class="text-sm text-gray-500"><strong>Duration:</strong> {{ $lesson->duration }} minutes</p>
                    <p class="text-sm text-gray-500"><strong>File:</strong> {{ $lesson->file }}</p>
                    <!-- You can add a link or button for more details if needed -->
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
