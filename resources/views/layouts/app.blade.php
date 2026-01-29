<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Blog')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600">
                            Laravel Blog
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('blogs.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900 hover:text-indigo-600">
                            All Blogs
                        </a>
                        @auth
                            @if(auth()->user()->canCreateBlog())
                                <a href="{{ route('blogs.create') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900 hover:text-indigo-600">
                                    Create Blog
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="flex items-center">
                    @auth
                        <span class="text-sm text-gray-700 mr-4">
                            Welcome, <strong>{{ auth()->user()->name }}</strong> 
                            <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded">{{ ucfirst(auth()->user()->role) }}</span>
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm ml-2">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-12 border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Laravel Blog. Built with Laravel 10 & Eloquent ORM.
            </p>
        </div>
    </footer>
</body>
</html>
