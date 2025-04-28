<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('To-Do List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        @livewire('todo-list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap');

        .font-cute {
            font-family: 'Comic Neue', cursive;
        }
    </style>

    <script>
        document.addEventListener('task-added', function() {
            // Manually clear the input field after the task is added
            document.querySelector('input[type="text"]').value = '';
        });
    </script>
</x-app-layout>
