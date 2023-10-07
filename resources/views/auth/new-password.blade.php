@extends('layout.master')


@section('title')
    Reset Password
@endsection


@section('content')
    <h4>Reset Password</h4>



    <form action="{{ route('auth.resetPassword') }}" method="POST">
        @csrf

        <input type="hidden" name="user_token" value="{{ $user_token }}">

        <div class=" my-3">
            <label class=" form-label" for="">New Password</label>
            <input class=" form-control @error('password') is-invalid @enderror" type="password" name="password">
            @error('password')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class=" my-3">
            <label class=" form-label" for="">Confirm Password</label>
            <input class=" form-control @error('password_confirmation') is-invalid @enderror" type="password"
                name="password_confirmation">
            @error('password_confirmation')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <button class=" btn btn-primary mt-3">Reset Now</button>
    </form>
@endsection
