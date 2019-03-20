<template>
    <div class="card">
        <div class="card-header">
            <div class="form-group">
                <label v-if="! newStep" >添加新的步骤：</label>
                <input type="text" v-model="newStep" ref="newStep" @keyup.enter="addStep" class="form-control">        
                
                <button type="submit" class="btn btn-primary" v-if="newStep" @click="addStep">添加</button>
            </div>
        </div>                
    </div>
</template>

<script>
    import { Hub } from '../event-bus'
    export default {
        props:{
            route:String
        },
        data(){
            return{
                newStep:''
            }
        },
        created(){
            // this.$on('add',()=>{
            //     alert('step added')
            // })
            Hub.$on('edit',this.edit)  //注意这里不要写成this.edit(step)
            
        },

        methods:{
            addStep(){
                //  alert(this.newStep) 
                
                // this.steps.push({name:this.newStep, completion:false})
                // this.newStep = ''
                // console.log(this.inProcess)

                axios.post(this.route,{name: this.newStep}).then( (res)=>{
                    // this.steps.push(res.data.step)
                    this.$emit('add',res.data.step)  //$emit注册事件给父类
                    this.newStep = ''
                    // console.log(this.inProcess)
                }).catch((err)=>{

                })
            },
            edit(step){
                this.newStep = step.name
                //focus当前的输入框
                this.$refs.newStep.focus()
            }

    }
}
</script>

