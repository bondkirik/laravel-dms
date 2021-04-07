@extends('layouts.app')

@section('title', $company->title)

@section('content')
    <h4>{{ $company->title }}</h4>
@endsection
