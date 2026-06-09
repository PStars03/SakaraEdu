<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\News;

class PublicNewsList extends Component
{

    use WithPagination;

    public $search = '';
    public $category = 'all';

    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function with(): array
    {
        $categories = News::where('status', 'published')
            ->select('category')
            ->distinct()
            ->pluck('category');

        $news = News::where('status', 'published')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->category !== 'all', function ($query) {
                $query->where('category', $this->category);
            })
            ->latest()
            ->paginate(9);

        return [
            'news' => $news,
            'categories' => $categories,
        ];
    }
}
