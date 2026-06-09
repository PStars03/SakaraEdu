<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Scholarship;

class PublicScholarshipList extends Component
{

    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function with(): array
    {
        return [
            'scholarships' => Scholarship::where('status', 'published')
                ->when($this->search, function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                          ->orWhere('organizer', 'like', '%' . $this->search . '%');
                })
                ->latest()
                ->paginate(9),
        ];
    }
}
