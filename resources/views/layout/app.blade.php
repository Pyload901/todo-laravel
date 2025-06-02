<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @auth
        <nav class="bg-blue-500 text-white p-4 mb-6">
            <div class="container mx-auto flex justify-between items-center">
                <div>
                    <h1 class="text-xl font-bold">ToDo App</h1>
                </div>
                <div class="flex items-center space-x-4">
                    @can('view all todos')
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-200">Admin Panel</a>
                    @endcan
                    <a href="{{ route('todo.index') }}" class="hover:text-blue-200">My Todos</a>
                    <span>Welcome, {{ auth()->user()->name }}!</span>
                    @if(auth()->user()->hasRole('admin'))
                        <span class="bg-purple-600 text-white px-2 py-1 rounded text-xs">ADMIN</span>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    @endauth
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="container mx-auto px-4">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>