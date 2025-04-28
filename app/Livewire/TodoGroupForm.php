<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TaskGroup;

class TodoGroupForm extends Component
{
    public $groupId;
    public $groupName;

    protected $rules = [
        'groupName' => 'required|string|max:255',
    ];

    public function mount($groupId = null)
    {
        $this->groupId = $groupId;
        if ($groupId) {
            $group = TaskGroup::findOrFail($groupId);
            $this->groupName = $group->name;
        }
    }

    public function saveGroup()
    {
        $this->validate();

        if ($this->groupId) {
            $group = TaskGroup::find($this->groupId);
            $group->update(['name' => $this->groupName]);
        } else {
            $group = TaskGroup::create(['name' => $this->groupName]);
            $this->groupId = $group->id;
        }

        $this->dispatch('groupSaved');
    }

    public function render()
    {
        return view('livewire.todo-group-form');
    }
}
