<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Bootcamp;

class PublicBootcampList extends Component
{
    use WithPagination;

    public string $search      = '';
    public string $filterPrice = 'all'; // all, free, paid
    public string $filterType  = 'all'; // all, bootcamp, workshop, webinar
    public string $sortBy      = 'latest'; // latest, deadline_asc, deadline_desc

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterPrice(): void
    {
        $this->resetPage();
    }

    public function updatedFilterType(): void
    {
        $this->resetPage();
    }

    public function updatedSortBy(): void
    {
        $this->resetPage();
    }

    public function with(): array
    {
        $query = Bootcamp::where('status', 'published')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('organizer', 'like', '%' . $this->search . '%')
                      ->orWhere('location', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterPrice === 'free', function ($query) {
                $query->where('is_paid', false);
            })
            ->when($this->filterPrice === 'paid', function ($query) {
                $query->where('is_paid', true);
            })
            ->when($this->filterType !== 'all', function ($query) {
                $query->where('type', $this->filterType);
            });

        $query = match ($this->sortBy) {
            'deadline_asc'  => $query->orderBy('end_date', 'asc'),
            'deadline_desc' => $query->orderBy('end_date', 'desc'),
            default         => $query->latest(),
        };

        return [
            'bootcamps' => $query->paginate(9),
        ];
    }
}
