<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TaskGroup;

class GroupList extends Component
{
    public $groups;
    public $showModal = false;
    public $selectedGroupId = null;

    protected $listeners = [
        'groupSaved' => 'refreshGroups',
    ];

    public function mount()
    {
        $this->refreshGroups();
    }

    public function refreshGroups()
    {
        $this->groups = TaskGroup::orderBy('created_at', 'desc')->get();
        $this->showModal = false;
        $this->selectedGroupId = null;
    }

    public function createNew()
    {
        $this->selectedGroupId = null;
        $this->showModal = true;
    }

    public function editGroup($id)
    {
        $this->selectedGroupId = $id;
        $this->showModal = true;
    }

    public function deleteGroup($id)
    {
        // Confirm deletion
        $group = TaskGroup::find($id);

        if ($group) {
            $group->delete();
            $this->refreshGroups();
            session()->flash('message', 'Group deleted successfully!');
        } else {
            session()->flash('error', 'Group not found.');
        }
    }

    public function render()
    {
        return view('livewire.group-list');
    }
}
