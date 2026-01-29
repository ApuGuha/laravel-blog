@extends('layouts.app')

@section('title', 'Create New Blog')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Create New Blog</h1>
        
        <form action="{{ route('blogs.store') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Blog Title</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('title') border-red-500 @enderror"
                    placeholder="Enter a catchy title for your blog..."
                    required
                >
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Blog Content</label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="15"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('content') border-red-500 @enderror"
                    placeholder="Write your blog content here..."
                    required
                >{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button 
                    type="submit" 
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-200"
                >
                    Publish Blog
                </button>
                <a 
                    href="{{ route('blogs.index') }}" 
                    class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-200"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Tips Section -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mt-6">
        <h3 class="text-lg font-semibold text-blue-900 mb-3">Writing Tips</h3>
        <ul class="text-sm text-blue-800 space-y-2">
            <li>• Make your title clear and engaging</li>
            <li>• Break your content into paragraphs for better readability</li>
            <li>• Proofread before publishing</li>
            <li>• You can edit your blog anytime after publishing</li>
        </ul>
    </div>
</div>
@endsection
