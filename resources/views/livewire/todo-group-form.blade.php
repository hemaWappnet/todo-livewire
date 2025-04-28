<div class="mt-8">
    <!-- Group Name & Save -->
    <div class="flex flex-col sm:flex-row items-center mb-6">
        <input type="text" wire:model.defer="groupName" placeholder="Enter list name..."
            class="flex-1 p-3 rounded-l-xl border-2 border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300">
        <button wire:click="saveGroup"
            class="bg-gradient-to-r from-pink-400 to-pink-500 hover:from-pink-500 hover:to-pink-600 text-white font-bold p-3 rounded-r-xl transition-all duration-300 w-full sm:w-auto">
            {{ $groupId ? 'Save List' : 'Create List' }}
        </button>
    </div>

    @if ($groupId)
        <!-- Embed the existing todo-list component -->
        <div class="mt-6">
            @livewire('todo-list', ['groupId' => $groupId])
        </div>
    @endif
</div>
