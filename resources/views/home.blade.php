<x-app-layout meta-title="NearYou Blog" meta-description="The NearYou's personal blog">
    <div class="container w-full mx-auto py-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Latest Post -->
            <div class="col-span-2">
                <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
                    Latest Post
                </h2>

                <x-post-item :post="$latestPost"/>
            </div>

            <!-- Popular 3 posts -->
            <div>
                <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
                    Popular Posts
                </h2>

                @foreach( $popularPosts as $post )
                    <div class="grid grid-cols-4 gap-2 mb-5">
                        <a href="{{ route('view', $post) }}" class="pt-1">
                            <img src="{{ $post->getThumbnail() }}" alt="{{ $post->title }}"/>
                        </a>

                        <div class="col-span-3">
                            <a href="{{ route('view', $post) }}">
                                <h3 class="text-bold uppercase whitespace-nowrap truncate">
                                    {{ $post->title }}
                                </h3>
                            </a>
                            <div class="flex gap-2">
                                @foreach( $post->categories as $category )
                                    <a href="{{ route('by-category', $category) }}"
                                       class="text-blue-700 text-xs font-bold uppercase pb-1">
                                        {{ $category->title}}
                                    </a>
                                @endforeach
                            </div>
                            <div class="text-sm">
                                {{ $post->shortBody(10) }}
                            </div>
                            <a href="{{ route('view', $post) }}"
                               class="text-xs bg-blue-600 p-1 rounded uppercase text-white hover:bg-blue-700">Continue
                                Reading
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recommended posts -->
        <div class="mb-8">
            <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
                Recommended Posts
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                @foreach( $recommendedPosts as $post )
                    <x-post-item :post="$post" :show-author="false"/>
                @endforeach
            </div>
        </div>

        <!-- Latest Categories -->
        <div class="mb-4">
            <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
                Recent Categories
            </h2>
            @foreach( $categories as $category )
                <div class="mb-6">
                    <h3 class="text-xl text-center font-bold uppercase">
                        {{ $category->title }}
                    </h3>
                    <div class="grid grid-col-1 md:grid-cols-3 gap-3">
                        @foreach( $category->publishedPosts as $post )
                            <x-post-item :post="$post" :show-author="false"/>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
