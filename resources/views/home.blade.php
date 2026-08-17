@extends('components.template')

@section('title', 'Home')

@section('content')
    @guest
        <div class="flex min-h-screen items-center justify-center px-4">
            <div class="text-center text-gray-500">
                <p class="text-lg mb-4">You are not logged in. Please sign in to access this page.</p>
                <div class="flex justify-center gap-3">
                    <a href="{{ route('signin') }}" class="btn btn-neutral">Sign In</a>
                    <a href="{{ route('signup') }}" class="btn btn-outline">Sign Up</a>
                </div>
            </div>
        </div>
    @else
       <div class="navbar bg-base-100 shadow-sm">
            <div class="navbar-start">
                <a href="{{ route('home') }}" class="btn btn-ghost text-xl">Blogy</a>
            </div>
            <div class="navbar-end flex gap-2">
                @auth
                    <span class="text-sm mr-2">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('signin') }}" class="btn btn-neutral">Sign In</a>
                    <a href="{{ route('signup') }}" class="btn btn-outline">Sign Up</a>
                @endauth
            </div>
        </div>
        <div class="flex justify-center flex-col gap-5 items-center min-h-screen px-4 py-8">
            <div class="card w-full max-w-4xl bg-base-100 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-2xl mb-4">Create a new post</h2>

                    <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Title</span>
                            </label>
                            <input type="text" name="title" class="input input-bordered w-full" placeholder="Enter post title" required>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Content</span>
                            </label>
                            <textarea name="content" class="textarea textarea-bordered w-full h-32" placeholder="Write your post here..." required></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-neutral">Post New Post</button>
                        </div>
                    </form>
                </div>
            </div>

            @foreach ($posts as $post)
                <div class="card w-full max-w-4xl bg-base-100 card-lg shadow-sm">
                    <div class="card-body border-b border-base-200 last:border-b-0">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="card-title">{{ $post->title }}</h2>
                                <p class="text-sm text-base-content/60 mt-1">
                                    {{ $post->user?->name ?? 'Anonymous' }}
                                    • {{ $post->created_at ? $post->created_at->format('M d, Y') : 'No date' }}
                                    @if ($post->updated_at && $post->updated_at->ne($post->created_at))
                                        <span class="badge text-md text-gray-500 ml-1">Edited</span>
                                    @endif
                                </p>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-neutral btn-sm">Edit</a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>

                        <p class="whitespace-pre-line mt-4">{{ $post->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endguest

    @if (session('toast'))
        <div class="toast toast-top toast-center z-50">
            <div class="alert {{ session('toast.type') === 'success' ? 'alert-success' : 'alert-error' }} shadow-lg">
                <span>{{ session('toast.message') }}</span>
            </div>
        </div>
    @endif
@endsection