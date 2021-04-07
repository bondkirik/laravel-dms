@extends('layouts.app')

@section('title', $corporation->title)

@section('content')
    <h2>{{ $corporation->title }}</h2>

    <form method="post" action="{{ route('corporations.save', ['id' => $corporation->id]) }}">
        {{ csrf_field() }}

        <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label">Title</label>
            <div class="col-sm-9">
                <input name="title" type="text" class="form-control" id="title" value="{{ $corporation->title }}">
            </div>
        </div>

        <div class="form-group row">
            <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
