@extends('layouts.app')

@section('content')
    <div class="'container">
        @include('tasks._createForm')

        @include('tasks._list')




    </div>
@endsection