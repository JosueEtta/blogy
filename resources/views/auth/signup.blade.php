@extends('components.template')

@section('title', 'Sign Up')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 py-8">
    <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body">
            <h1 class="text-2xl font-bold text-center">Create an account</h1>

            @if ($errors->any())
                <div class="alert alert-error text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('signup.store') }}" class="space-y-4 mt-4">
                @csrf

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input type="text" name="name" class="input input-bordered w-full" value="{{ old('name') }}" required>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" class="input input-bordered w-full" value="{{ old('email') }}" required>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" class="input input-bordered w-full" required>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Confirm Password</span>
                    </label>
                    <input type="password" name="password_confirmation" class="input input-bordered w-full" required>
                </div>

                <button type="submit" class="btn btn-neutral w-full">Sign Up</button>
            </form>

            <p class="text-center text-sm mt-4">
                Already have an account?
                <a href="{{ route('signin') }}" class="link link-neutral">Sign In</a>
            </p>
        </div>
    </div>
</div>
@endsection
