@extends('layouts.app')

@section('title', $department->title)

@section('content')
    <h4>{{ $department->title }}</h4>
@endsection
