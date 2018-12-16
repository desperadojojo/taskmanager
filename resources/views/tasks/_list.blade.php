<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo" role="tab" aria-controls="todo" aria-selected="true">待办事项</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false">已完成</a>
    </li>

</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="todo" role="tabpanel" aria-labelledby="todo-tab">
        
            <table class="table table-striped">
                <tr>
                    <td colspan="4">@include('tasks._createForm')</td>
                </tr>
                @if(count($todos))
                    @foreach($todos as $task)
                        <tr>
                            <td class="col-9 pl-5">{{ $task->name }}</td>
                            <td>@include('tasks._checkForm')</td>
                            <td>@include('tasks._editModal')</td>
                            <td>@include('tasks._deleteForm')</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        
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
        @endif
    </div>

</div>