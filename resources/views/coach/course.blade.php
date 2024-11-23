@extends('layouts.app')

@section('content')
@php
    $categories = ['Programming', 'Design', 'Marketing', 'Business'];
@endphp

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#7AB2D3',
                        secondary: '#F5F7F8',
                        accent: '#F4CE14',
                        text: '#45474B',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                    },
                }
            }
        }
    </script>
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .float-animation {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>

<div class="bg-secondary min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-center text-primary mb-12 animate-fade-in">Course Management</h1>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Create New Course Section -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="bg-primary p-6">
                    <h2 class="text-2xl font-semibold text-white">Create a New Course</h2>
                </div>
                <form action="{{ route('coach.store') }}" enctype="multipart/form-data" method="POST" class="p-6 space-y-6">
                    @csrf
                    <div>
                        <label for="file" class="block text-sm font-medium text-text mb-2">Course Image:</label>
                        <div id="fileThumbnail" class="w-full h-40 bg-secondary border-2 border-dashed border-primary rounded-xl flex items-center justify-center cursor-pointer hover:bg-primary/10 transition duration-300">
                            <span class="text-primary text-sm">Choose an image</span>
                        </div>
                        <input type="file" name="file" id="file" class="hidden" required onchange="updateThumbnail(event)">
                    </div>
                    <div>
                        <label for="title" class="block text-sm font-medium text-text mb-2">Course Title:</label>
                        <input type="text" name="title" id="title" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary" required>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-text mb-2">Description:</label>
                        <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary" required></textarea>
                    </div>
                    <div>
                        <label for="class_id" class="block text-sm font-medium text-text mb-2">Class:</label>
                        <select name="class_id" id="class_id" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary" required>
                            <option value="" disabled selected>Select a class</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }} </option>
                            @endforeach
                            @foreach ( $courses as $course )
                            <p> ({{ $course->classes->category ?? 'Uncategorized' }})</p>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-primary text-white px-6 py-3 rounded-xl hover:bg-primary/80 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        <i class="fas fa-plus-circle mr-2"></i>Create Course
                    </button>
                </form>
            </div>

            <!-- Display Courses -->
            <div>
                <h2 class="text-2xl font-bold text-primary mb-6">Available Courses</h2>
                <div class="space-y-6">
                    @foreach ($courses->reverse() as $course)
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-primary/20 transition-all duration-300 hover:shadow-lg hover:border-primary float-animation">
                            <div class="bg-primary text-white px-6 py-4">
                                <h3 class="text-lg font-semibold">{{ $course->classes->name }}</h3>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <img class="w-20 h-20 object-cover rounded-xl mr-4" src="{{ asset('storage/' . $course->file) }}" alt="{{ $course->title }}">
                                    <div>
                                        <h4 class="font-semibold text-lg mb-1 text-text">{{ $course->title }}</h4>
                                        <p class="text-sm text-text/70"><span class="font-medium">Category:</span> {{ $course->classes->category ?? 'Uncategorized' }}</p>
                                    </div>
                                </div>
                                <p class="text-text mb-4 text-sm">{{ \Str::limit($course->description, 100) }}</p>
                                <a href="{{ route('course.lessons', ['course' => $course->id]) }}" class="inline-block bg-accent text-text px-4 py-2 rounded-xl hover:bg-accent/80 transition duration-300 text-sm">
                                    <i class="fas fa-book-open mr-2"></i>View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateThumbnail(event) {
        const file = event.target.files[0];
        const thumbnail = document.getElementById('fileThumbnail');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                thumbnail.style.backgroundImage = `url(${e.target.result})`;
                thumbnail.innerHTML = '';
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection