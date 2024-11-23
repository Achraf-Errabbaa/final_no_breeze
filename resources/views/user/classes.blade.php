@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-12">
        <h2 class="text-3xl font-bold text-center mb-6">Existing Courses</h2>
        <div class="max-w-screen-xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($courses->reverse() as $course)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden w-[350px]">
                        <div class="bg-blue-500 text-white px-6 py-4">
                            <h5 class="text-xl font-semibold">{{ $course->classes->name }}</h5>
                        </div>
                        <div>
                            <img class="w-full h-[300px] object-cover" src="{{ asset('storage/' . $course->file) }}"
                                alt="{{ $course->title }}">
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-500"><strong>Course name:</strong> {{ $course->title }}</p>
                            <p class="text-sm text-gray-500"><strong>Category:</strong>
                                {{ $course->category ?? 'Uncategorized' }}</p>
                            <p class="text-gray-700 mt-2 mb-2">
                                <strong>Description:</strong>{{ \Str::limit($course->description, 200) }}
                            </p>
                        </div>
                    </div>
                @endforeach
                @if (auth()->user()->classes->contains($class))
                    <button class="bg-gray-400 text-white py-2 px-4 rounded-md" disabled>Enrolled</button>
                @else
                    <form action="{{ route('classes.enroll', $class->id) }}" method="POST">
                        @csrf
                        <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Enroll</button>
                    </form>
                @endif

            </div>
        </div>
    </div>
@endsection
