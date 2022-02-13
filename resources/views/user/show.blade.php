
@extends('layouts.main-layout')
@section('content')
    <div class="container">
        <div class="mt-3">
           <span class="font-weight-bold">Имя пользователя: </span> {{$user->name}}
        </div>
        <div class="mt-3">
           <span class="font-weight-bold">Email пользователя: </span> {{$user->email}}
        </div>
    </div>
@endsection
