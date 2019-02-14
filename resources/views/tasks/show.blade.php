@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <h3>{{ $task->name }}</h3>
        <ul class="list-group">
            <li class="list-group-item" v-for="step in steps">@{{ step.name }}</li>
            {{--  列表数据渲染用 v-for  --}}
        </ul>

        <input type="text" v-model="newStep" @keyup.enter="addStep" class="form-control">        
        {{--  表单双向绑定  --}}
        <button type="submit" class="btn btn-primary" @click='addStep'>添加</button>
    </div>
@endsection

@section('customJS')
    <script src="https://cdn.bootcss.com/vue/2.6.3/vue.js"></script>
    <script>
        new Vue({
            el:'#app',
            data:{
                steps:[
                    { name:'Hello World', completion:false },
                    { name:'Hello China', completion:false }
                ],
                newStep:''
            },
            methods:{
                addStep: function(){
                    {{--  alert(this.newStep)  --}}
                    this.steps.push({name:this.newStep, completion:false})
                    this.newStep = ''
                }
            }
            
        })
    </script>
@endsection