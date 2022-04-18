
@extends('layouts.main-layout')
@section('content')
    <a class="btn btn-primary mt-3 mb-2" role="button" href="{{ route('info.create') }}">Добавление пользователя</a>
    {{print_r('<br><br>')}}
    {{print_r('<pre>')}}
    {{print_r('</pre>')}}
    {{print_r('<br><br>')}}
    {{print_r('<br><br>')}}
    {{print_r('<br><br>')}}
    {{print_r('<br><br>')}}
    {{print_r($wdwd)}}
    @foreach($infoUsers as $info)
        <div class="border rounded m-2 p-2">
            <form class="form-inline">
                <a href="{{ route('info.show', $info) }}">{{ $info->user->name }}</a>
                <form method="POST" action="{{ route('info.destroy', $info) }}">
                    <a type="button" class="btn btn-warning" href="{{ route('info.edit', $info) }}">Редактирование</a>
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Удалить</button>
                </form>
            </form>
        </div>
    @endforeach
    {{--<table class="table table-sm">
        <thead>
        <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Name</th>
            <th scope="col" class="text-center">Email</th>
            <th scope="col" class="text-center">Actions</th>
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
    {{$users->links('vendor.pagination.bootstrap-4')}}--}}
@endsection
