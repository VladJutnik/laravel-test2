
@extends('layouts.main-layout')
@section('content')
    <a class="btn btn-primary mt-3 mb-2" role="button" href="{{ route('users.create') }}">Добавление пользователя</a>
<table class="table table-sm">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>
                <a href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
            </td>
            <td>
                <a href="{{ route('users.show', $user) }}">{{ $user->email }}</a>
            </td>
            <td>
                <form method="POST" action="{{ route('users.destroy', $user) }}">
                    <a type="button" class="btn btn-warning" href="{{ route('users.edit', $user) }}">Редактирование</a>
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
