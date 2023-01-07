



<template>
    <div>
        
           <center><span> {{room}}</span></center>

     <div class="container-fluid p-0 m-0">
    <div class="row p-0 m-0  " >
   
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 col-xxl-7 m-0 p-0 " >
                      <videotemplate></videotemplate>

        </div>
        
        <div class="col-sm-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 col-xxl-5 m-0 p-0 " >
  
                        <chattemplate :room="room"></chattemplate>

          </div>

        
   
    </div>
    </div>

</div>
</template>


<script>
import chattemplate from './Chat.vue'
import videotemplate from './Video.vue'

export default {
    components:{
    chattemplate,videotemplate,
    },
        data(){
            return{
                room:this.$route.params.classroom,
                nmsg:'',
                hi:'jjj'
                

            }  
      },
    
     methods:{
     
        
      },
      
      created(){
      
            },
 
}
</script>

