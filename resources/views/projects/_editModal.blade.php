<!-- Modal -->
<div class="modal fade" id="editProjectModal-{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="editProjectModal-{{ $project->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModal-{{ $project->id }}">编辑项目</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::model($project,['route'=>['projects.update',$project->id],'method'=>'PATCH','files'=>true]) !!}
            <div class="modal-body">

                <div class="form-group">
                    {!! Form::label('name','项目名称:') !!}
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                    {!! $errors->getBag('update-'.$project->id)->first('name',
                    '<div class="alert alert-danger">:message</div>') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('thumbnail','项目缩略图:') !!}
                    {!! Form::file('thumbnail',
                    ['class'=>'form-control-file']) !!}
                    {!! $errors->getBag('update-'.$project->id)->first('thumbnail',
                    '<div class="alert alert-danger">:message</div>') !!}
                </div>

                {{--@include('errors._errors')--}}
                {{--@if($errors->getBag('update-'.$project->id)->any())--}}
                    {{--<ul class="alter alert-danger">--}}
                        {{--@foreach($errors->getBag('update-'.$project->id)->all() as $error)--}}
                            {{--<li>{{ $error }}</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--@endif--}}


            </div>
            <div class="modal-footer">

                {!! Form::submit('编辑项目', ['class'=>'btn btn-primary']) !!}

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>