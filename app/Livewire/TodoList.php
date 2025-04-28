<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TodoList extends Component
{
    public $newTask = '';
    public Collection $tasks;
    public $editingTaskId = null;
    public $editedTaskTitle = '';
    public $groupId;

    /**
     * Lifecycle hook to initialize the component.
     */
    public function mount($groupId)
    {
        $this->groupId = $groupId;
        $this->tasks = Task::where('task_group_id', $groupId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Adds a new task to the list.
     */
    public function addTask()
    {
        $this->validate([
            'newTask' => 'required|string|max:255',
        ]);

        // Create a new task and add it to the list
        $task = Task::create([
            'title' => $this->newTask,
            'task_group_id' => $this->groupId,
        ]);

        // Add the task to the local list (no need to refetch from the DB)
        $this->tasks->prepend($task);  // Adding to the start to keep the order

        // Clear the input field
        $this->newTask = '';
    }

    /**
     * Prepares a task for editing.
     */
    public function editTask(Task $task)
    {
        // Set the task ID and title for editing
        $this->editingTaskId = $task->id;
        $this->editedTaskTitle = $task->title;
    }

    /**
     * Updates the task with the new title.
     */
    public function updateTask(Task $task)
    {
        $this->validate([
            'editedTaskTitle' => 'required|string|max:255',
        ]);

        // Update the task title
        $task->title = $this->editedTaskTitle;
        $task->save();

        // Find the task in the list and update it
        $this->tasks = $this->tasks->map(function ($t) use ($task) {
            if ($t->id === $task->id) {
                $t->title = $task->title;
            }
            return $t;
        });

        // Clear editing state
        $this->editingTaskId = null;
        $this->editedTaskTitle = '';
    }

    /**
     * Toggles the completion status of a task.
     */
    public function toggleCompleted(Task $task)
    {
        $task->completed = !$task->completed;
        $task->save();

        // Update the task in the list
        $this->tasks = $this->tasks->map(function ($t) use ($task) {
            if ($t->id === $task->id) {
                $t->completed = $task->completed;
            }
            return $t;
        });
    }

    /**
     * Deletes a task from the list.
     */
    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);

        if ($task) {
            $task->delete();  // Delete the task
            // Remove the task from the local list without needing a DB refresh
            $this->tasks = $this->tasks->filter(function ($t) use ($taskId) {
                return $t->id !== $taskId;
            });
        }
    }

    /**
     * Renders the Livewire component.
     */
    public function render()
    {
        return view('livewire.todo-list');
    }
}
