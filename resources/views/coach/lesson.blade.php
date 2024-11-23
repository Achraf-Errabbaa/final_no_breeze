@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-[#22B8BF] mb-8 text-center">Create a New Lesson for "{{ $course->title }}"</h1>

        <!-- Lesson creation form -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-12">
            <div class="bg-[#22B8BF] text-white px-6 py-4">
                <h2 class="text-2xl font-semibold">Add New Lesson</h2>
            </div>
            <form action="{{ route('lessons.store', ['course' => $course->id]) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Lesson Title:</label>
                        <input type="text" name="title" id="title" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#22B8BF]" required>
                    </div>
                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (in minutes):</label>
                        <input type="number" name="duration" id="duration" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#22B8BF]" required>
                    </div>
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
                    <textarea name="description" id="description" rows="4" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#22B8BF]" required></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="video" class="block text-sm font-medium text-gray-700 mb-1">Upload Video:</label>
                        <input type="file" name="video" id="video" accept="video/*" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#22B8BF]">
                    </div>
                    <div>
                        <label for="pdf" class="block text-sm font-medium text-gray-700 mb-1">Upload PDF:</label>
                        <input type="file" name="pdf" id="pdf" accept=".pdf" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#22B8BF]">
                    </div>
                </div>
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Lesson Content:</label>
                    <textarea name="content" id="content" rows="6" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#22B8BF]" required></textarea>
                </div>
                <button type="submit" class="w-full bg-[#22B8BF] text-white px-6 py-3 rounded-md hover:bg-[#1C9A9F] transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#22B8BF]">
                    Create Lesson
                </button>
            </form>
        </div>

        <!-- Display existing lessons -->
        <h2 class="text-3xl font-bold text-[#22B8BF] mb-6 text-center">Existing Lessons</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($lessons as $lesson)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                    <div class="bg-[#22B8BF] text-white px-6 py-4">
                        <h3 class="text-xl font-semibold">{{ $lesson->title }}</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        @if($lesson->image)
                            <img class="w-full h-48 object-cover rounded-md" src="{{ asset('storage/' . $lesson->image) }}" alt="{{ $lesson->title }}">
                        @endif
                        <p class="text-gray-700">{{ \Str::limit($lesson->description, 100) }}</p>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span><i class="fas fa-clock mr-2"></i>{{ $lesson->duration }} minutes</span>
                            <span><i class="fas fa-calendar-alt mr-2"></i>{{ $lesson->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex space-x-2">
                            @if($lesson->video)
                                <a href="{{ asset('storage/' . $lesson->video) }}" class="flex-1 bg-blue-500 text-white text-center py-2 rounded-md hover:bg-blue-600 transition duration-300" target="_blank">
                                    <i class="fas fa-play-circle mr-2"></i>Watch Video
                                </a>
                            @endif
                            @if($lesson->pdf)
                                <a href="{{ asset('storage/' . $lesson->pdf) }}" class="flex-1 bg-red-500 text-white text-center py-2 rounded-md hover:bg-red-600 transition duration-300" target="_blank">
                                    <i class="fas fa-file-pdf mr-2"></i>View PDF
                                </a>
                            @endif
                        </div>
                        <a href="#" class="block w-full bg-gray-200 text-center py-2 rounded-md hover:bg-gray-300 transition duration-300">
                            View Full Lesson
                        </a>
                        <form action="{{ route('lesson.destroy', $lesson->id) }}" method="POST" onsubmit="return;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 text-white text-center py-2 rounded-md hover:bg-red-600 transition duration-300">
                                <i class="fas fa-trash-alt mr-2"></i>Delete Lesson
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection