@extends('layout.app')

@section('content')
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
        
        @if(auth()->user()->hasRole('admin'))
            <div class="mb-6">
                <p class="text-lg text-purple-600 font-semibold mb-4">Welcome, Administrator!</p>
                <p class="mb-6">You have admin privileges to manage users and view all todos.</p>
                <div class="flex justify-center space-x-4 mb-6">
                    <a href="{{ route('admin.dashboard') }}" class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-2 rounded">
                        Admin Panel
                    </a>
                    <a href="{{ route('todo.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                        My Todos
                    </a>
                </div>
            </div>
        @else
            <div class="mb-6">
                <p class="mb-6">Welcome to your ToDo application!</p>
                <a href="{{ route('todo.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                    Go to ToDo List
                </a>
            </div>
        @endif
        
        <div class="mt-8 text-sm text-gray-600">
            <p>Your role: <span class="font-semibold">{{ auth()->user()->getRoleNames()->first() }}</span></p>
        </div>
    </div>
@endsection
