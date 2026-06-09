<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\News;

class AdminNewsTable extends Component
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
            'news' => News::with('author')
                ->where('title', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10),
        ];
    }
}
