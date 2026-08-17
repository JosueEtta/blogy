@extends('components.template')

@section('title', 'Edit Post')

@section('content')
    <div class="flex justify-center items-center min-h-screen px-4 py-8">
        <div class="card w-full max-w-4xl bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-4">Edit post</h2>

                <form action="{{ route('posts.update', $post) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Title</span>
                        </label>
                        <input type="text" name="title" class="input input-bordered w-full" value="{{ old('title', $post->title) }}" placeholder="Enter post title" required>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Content</span>
                        </label>
                        <textarea name="content" class="textarea textarea-bordered w-full h-32" placeholder="Write your post here..." required>{{ old('content', $post->content) }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('home') }}" class="btn btn-ghost">Cancel</a>
                        <button type="submit" class="btn btn-neutral">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('toast'))
        <div class="toast toast-end z-50">
            <div class="alert {{ session('toast.type') === 'success' ? 'alert-success' : 'alert-error' }} shadow-lg">
                <span>{{ session('toast.message') }}</span>
            </div>
        </div>
    @endif
@endsection
