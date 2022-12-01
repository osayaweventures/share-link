@extends('statamic::layout')
@section('title', $title)

@section('content')
    <publish-form
        title="Edit Sharelinks Settings"
        action="{{ $action }}"
        :blueprint='@json($blueprint)'
        :meta='@json($meta)'
        :values='@json($values)'
    ></publish-form>

@endsection
