<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class CommentItem extends Component
{
    public Comment $comment;

    public bool $editing = false;

    public bool $replying = false;

    protected $listeners = [
        'cancelEditing' => 'cancelEditing',
        'commentUpdated' => 'commentUpdated',
        'commentCreated' => 'commentCreated',
    ];

    public function mount(Comment $comment): void
    {
        $this->comment = $comment;
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.comment-item');
    }

    public function deleteComment()
    {
        $user = auth()->user();
        if (!$user) {
            return $this->redirect('/login');
        }

        if ($this->comment->user_id != $user->id) {
            return response('You are not allowed to perform this action', 403);
        }

        $id = $this->comment->id;
        $this->comment->delete();
        $this->emitUp('commentDeleted', $id);
    }

    public function startCommentEdit(): void
    {
        $this->editing = true;
    }

    public function cancelEditing(): void
    {
        $this->editing = false;
        $this->replying = false;
    }

    public function commentUpdated(): void
    {
        $this->editing = false;
    }

    public function startReply(): void
    {
        $this->replying = true;
    }

    public function commentCreated(): void
    {
        $this->replying = false;
    }
}
