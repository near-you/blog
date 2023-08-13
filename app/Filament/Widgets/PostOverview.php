<?php

namespace App\Filament\Widgets;

use App\Models\PostView;
use App\Models\UpvoteDownvote;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class PostOverview extends Widget
{
    protected int | string | array $columnSpan = 3;

    protected static string $view = 'filament.widgets.post-overview';

    public ?Model $record = null;

    protected function getViewData(): array
    {
        return [
            'viewCount' => PostView::query()->where('post_id', '=', $this->record->id)->count(),
            'upvotes' => UpvoteDownvote::query()->where('post_id', '=', $this->record->id)->where('is_upvote', '=', 1)->count(),
            'downvotes' => UpvoteDownvote::query()->where('post_id', '=', $this->record->id)->where('is_upvote', '=', 0)->count(),
        ];
    }
}
