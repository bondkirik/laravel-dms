@extends('layouts.app')

@section('title', $department->title)

@section('content')
    <h2>{{ $department->title }}</h2>

    <form method="post" action="{{ route('departments.save', ['id' => $department->id]) }}">
        {{ csrf_field() }}

        <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label">Title</label>
            <div class="col-sm-9">
                <input name="title" type="text" class="form-control" id="title" value="{{ $department->title }}">
            </div>
        </div>

        <div class="form-group row">
            <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
