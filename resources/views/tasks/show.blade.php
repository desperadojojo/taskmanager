@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <h3>{{ $task->name }}</h3>
        <steps route="{{ route('tasks.steps.index',$task->id) }}"></steps>        
    </div>
@endsection

{{--  @section('customJS')  --}}
    {{--  <script src="https://cdn.bootcss.com/vue/2.6.3/vue.js"></script>  --}}
   
{{--  @endsection  --}}