@extends('layouts.app')

@section('content')
    <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo" role="tab" aria-controls="todo" 
                        aria-selected="true">
                            待办事项
                            <span class="badge badge-pill badge-danger">{{ count($todos) }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" 
                        aria-selected="false">
                            已完成
                            <span class="badge badge-pill badge-success">{{ count($dones) }}</span>
                        </a>
                    </li>
                
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="todo" role="tabpanel" aria-labelledby="todo-tab">
                        
                        @if(count($todos))    
                            <table class="table table-striped">
                                                            
                                @foreach($todos as $task)
                                    <tr>                                        
                                        <td class="col-9 pl-5">
                                            <span class="badge badge-secondary mr-3">{{ $task->updated_at->diffForHumans() }}</span>  
                                                {{--  laravel利用属性获取器获得updated_at属性并自动转化为Carbon实例，因此可以调用Carbon方法  --}}
                                            {{ $task->name }}
                                        </td>
                                        <td>@include('tasks._checkForm')</td>
                                        <td>@include('tasks._editModal')</td>
                                        <td>@include('tasks._deleteForm')</td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="pull-right">
                                    {{ $todos->links() }}
                            </div>
                            
                        @endif                           
                        
                    </div>
                
                    <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                        @if(count($dones))
                            <table class="table table-striped">
                                @foreach($dones as $task)
                                    <tr>
                                        <td>{{ $task->name }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="pull-right">
                                    {{ $todos->links() }}
                            </div>
                        @endif
                    </div>
                
                </div>
    </div>



@endsection