@extends('layout.master')

@section('title')
    Home
@endsection

@section('content')
    <h4>I'm Home</h4>

    <div class=" alert alert-info">
        {{-- {{ dd(collect(session("auth")))}} --}}
        {{-- {{ session()->get("auth")->name}} --}}


        Hello {{ session('auth')->name }}


    </div>
    <form action="{{ route('auth.logout') }}" method="POST">
        @csrf
        <button class=" btn btn-danger">Logout</button>
    </form>
@endsection
