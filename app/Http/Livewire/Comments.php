<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Comments extends Component
{
    public Post $post;

    protected $listeners = [
        'commentCreated' => '$refresh',
        'commentDeleted' => '$refresh',
    ];

    public function mount(Post $post): void
    {
        $this->post = $post;
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $comments = $this->selectComments();

        return view('livewire.comments', compact('comments'));
    }

    public function selectComments(): Collection|array
    {
        return Comment::query()
            ->where('post_id', '=', $this->post->id)
            ->with(['post', 'user', 'comments'])
            ->whereNull('parent_id')
            ->orderByDesc('created_at')
            ->get();
    }
}
