<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class AdminManagementTable extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleStatus($id)
    {
        $admin = User::findOrFail($id);
        if ($admin->role === 'admin') {
            $admin->is_active = !$admin->is_active;
            $admin->save();
        }
    }

    public function render()
    {
        $admins = User::where('role', 'admin')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin-management-table', [
            'admins' => $admins,
        ]);
    }
}
