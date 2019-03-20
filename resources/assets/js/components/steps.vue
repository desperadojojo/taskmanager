<template>
    <div class="row">
        <div class="col-4 mr-4" >
            <step-list :steps="inProcess" :route="route"></step-list>
            <step-input :route="route" @add="sync"></step-input>
            <!-- 传参是需要解析的动态内容，为了区别静态参数，需要加 : 相当于v-bind缩写  -->
        </div>
        <div class="col-4">
            <div class="card" v-show="processed.length">
                <div class="card-header">
                    已完成的步骤({{ processed.length }})：
                    <button class="btn btn-sm btn-danger pull-right" @click="clearCompleted">
                        清除已完成
                    </button>
                </div>             
                <div class="card-bod">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="step in processed">
                            <span @dblclick="edit(step)">{{ step.name }}</span>
                            <span class="pull-right">
                                <i class="fa fa-check" @click="toggle(step)"></i>
                                <i class="fa fa-close" @click="remove(step)"></i>
                            </span>                                
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>    
    import StepInput from './steps-input'
    import StepList from './step-list'
    import { Hub } from '../event-bus'

    export default {
        props:[
            'route'
        ],
        components:{
            'step-input':StepInput,
            'step-list':StepList
        },
        data(){
            return{
                steps:[
                    // {name:'', completion:false}
                ]                
            }        
        },

        created(){
                this.fetchSteps()            
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

        //  => ES6箭头函数； return函数简单写法  

        methods:{
            fetchSteps(){
                axios.get(this.route).then((res)=>{
                // console.log(res)
                // alert(res.status)
                this.steps = res.data.steps
                }).catch((err)=>{
                    // alert('很抱歉，发生错误，\n'+ err.response.data.message + '\n 错误码：' + err.response.status)
                    // alert(`很抱歉，发生错误，\n ${err.response.data.message} \n 错误码：${err.response.status}`)
                    // console.log(err.response)
                })
            },

            sync(step){
                this.steps.push(step)
            },
            
            
        

            remove(step){
                axios.delete(`${this.route}/${step.id}`).then((res)=>{
                    let i = this.steps.indexOf(step)
                    this.steps.splice(i,1)
                })
                
            },

            //如果不发生index串用问题，可以用更简便的函数,v-for中提取index
            // remove(index){
            //     this.steps.splice(index,1)
            // }    
            //注意不能用delete做函数名

            edit(step){
                //删除当前step
                this.remove(step)
                //在输入框中显示当前step的name
                Hub.$emit('edit',step)
                
            },

            completeAll(){
                axios.post(`${this.route}/complete`).then((res)=>{
                    // this.inProcess.forEach((step)=>{
                    // step.completion = true
                    // })
                    this.fetchSteps()   //根据实际情况对比哪种方法更耗时
                })
            },
            
            clearCompleted(){
                axios.delete(`${this.route}/clear`).then((res)=>{
                    this.steps = this.inProcess
                })                
            },           
        }  
    }
</script>

<style>

</style>


