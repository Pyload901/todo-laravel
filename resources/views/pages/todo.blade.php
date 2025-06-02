@extends('layout.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- New todo form --}}
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h1 class="text-2xl font-bold mb-4">Add New ToDo</h1>
            <form action="{{ route('todo.store') }}" method="POST" class="space-y-4">
                @csrf
                <x-forms.input name="title" required>Title</x-forms.input>
                <x-forms.input name="description">Description</x-forms.input>
                <x-forms.button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Add Task
                </x-forms.button>
            </form>
        </div>

        {{-- Todo List --}}
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">Your ToDo List</h1>
            
            @if($todos->count() > 0)
                <div class="space-y-4">
                    @foreach ($todos as $todo)
                        <div class="border border-gray-200 rounded-lg p-4">
                            {{-- Edit form (hidden by default) --}}
                            <form action="{{ route('todo.update', $todo->id) }}" method="POST" class="hidden space-y-4" id="form-{{ $todo->id }}">
                                @csrf
                                @method('PATCH')
                                <x-forms.input name="title" value="{{ $todo->title }}" required>Title</x-forms.input>
                                <x-forms.input name="description" value="{{ $todo->description }}">Description</x-forms.input>
                                <div class="flex space-x-2">
                                    <x-forms.button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                                        Save
                                    </x-forms.button>
                                    <x-forms.button type="button" onclick="cancelEdit('{{ $todo->id }}')" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                                        Cancel
                                    </x-forms.button>
                                </div>
                            </form>

                            {{-- Display view --}}
                            <div id="todo-{{ $todo->id }}" class="todo-item">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $todo->title }}</h3>
                                        @if($todo->description)
                                            <p class="text-gray-600 mt-1">{{ $todo->description }}</p>
                                        @endif
                                        <p class="text-sm text-gray-400 mt-2">Created: {{ $todo->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="flex space-x-2 ml-4">
                                        <x-forms.button type="button" onclick="editar('form-{{ $todo->id }}')" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                            Edit
                                        </x-forms.button>
                                        <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <x-forms.button type="submit" onclick="return confirm('Are you sure you want to delete this todo?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                                Delete
                                            </x-forms.button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500 text-lg">No todos yet. Create your first todo above!</p>
                </div>
            @endif
        </div>
    </div>
@endsection