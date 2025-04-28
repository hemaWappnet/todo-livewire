<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TodoList extends Component
{
    public $newTask = ''; // Holds the new task input
    public $tasks; // Holds the list of tasks
    public $editingTaskId = null; // Tracks the ID of the task being edited
    public $editedTaskTitle = ''; // Holds the title of the task being edited

    /**
     * Lifecycle hook to initialize the component.
     */
    public function mount()
    {
        // Fetch all tasks ordered by creation date
        $this->tasks = Task::orderBy('created_at', 'desc')->get();
    }

    /**
     * Adds a new task to the list.
     */
    public function addTask()
    {
        $this->validate([
            'newTask' => 'required|string|max:255', // Validate input
        ]);

        // Clear any editing state to avoid conflicts
        $this->editingTaskId = null;
        $this->editedTaskTitle = '';

        // Create a new task
        Task::create([
            'title' => $this->newTask,
        ]);

        // Clear the input field
        $this->newTask = '';

        // Refresh the task list
        $this->tasks = Task::orderBy('created_at', 'desc')->get();
    }

    /**
     * Prepares a task for editing.
     *
     * @param Task $task
     */
    public function editTask(Task $task)
    {
        // Clear the new task input to avoid conflicts
        $this->newTask = '';

        // Set the task ID and title for editing
        $this->editingTaskId = $task->id;
        $this->editedTaskTitle = $task->title;
    }

    /**
     * Updates the task with the new title.
     *
     * @param Task $task
     */
    public function updateTask(Task $task)
    {
        $this->validate([
            'editedTaskTitle' => 'required|string|max:255', // Validate input
        ]);

        // Update the task title
        $task->title = $this->editedTaskTitle;
        $task->save();

        // Clear editing state
        $this->editingTaskId = null;
        $this->editedTaskTitle = '';

        // Refresh the task list
        $this->tasks = Task::orderBy('created_at', 'desc')->get();
    }

    /**
     * Toggles the completion status of a task.
     *
     * @param Task $task
     */
    public function toggleCompleted(Task $task)
    {
        $task->completed = !$task->completed; // Toggle the completed status
        $task->save();

        // Refresh the task list
        $this->tasks = Task::orderBy('created_at', 'desc')->get();
    }

    /**
     * Deletes a task from the list.
     *
     * @param int $taskId
     */
    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);

        if ($task) {
            $task->delete(); // Delete the task
        }

        // Refresh the task list
        $this->tasks = Task::orderBy('created_at', 'desc')->get();
    }

    /**
     * Renders the Livewire component.
     */
    public function render()
    {
        return view('livewire.todo-list');
    }
}
