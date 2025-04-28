<div x-data="{ showModal: @entangle('showModal'), confirmDelete: false, deleteId: null }">
    <!-- Create New List Button -->
    <button @click="showModal = true" wire:click="createNew"
        class="bg-gradient-to-r from-pink-400 to-pink-500 hover:from-pink-500 hover:to-pink-600 text-white font-semibold py-3 px-6 rounded-full shadow-md transition duration-300 transform hover:scale-105">
        + Create New List
    </button>

    <!-- Your group cards... -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        @foreach ($groups as $group)
            <div wire:key="{{ $group->id }}"
                class="bg-gray-50 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                <h2 class="text-2xl font-extrabold mb-2 text-gray-700">{{ $group->name }}</h2>
                <button wire:click="editGroup({{ $group->id }})"
                    class="bg-pink-400 hover:bg-pink-500 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 transform hover:scale-105">
                    Edit
                </button>

                <!-- Delete Button (with confirmation) -->
                <button @click="confirmDelete = true; deleteId = {{ $group->id }}"
                    class="bg-red-400 hover:bg-red-500 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 mt-2">
                    Delete
                </button>
            </div>
        @endforeach
    </div>

    <!-- Confirmation Modal -->
    <div x-show="confirmDelete" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-xl font-semibold mb-4">Are you sure you want to delete this group?</h2>
            <div class="flex justify-between">
                <button @click="confirmDelete = false"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">
                    Cancel
                </button>
                <button @click="confirmDelete = false; $wire.deleteGroup(deleteId)"
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                    Confirm
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-pink-100 p-8 rounded-2xl shadow-lg w-full max-w-2xl transform transition-all duration-300">
            <div class="flex justify-between items-center">
                <!-- Header -->
                <h1 class="text-4xl font-extrabold text-center text-pink-500">My To-Do List 📝</h1>
                <button @click="showModal = false"
                    class="text-red-500 hover:text-red-700 float-right text-2xl font-bold">✖️</button>
            </div>

            @livewire('todo-group-form', ['groupId' => $selectedGroupId], key($selectedGroupId ?? 'new'))
        </div>
    </div>
</div>
