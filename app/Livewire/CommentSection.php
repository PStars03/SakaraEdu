<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Scholarship;
use App\Models\Bootcamp;
use Livewire\Component;
use Livewire\Attributes\Rule;

class CommentSection extends Component
{
    public string $modelType;
    public int $modelId;

    #[Rule('required|string|min:5|max:1000')]
    public string $body = '';

    public function getModelInstance()
    {
        return match ($this->modelType) {
            'scholarship' => Scholarship::findOrFail($this->modelId),
            'bootcamp'    => Bootcamp::findOrFail($this->modelId),
            default       => abort(404),
        };
    }

    public function submit(): void
    {
        if (! auth()->check()) {
            $this->dispatch('notify', type: 'error', message: 'Kamu harus login untuk berkomentar.');
            return;
        }

        $this->validate();

        $model = $this->getModelInstance();

        $model->comments()->create([
            'user_id' => auth()->id(),
            'body'    => $this->body,
        ]);

        $this->reset('body');
        $this->dispatch('comment-posted');
    }

    public function deleteComment(int $commentId): void
    {
        $comment = Comment::findOrFail($commentId);

        if ($comment->user_id !== auth()->id()) {
            return;
        }

        $comment->delete();
    }

    public function render()
    {
        $model = $this->getModelInstance();
        $comments = $model->comments()->with('user')->latest()->get();

        return view('livewire.comment-section', compact('comments'));
    }
}
