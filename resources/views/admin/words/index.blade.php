@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Manage Words</div>
                <div class="card-body">
                    <a href="{{ route('spellit.words') }}" class="btn btn-success">Spell it Words</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
