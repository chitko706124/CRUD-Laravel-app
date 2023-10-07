@extends('layout.master')


@section('title')
    Forgot Password
@endsection


@section('content')
    <h4>Enter Your Email</h4>



    <form action="{{ route('auth.checkMail') }}" method="POST">
        @csrf


        <div class=" my-3">
            <label class=" form-label" for="">Enter Email</label>
            <input class=" form-control @error('email') is-invalid @enderror" type="email" name="email"
                value="{{ old('email') }}">
            @error('email')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class=" btn btn-primary mt-3">Send link</button>
    </form>
    <a href="{{ session('link') }}" class=" btn-link">{{ session('link') }}</a>

    {{-- {{ $link }} --}}
@endsection
