<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Bootcamp;

class AdminBootcampTable extends Component
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
            'bootcamps' => Bootcamp::with('creator')
                ->where('title', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10),
        ];
    }
}
