<div class="max-w-md mx-auto p-4 bg-pink-100 rounded-2xl shadow-lg mt-10">
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Header -->
    <h1 class="text-3xl font-extrabold text-center mb-4 font-cute">My To-Do List 📝</h1>

    <!-- Add Task Form -->
    <form wire:submit.prevent="addTask" class="flex mb-4">
        <input type="text" wire:model="newTask" placeholder="Add a task..."
            class="flex-1 p-2 rounded-l-xl border-2 border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-400">
        <button type="submit" class="bg-pink-400 hover:bg-pink-500 text-white font-bold p-2 rounded-r-xl">
            Add
        </button>
    </form>

    <!-- Task List -->
    <ul class="space-y-3">
        @foreach ($tasks as $task)
            <div wire:key="{{ $task->id }}">
                <li class="flex items-center justify-between p-3 bg-white rounded-xl shadow hover:shadow-md transition">
                    <div class="flex items-center space-x-2">
                        <!-- Toggle Completed -->
                        <input type="checkbox" wire:change="toggleCompleted({{ $task->id }})"
                            {{ $task->completed ? 'checked' : '' }} class="form-checkbox text-pink-500 rounded-full">

                        <!-- Edit Task -->
                        @if ($editingTaskId === $task->id)
                            <input type="text" wire:model="editedTaskTitle"
                                wire:keydown.enter="updateTask({{ $task->id }})"
                                class="border border-gray-300 rounded-md p-1 focus:outline-none focus:ring-2 focus:ring-pink-400">
                        @else
                            <span
                                class="{{ $task->completed ? 'line-through text-gray-400' : '' }} font-cute cursor-pointer"
                                wire:click="editTask({{ $task->id }})">
                                {{ $task->title }}
                            </span>
                        @endif
                    </div>

                    <!-- Delete Task -->
                    <button wire:click="deleteTask({{ $task->id }})"
                        class="text-red-400 hover:text-red-600 transition transform hover:scale-110">✖️</button>
                </li>
            </div>
        @endforeach
    </ul>
</div>
