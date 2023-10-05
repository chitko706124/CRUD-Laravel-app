@extends('layout.master')


@section('title')
    Student Register
@endsection


@section('content')
    <h4>Student Register</h4>



    <form action="{{ route("auth.store")}}" method="POST" >
        @csrf
        <div>
            <label class=" form-label" for="">Your Name</label>
            <input class=" form-control @error('name') is-invalid @enderror" type="text" name="name"
                value="{{ old('name') }}">
            @error('name')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <div class=" my-3">
            <label class=" form-label" for="">Your Email</label>
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


        <div>
            <label class=" form-label" for="">Confirm Password</label>
            <input class=" form-control @error('password_confirmation') is-invalid @enderror" type="password"
                name="password_confirmation">
            @error('password_confirmation')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <button class=" btn btn-primary mt-3">Register</button>
    </form>
@endsection
