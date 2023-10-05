@extends('layout.master')


@section('title')
    Email Verify
@endsection



@section('content')
    <h4>Email Verify</h4>



    <form action="{{ route('auth.verifyStore') }}" method="POST">
        @csrf


        <div class=" my-3">
            <label class=" form-label" for="">Verify code</label>
            <input class=" form-control @error('verify_code') is-invalid @enderror" type="number" name="verify_code"
                value="{{ old('verify_code') }}">
            @error('verify_code')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <button class=" btn btn-primary mt-3">Verify now</button>
    </form>

@endsection
