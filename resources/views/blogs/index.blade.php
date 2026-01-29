@extends('layouts.app')

@section('title', 'All Blogs')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-900">All Blogs</h1>
    @auth
        @if(auth()->user()->canCreateBlog())
            <a href="{{ route('blogs.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold">
                Create New Blog
            </a>
        @endif
    @endauth
</div>

@if($blogs->count() > 0)
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($blogs as $blog)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">
                        <a href="{{ route('blogs.show', $blog->id) }}" class="hover:text-indigo-600">
                            {{ $blog->title }}
                        </a>
                    </h2>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ Str::limit($blog->content, 150) }}
                    </p>
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $blog->user->name }}</span>
                        </div>
                        <span class="text-gray-400">{{ $blog->created_at->diffForHumans() }}</span>
                    </div>
                    
                    @auth
                        @if(auth()->user()->canEdit($blog) || auth()->user()->canDelete($blog))
                            <div class="mt-4 pt-4 border-t border-gray-200 flex gap-2">
                                @if(auth()->user()->canEdit($blog))
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm text-center">
                                        Edit
                                    </a>
                                @endif
                                @if(auth()->user()->canDelete($blog))
                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $blogs->links() }}
    </div>
@else
    <div class="bg-white rounded-lg shadow-md p-12 text-center">
        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">No blogs yet</h3>
        <p class="text-gray-600 mb-4">Be the first to create a blog post!</p>
        @auth
            @if(auth()->user()->canCreateBlog())
                <a href="{{ route('blogs.create') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold">
                    Create Your First Blog
                </a>
            @endif
        @endauth
    </div>
@endif
@endsection
