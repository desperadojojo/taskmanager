<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editTask-{{ $task->id }}">
  <i class="fa fa-cog"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="editTask-{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="editTask-{{ $task->id }}-Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editTask-{{ $task->id }}-Label">编辑任务：</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      
      {!! Form::model($task, ['route'=>['tasks.update',$task->id],'method'=>'PATCH']) !!}           

        <div class="modal-body">
          <div class="form-group">
            {!! Form::label('name', '任务名称：') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
            {!! $errors->getBag('update-'.$task->id)->first('name','<div class="alert alert-danger">:message</div>') !!}
          </div>  

          <div class="form-group">
            {!! Form::label('project_id', '所属项目：') !!}
            {!! Form::select('project_id', $projects, null, ['class'=>'form-control']) !!}  
            {!! $errors->getBag('update-'.$task->id)->first('project_id','<div class="alert alert-danger">:message</div>') !!}          
          </div>         
          
        </div>
        <div class="modal-footer">
           
           {!! Form::submit('编辑任务', ['class'=>'btn btn-primary']) !!}
                    
        </div>
      
      {!! Form::close() !!}
      
    </div>
  </div>
</div>