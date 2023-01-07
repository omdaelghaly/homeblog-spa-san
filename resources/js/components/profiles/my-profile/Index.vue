
<template>
	<div>
		
     
<nav>
	<div style="disply:flex">
   
<!--          <button class="btn-sm btn-info " @click.prevent="setcomponent('myset')">Setting</button>
 --><!--          <button class="btn-sm btn-info" @click.prevent="setcomponent('about')">About</button>
         <button class="btn-sm btn-info" @click.prevent="setcomponent('results')">Result</button>
 -->
	</div>
</nav>




<div class=" col-xs-12 col-sm-12 col-md-9- col-lg-9 col-xl-9 p-0 m-0 border-0" 
   style="background:lightgray;">

  <component v-bind:is="currentComponent"></component>
    </div>


   <div class="d-none d-md-none d-lg-block d-xl-block col-xs-12 col-sm-12 col-md-3- col-lg-3 col-xl-3 " 
  style="background:gray;height:; ">


    </div>   






	</div>
</template>



<script>
import myset from './Myset.vue'
import about from './About.vue'
import results from './Results.vue'

export default {
    components:{
    myset,about,results
    },
        data(){
            return{
                currentComponent:'myset'
               
                

            }  
      },   
     methods:{
       setcomponent(val){
        this.currentComponent=val;
       }
        
      },
      
      created(){
      
            },
 
};
</script>

