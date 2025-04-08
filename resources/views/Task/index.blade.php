<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel To-Do List</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .completed { text-decoration: line-through; color: gray; }
    </style>
    <link href="/css/planco.css" rel="stylesheet">
</head>
<body>
<div class="todo-container">
    <h1>To-Do List</h1>

    {{-- Display success message --}}
    @if(session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    <form action="/tasks" method="POST">
        @csrf
        <input type="text" name="title" required>
        <button type="submit">Add Task</button>
    </form>

    <ul>
        @foreach($tasks as $task)
            <li>
                <form action="/tasks/{{ $task->id }}/toggle" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">{{ $task->completed ? 'Undo' : 'Complete'}}</button>
                </form>
                <span class="{{ $task->completed ? 'completed' : '' }}">{{ $task->title }}</span>
                <form action="/tasks/{{ $task->id }}" method="POST" style="display: inline;">
                    @csrf @method('DELETE')
                    <button class="delete-btn" type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>

