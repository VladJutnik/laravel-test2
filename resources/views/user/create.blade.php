
@extends('layouts.main-layout')
@section('content')

        <div class="row">
            <div class="col">
                <input name="name" type="text" class="form-control" placeholder="Name" aria-label="name">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <input name="email" type="text" class="form-control" placeholder="Email" aria-label="email">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <button type="submit" class="btn btn-success">Добавить</button>
            </div>
        </div>
@endsection
