@extends('layout.app')

@section('content')
    {{-- New todo form --}}
    <h1>Add new ToDo</h1>
    <form action="{{ route('todo.store') }}" method="POST" class="form">
        @csrf
        <x-forms.input name="title" required>Título</x-forms.input>
        <x-forms.input name="description">Descripción</x-forms.input>
        <x-forms.button type="submit">Nueva tarea</x-forms.button>
    </form>
    <br>
    <h1>ToDo List</h1>
    <ul>
        @foreach ($todos as $todo)
            <li>
                <form action="{{ route('todo.update', $todo->id) }}" method="POST" class="hidden form" id="form-{{ $todo->id }}">
                    @csrf
                    @method('PATCH')
                    <x-forms.input name="title" value="{{ $todo->title }}" required>Título</x-forms.input>
                    <x-forms.input name="description" value="{{ $todo->description }}">Descripción</x-forms.input>
                    <x-forms.button type="submit">Guardar</x-forms.button>
                </form>
                <div id="todo-{{ $todo->id }}" class="todo-item">
                    <p class="todo-title"><strong>{{ $todo->title }}</strong></p>
                    <p class="todo-description">{{ $todo->description }}</p>
                    <div>
                        <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <x-forms.button type="submit" class="btn btn-danger">Eliminar</x-forms.button>
                        </form>
                        <x-forms.button onclick="editar('{{ $todo->id }}')">Editar</x-forms.button>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endsection