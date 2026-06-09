<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Bootcamp;

class PublicBootcampList extends Component
{

    use WithPagination;

    public $search = '';
    public $filterPrice = 'all'; // all, free, paid

    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    public function updatedFilterPrice()
    {
        $this->resetPage();
    }

    public function with(): array
    {
        return [
            'bootcamps' => Bootcamp::where('status', 'published')
                ->when($this->search, function ($query) {
                    $query->where(function($q) {
                        $q->where('title', 'like', '%' . $this->search . '%')
                          ->orWhere('organizer', 'like', '%' . $this->search . '%');
                    });
                })
                ->when($this->filterPrice === 'free', function ($query) {
                    $query->where('is_paid', false);
                })
                ->when($this->filterPrice === 'paid', function ($query) {
                    $query->where('is_paid', true);
                })
                ->latest()
                ->paginate(9),
        ];
    }
}
