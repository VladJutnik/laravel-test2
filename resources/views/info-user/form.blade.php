@extends('layouts.main-layout')
@section('title', isset($user) ? 'Обновление пользователя: '.$user->name : 'Добавление пользователя')
@section('content')
    <a href="{{route('users.index')}}" class="btn btn-danger mt-2 mb-3">Венуться к списку</a>
    <form
        method="POST"
        @if(isset($user))
        action="{{route('users.update', $user)}}"
        @else
        action="{{route('users.store')}}"
        @endif
    >
        @csrf
        @isset($user)
            @method('PUT')
        @endisset
        <div class="row">
            <div class="col">
                <input name="name" type="text" class="form-control"
                       placeholder="Ваш имя" aria-label="Ваш имя">
                @error('name')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </div>
    </form>
@endsection
