<x-app-layout :meta-title="'The NearYou blog - Post by category ' . $category->title" meta-description="By category description">

    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

        @foreach( $posts as $post )
            <x-post-item :post="$post" />
        @endforeach

        <div>
            <!-- Pagination -->
            {{ $posts->onEachSide(1)->links() }}
        </div>

    </section>

    <x-sidebar/>

</x-app-layout>
