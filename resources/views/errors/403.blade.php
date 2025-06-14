@extends('layout.app')

@section('content')
    <div class="max-w-md mx-auto mt-16 text-center">
        <div class="bg-red-50 border border-red-200 rounded-lg p-8">
            <div class="text-red-500 mb-4">
                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.99-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Access Denied</h1>
            <p class="text-gray-600 mb-6">You don't have permission to access this resource.</p>
            <div class="space-y-3">
                <a href="{{ route('dashboard') }}" class="block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Go to Dashboard
                </a>
                <a href="{{ route('todo.index') }}" class="block bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Go to My Todos
                </a>
            </div>
        </div>
    </div>
@endsection
