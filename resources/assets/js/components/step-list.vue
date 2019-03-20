<template>
     <div class="card mb-4" v-if="steps.length">
        <div class="card-header">
            待完成的步骤({{ steps.length }})：
            <button class="btn btn-sm btn-success pull-right" @click="completeAll">
                完成所有</button>
        </div>             
        <div class="card-bod">
            <ul class="list-group">
                <li class="list-group-item" v-for="step in steps">
                    <span @dblclick="edit(step)">{{ step.name }}</span>
                    <span class="pull-right">
                        <i class="fa fa-check" @click="toggle(step)"></i>
                        <i class="fa fa-close" @click="remove(step)"></i>
                    </span>                                
                </li>                        
            </ul>
        </div> 
    </div>
</template>

<script>
    export default {
        props:{
            steps:Array,
            route:String
        },
        methods:{
            // complete(step){                
            //     step.completion = true
            // },
            // uncomplete(step){
            //     step.completion = false
            // },            
            // 上述两个方法的简化版
            toggle(step){
                axios.patch(`${this.route}/${step.id}`,{completion:!step.completion})
                    .then((res)=>{
                    step.completion = ! step.completion 
                    })
            },
        }
    }
</script>

