
@extends('layouts.main-layout')
<<<<<<< HEAD
@section('title', 'Просмотр пользователя')
@section('content')
    <a href="{{route('users.index')}}" class="btn btn-danger mt-2 mb-3">Венуться к списку</a>
=======
@section('content')
>>>>>>> origin/master
    <div class="container">
        <div class="mt-3">
           <span class="font-weight-bold">Имя пользователя: </span> {{$user->name}}
        </div>
        <div class="mt-3">
           <span class="font-weight-bold">Email пользователя: </span> {{$user->email}}
        </div>
<<<<<<< HEAD
        <form method="POST" action="{{ route('users.destroy', $user) }}" class="mt-4">
            <a type="button" class="btn btn-warning" href="{{ route('users.edit', $user) }}">Редактирование</a>
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Удалить</button>
        </form>
=======
>>>>>>> origin/master
    </div>
@endsection
