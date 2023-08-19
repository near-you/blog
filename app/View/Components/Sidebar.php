<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public function render(): View|Closure|string
    {
        $categories = Category::query()
            ->leftJoin('category_post', 'categories.id', '=', 'category_post.category_id')
            ->leftJoin('posts', 'posts.id', '=', 'category_post.post_id')
            ->select(DB::raw('count(*) as total'), 'categories.title', 'categories.slug')
            ->where('posts.active', '=', 1)
            ->groupBy('categories.id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('components.sidebar', compact('categories'));
    }
}
