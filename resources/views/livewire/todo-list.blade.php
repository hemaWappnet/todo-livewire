<div class="max-w-2xl mx-auto p-8 bg-white rounded-2xl shadow-lg mt-2 overflow-auto max-h-96">
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow">
            {{ session('message') }}
        </div>
    @endif

    <!-- Add Task Form Toggle Wrapper -->
    <div x-data="{ showForm: false, showDesc: false }">
        <div class="flex justify-end mb-2">
            <!-- Toggle Add Form Button -->
            <button type="button" @click="showForm = !showForm"
                class="p-2 bg-pink-100 rounded-full hover:bg-pink-200 transition duration-300" title="Toggle Add Form">
                <svg x-show="!showForm" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <svg x-show="showForm" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                </svg>
            </button>
        </div>

        <!-- Responsive Add Task Form -->
        <form x-show="showForm" x-cloak wire:submit.prevent="addTask"
            class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end mb-8">
            <!-- Task Title & Toggle Description -->
            <div class="md:col-span-2">
                <label for="newTask" class="block text-sm font-medium text-gray-700 mb-1">Task Title</label>
                <div class="flex items-center space-x-2">
                    <input id="newTask" type="text" wire:model.live="newTask" placeholder="Enter task title..."
                        class="w-full p-3 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300" />
                    <button type="button" @click="showDesc = !showDesc"
                        class="p-2 bg-pink-100 rounded-full hover:bg-pink-200 transition duration-300"
                        title="Toggle Description">
                        <svg x-show="!showDesc" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <svg x-show="showDesc" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Submit Button on md+ -->
            <button type="submit"
                class="hidden md:block bg-gradient-to-r from-pink-400 to-pink-500 hover:from-pink-500 hover:to-pink-600 text-white font-bold py-3 px-6 rounded-xl transition-transform duration-300 transform hover:scale-105">
                Add Task
            </button>

            <!-- Description (toggleable) -->
            <div x-show="showDesc" x-cloak class="md:col-span-3">
                <label for="newTaskDescription" class="block text-sm font-medium text-gray-700 mb-1">Description <span
                        class="text-gray-400">(optional)</span></label>
                <textarea id="newTaskDescription" wire:model="newTaskDescription" rows="3" placeholder="Add a description..."
                    class="w-full p-3 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300"></textarea>
            </div>

            <!-- Submit Button on mobile -->
            <button type="submit"
                class="md:hidden w-full bg-gradient-to-r from-pink-400 to-pink-500 hover:from-pink-500 hover:to-pink-600 text-white font-bold py-3 rounded-xl transition-transform duration-300 transform hover:scale-105">
                Add Task
            </button>
        </form>
    </div>

    <!-- Task List -->
    <ul class="space-y-4 overflow-auto max-h-72">
        @foreach ($tasks as $task)
            <li wire:key="{{ $task->id }}"
                class="flex items-center justify-between p-4 bg-pink-50 rounded-xl shadow hover:shadow-md transition-all duration-300">
                <div class="flex items-start space-x-4 w-full">
                    <input type="checkbox" wire:change="toggleCompleted({{ $task->id }})"
                        {{ $task->completed ? 'checked' : '' }} class="form-checkbox text-pink-500 rounded-full mt-1" />

                    <div class="w-full">
                        @if ($editingTaskId === $task->id)
                            <input type="text" wire:model="editedTaskTitle"
                                wire:keydown.enter="updateTask({{ $task->id }})" placeholder="Edit title..."
                                class="w-full p-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300" />
                            <textarea wire:model="editedTaskDescription" rows="2" placeholder="Edit description..."
                                class="w-full mt-2 p-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300"></textarea>
                        @else
                            <span wire:click="editTask({{ $task->id }})"
                                class="cursor-pointer font-medium text-lg {{ $task->completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                                {{ $task->title }}
                            </span>
                            @if ($task->description)
                                <p class="text-sm text-gray-600 mt-1 max-w-60 overflow-hidden text-ellipsis">
                                    {{ $task->description }}</p>
                            @endif
                        @endif
                    </div>
                </div>

                <button wire:click="deleteTask({{ $task->id }})"
                    class="text-red-400 hover:text-red-600 transition-transform hover:scale-110 text-xl">
                    ✖️
                </button>
            </li>
        @endforeach
    </ul>
</div>
