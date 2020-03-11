@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Games</div>
                <div class="card-body">
                    <a href="{{ route('manage.users') }}" class="btn btn-info">Spell It Game</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Manage User and Words</div>
                <div class="card-body">
                    <a href="{{ route('manage.users') }}" class="btn btn-dark">Users</a>
                    <a href="{{ route('manage.words') }}" class="btn btn-dark">Words</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
