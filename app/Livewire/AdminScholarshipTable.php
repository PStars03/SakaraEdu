<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Scholarship;

class AdminScholarshipTable extends Component
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
            'scholarships' => Scholarship::with('creator')
                ->where('title', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10),
        ];
    }
}
