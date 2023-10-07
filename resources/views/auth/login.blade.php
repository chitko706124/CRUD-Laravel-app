@extends('layout.master')


@section('title')
    Student Login
@endsection


@section('content')
    <h4>Student Login</h4>

    @if (session('message'))
        <div class=" alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ route('auth.check') }}" method="POST">
        @csrf


        <div class=" my-3">
            <label class=" form-label" for="">Email</label>
            <input class=" form-control @error('email') is-invalid @enderror" type="email" name="email"
                value="{{ old('email') }}">
            @error('email')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <div class=" my-3">
            <label class=" form-label" for="">Create Password</label>
            <input class=" form-control @error('password') is-invalid @enderror" type="password" name="password">
            @error('password')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <button class=" btn btn-primary mt-3">Login</button>
        <a href="{{ route('auth.forgot') }}" class=" btn-link">Forgot Password</a>
    </form>
    
@endsection
