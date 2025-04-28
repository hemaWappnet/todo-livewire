<div class="max-w-lg mx-auto p-6 bg-white rounded-2xl shadow-lg mt-12">
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow">
            {{ session('message') }}
        </div>
    @endif

    <!-- Header -->
    <h1 class="text-3xl sm:text-4xl font-extrabold text-center mb-6 text-pink-500 font-cute">My To-Do List 📝</h1>

    <!-- Add Task Form -->
    <form wire:submit.prevent="addTask" class="flex flex-col sm:flex-row items-center mb-6">
        <input type="text" wire:model.live="newTask" placeholder="Add a task..."
            class="flex-1 p-3 rounded-l-xl border-2 border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300">
        <button type="submit"
            class="bg-gradient-to-r from-pink-400 to-pink-500 hover:from-pink-500 hover:to-pink-600 text-white font-bold p-3 rounded-r-xl transition-all duration-300 w-full sm:w-auto">
            Add
        </button>
    </form>

    <!-- Task List -->
    <ul class="space-y-4 overflow-auto max-h-32">
        @foreach ($tasks as $task)
            <div wire:key="{{ $task->id }}">
                <li
                    class="flex items-center justify-between p-4 bg-pink-100 rounded-xl shadow hover:shadow-md transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <!-- Toggle Completed -->
                        <input type="checkbox" wire:change="toggleCompleted({{ $task->id }})"
                            {{ $task->completed ? 'checked' : '' }} class="form-checkbox text-pink-500 rounded-full">

                        <!-- Edit Task -->
                        @if ($editingTaskId === $task->id)
                            <input type="text" wire:model="editedTaskTitle"
                                wire:keydown.enter="updateTask({{ $task->id }})"
                                class="border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-pink-500 transition-all duration-300">
                        @else
                            <span
                                class="{{ $task->completed ? 'line-through text-gray-400' : '' }} font-cute cursor-pointer text-lg text-gray-800"
                                wire:click="editTask({{ $task->id }})">
                                {{ $task->title }}
                            </span>
                        @endif
                    </div>

                    <!-- Delete Task -->
                    <button wire:click="deleteTask({{ $task->id }})"
                        class="text-red-400 hover:text-red-600 transition transform hover:scale-110 text-xl">✖️</button>
                </li>
            </div>
        @endforeach
    </ul>
</div>
