<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Scholarship;

class PublicScholarshipList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $sortBy = 'latest'; // latest, deadline_asc

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedSortBy(): void
    {
        $this->resetPage();
    }

    public function with(): array
    {
        $query = Scholarship::where('status', 'published')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('organizer', 'like', '%' . $this->search . '%');
            });

        $query = match ($this->sortBy) {
            'deadline_asc'  => $query->orderBy('end_date', 'asc'),
            'deadline_desc' => $query->orderBy('end_date', 'desc'),
            default         => $query->latest(),
        };

        return [
            'scholarships' => $query->paginate(9),
        ];
    }
}
