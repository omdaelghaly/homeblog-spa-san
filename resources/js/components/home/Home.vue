



<template>
  <div>

 <!-- stat home  -->



<div class="container_fluid " style=" " >
 <div class="row">



     <div class="d-none d-md-none d-lg-block d-xl-block col-xs-12 col-sm-12 col-md-3- col-lg-3 col-xl-3 " 
   style="background:#D5DBDB">
   

   <!-- side bar right -->


 
<div class="container" style="direction: rtl;">
  <br>

  <div class="container" style="background:white ;margin: auto;">
    
    <center>
      <span style="color:green ">𝑀.𝐸𝓃𝑔.𝒮𝓊𝓅𝑒𝓇𝓋𝒾𝓈𝒾𝑜𝓃 𝒾𝓃 𝑀𝑒𝓃𝑜𝓊𝒻𝒾𝒶</span>
    </center>
  </div>
  

<br>
 </div>




<!-- ------------------------- -->

</div>

<div class=" col-xs-12 col-sm-12 col-md-6- col-lg-6 col-xl-6 " 
   style="background:#D5DBDB;">
   
   
<br>
<!-- postbox-->
<postbox></postbox>

<editbox></editbox>

 <!-- 000000000000 -->
<br>

<showposts
   v-for="(post,index) in this.$store.getters.getposts" :key="index"  :post="post" >
  

</showposts>

    </div>

  

<!-- ------------------- -->
   <div class="d-none d-md-none d-lg-block d-xl-block col-xs-12 col-sm-12 col-md-3- col-lg-3 col-xl-3 " 
   style="background:#D5DBDB ">
   

<div class="container" style="direction: rtl;">
  <br>

  <div class="container" style="background:white ">
    
    <center>
      <span style="color:green ">𝑀.𝐸𝓃𝑔.𝒮𝓊𝓅𝑒𝓇𝓋𝒾𝓈𝒾𝑜𝓃 𝒾𝓃 𝑀𝑒𝓃𝑜𝓊𝒻𝒾𝒶mm</span>
    </center>
  </div>
  

<br>
 </div>




  </div>
</div>


</div>



<!-- end home  -->

  </div>
</template>


<style type="text/css">
  .colored-toast.swal2-icon-success {
  background-color:white !important;
  color:green;
}
</style>



<script>
 
 import postbox from './Postbox.vue'
 import editbox from './Editall.vue'
 import showposts from './Showposts.vue'

export default {


props:['lang','mysite'],
components:{postbox,showposts,editbox },
     data(){
        return{
              user:'',
             posts:'',
              
         }
    },
     methods:{
       getposts()
          {
            axios.get('api/getposts').then((response)=>{
               console.log(response.data.data);
             this.posts = response.data.data;
             // save posts in vuex store 
             this.$store.commit('setposts',response.data.data);
             // let objj={'ggg':'jj','ttttt':'yyyyyyy'};
             // this.$store.commit('setcomment',objj);

             // this.posts[0].getcomments[0]  
            })
          },  
          me()
          {
           // window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.token;

            axios.post('api/me',{token:this.token}).then((response)=>{
             // console.log(response.data.data);
              this.user=response.data.data;
            })
          },  
           
//        showAlert() {
      
// Toast.fire({
//   icon: 'error',
//   title: 'Signed in successfully'
// });

//     },


           
       },//end methods
       created()
       {
        //this.me();
        this.getposts()
       },
       
 
         

    

};
</script>