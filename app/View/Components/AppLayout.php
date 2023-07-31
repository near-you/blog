<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public ?string $metaTitle = null, public ?string $metaDescription = null)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = Category::query()
            ->leftJoin('category_post', 'categories.id', '=', 'category_post.category_id')
            ->leftJoin('posts', 'posts.id', '=', 'category_post.post_id')
            ->select( DB::raw('count(*) as total'), 'categories.title', 'categories.slug')
            ->where('posts.active', '=', 1)
            ->groupBy('categories.id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('layouts.app', compact('categories'));
    }
}
