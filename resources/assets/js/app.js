
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

window.Vue = require('vue')

const app = new Vue({
    el:'#app',  //根实例，对应到show.blade 里的<div class="container" id="app"> 
    components:{
        'steps':require('./components/steps.vue')
    }         
})