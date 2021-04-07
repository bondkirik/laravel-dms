@extends('layouts.app')

@section('title', $corporation->title)

@section('content')
    <h4>{{ $corporation->title }}</h4>
@endsection
