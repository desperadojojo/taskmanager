@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <h3>{{ $task->name }}</h3>
        <div class="row">
            <div class="col-4 mr-4" >
                <div class="card mb-4" v-if="inProcess.length">
                    <div class="card-header">
                        待完成的步骤(@{{ inProcess.length }})：
                        <div class="btn btn-sm btn-success pull-right" @click="completeAll">
                            完成所有</div>
                    </div>             
                    <div class="card-bod">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="(step) in inProcess">
                                <span @dblclick="edit(step)">@{{ step.name }}</span>
                                <span class="pull-right">
                                    <i class="fa fa-check" @click="complete(step)"></i>
                                    <i class="fa fa-close" @click="remove(step)"></i>
                                </span>                                
                            </li>
                            {{--  列表数据渲染用 v-for  --}}
                        </ul>
                    </div> 
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="form-group">
                            <label v-if="! newStep" >添加新的步骤：</label>
                            <input type="text" v-model="newStep" ref="newStep" @keyup.enter="addStep" class="form-control">        
                            {{--  表单双向绑定  --}}
                            {{--  ref 是vue给DOM元素起的索引名称  --}}
                            <button type="submit" class="btn btn-primary" v-if="newStep" @click='addStep'>添加</button>
                        </div>
                    </div>                
                </div>
            </div>
            <div class="col-4">
                <div class="card" v-show="processed.length">
                    <div class="card-header">
                        已完成的步骤(@{{ processed.length }})：
                        <button class="btn btn-sm btn-danger pull-right" @click="clearCompleted">
                            清楚已完成
                        </button>
                    </div>             
                    <div class="card-bod">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="(step) in processed">
                                <span @dblclick="edit(step)">@{{ step.name }}</span>
                                <span class="pull-right">
                                    <i class="fa fa-check" @click="uncomplete(step)"></i>
                                    <i class="fa fa-close" @click="remove(step)"></i>
                                </span>                                
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>        
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
                    { name:'Hello China', completion:false },
                    { name:'Hello China', completion:true }
                ],
                newStep:''
            },

            computed:{
                inProcess(){
                    return this.steps.filter(function(step){
                        return step.completion == false ? true :false
                    })
                },
                processed(){
                    return this.steps.filter((step)=>{
                        return step.completion 
                    })
                }
            },

            {{--  => ES6箭头函数； return函数简单写法  --}}

            methods:{
                addStep: function(){
                    {{--  alert(this.newStep)  --}}
                    this.steps.push({name:this.newStep, completion:false})
                    this.newStep = ''
                },
                complete(step){
                    step.completion = true 
                },
                uncomplete(step){
                    step.completion = false
                },

                {{--  
                    上述两个方法的简化版
                    toggle(step){
                    step.completion = ! step.completion}
                --}}

                remove(step){
                    let i = this.steps.indexOf(step)
                    this.steps.splice(i,1)
                },

                //如果不发生index串用问题，可以用更简便的函数,v-for中提取index
                {{--  remove(index){
                    this.steps.splice(index,1)
                }    --}}
                //注意不能用delete做函数名

                edit(step){
                    //删除当前step
                    this.remove(step)
                    //在输入框中显示当前step的name
                    this.newStep = step.name
                    //focus当前的输入框
                    this.$refs.newStep.focus()
                },

                completeAll(){
                    this.inProcess.forEach((step)=>{
                        step.completion = true
                    })
                },
                
                clearCompleted(){
                    this.steps = this.inProcess
                },
                
                
            }            
        })
    </script>
@endsection