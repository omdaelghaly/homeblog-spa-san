
<template>
  <div class="" >



<div class=" col-12 mb-1 xreply " id="reply.id"    style="direction:rtl;background:white ">
    <div class="row">



<!--                    -head post   -->

<div id="replyinfo" style="background:#edf7f9 ;" class="col-12">
 
  <div style="float:right;display:flex;  ">
      <img :src="getuserimage(reply.getreplyuser.image)"  
         style="width:30px;height:30px;border-radius:50px;    ">
           <span  class="mr-2 text-right mt-1 p-0" style="line-height:.80;" >
               <span class="m-0 p-0" > {{reply.getreplyuser.name}} </span>
        <br class=" m-0 p-0 ">

               <small class="m-0 p-0"> {{reply.created_at}} </small>
           </span>


   </div>


<!-- -          post sitting left option                -->


<div class="navbar col-1 float-left p-0 m-0" v-if="showrepsitting(reply.user_id,this.$store.getters.user.id)" >
<div class="dropdown"  >
  <button class="btn btn- dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <a class="dropdown-item" @click.prevent="deletereply(reply.post_id,reply.comment_id,reply.id)" href="#">delete</a> <a class="dropdown-item" @click.prevent="checkforedit(reply)" href="#">edit</a>
 
  </div>
</div>   
</div>

</div>

<!--  - - - - - - - - - - - - -  - end head  - - - - - --> 
<!--     -  - - - -postbbody   - - - - - -->
<!--    - - - - - - - - -post text   - -  - - - - - -  -->
<!--  -    -    -    - - - -   -->

<div class=" col-12 "
   style="background:white; ">

   <a  >

   <p id="onlypost" class="text-right" v-if="reply.reply">
      {{reply.reply}}
    
 

    </p>
        
        </a>


 </div>  


<!--     - - - - -  - - - - - -postimg - -   - - - - -->
<!-- 

<div id="commentimg" class="col-12 p-0 m-0" 
      v-for="(image,i) in comment.getcommentimages" :key="i" v-if="comment.getcommentimages" >
     <a >
   <img :src=""    style="border-radius:5px;width:100%;height:200px">
    </a>
 </div>  
 -->
<!-- 
<div class="col-12 p-0 m-0 my-0" v-if="showrepfilescontainer(reply.getreplyimages)" >
  <div id="postimg" class="col-12 p-0 m-0" style="position:relative" 
      v-for="(image,i) in reply.getreplyimages" :key="i"  v-if="showrepallimages(i,image.name)" >

          <div id="btnshowallimages" class="text-center" v-if="showrepbtnshowallimg" @click="showrepallimgclick()" >
            <span > {{repbtnshowallimg}}</span> 
          </div>
     <a >
         <img :src="getreplyimages(image.name)"    style="border-radius:5px;width:100%;height:200px">
    </a>
 </div>  
</div> -->

<hr class="mb-0 pb-0  " >


<!---   end postcontainer- - - - -start like coment/share- - -buttons- - - - - - - - - - - -->
<div class=" col-12 mb-3 p-0 m-0 "    style="direction:rtl;display:flex;height:////20px  ">
  
<!--- - - - buttlike-  - - - - - -->

<div style="width:45%" class="text-center" >



<!-- 
                           <span :class="classnamerep(reply.getreplylikes)" 
                            @click="liked =! liked"  class="mr-5">
                            <i class="fa fa-heart" aria-hidden="true"/> 
                            <a style="color:gray" >{{(reply.getreplylikes.length)}}</a>
                           </span> -->

    
</div>


<!--- - - -buttonreply - - - - - - - - - - - - - - - - - - - - - -->
<div style="width:45%" class="text-center" >


        <!--                    <span style="color:gray"  href="javascript:void(0)"
                             @click="replyshow =! replyshow"  class="  mr-5">
                             <i class="fa-solid fa-reply fa-1x" ></i>
                             <a style="color:gray" >{{replys}}</a>
                           </span> -->

</div>




 

</div>

<!-- repments -->
<!-- <div v-if="replytshow" class="col-12">
  <hr class="mt=2  ">

  <comments   v-for="(comment,index) in post.getcomments" :key="index"  :comment="comment"></comments>

</div> -->
 
<!-- end comments -->

</div>
</div>



  </div>
</template>

<style type="text/css">
.liked{
 color:red;
}
.disliked{
 color:gray;
}
  .xcomment{
        box-shadow: 10px 10px 5px gray;
            border-radius:10px;
      }
  hr {
  border: 0;
  clear:both;
  display:block;
  width: 90%;               
  background-color:gray;
  height: 1px;
  
}
.fa-reply ,.fa-heart{
  font-size:18px
}
</style>




<script>

 // import comments from './Comments.vue'

export default {
  // components:{comments},
  props:['reply'],

  data() {
    return {
             myid:'',
             posts:'',
             liked:false,
             likes:0 ,
             replyshow:false,
             showrepallimg:0,
             togal:false,
             repbtnshowallimg:'show all ++',
             showrepbtnshowallimg:false,
             replys:'',
                
            };
  },
  computed:{
     // classname:function(){
     //  return (this.liked)? 'liked' : 'disliked' ;
     // }
  },
  methods: {
      showrepallimgclick(){
         if(!this.togal){
           this.showallimg=50;
           this.togal = true;
           this.btnshowallimg='hide all --' ;    
         }else if(this.togal){
           this.showallimg=0;
           this.togal = false; 
           this.btnshowallimg='show all ++'  ;              
         }
      },
      showrepallimages(i,val){
         if(val){
             if(i===0){
                        return true;
              }else if(i > this.showallimg){
                       this.showbtnshowallimg=true;
                        return false;
              }else{
                        return true;              
                      }
        
         }
     },
       classnamerep(val){
         let x ;
        val.forEach((row)=>{
                    let postuserid = row.user_id ;
                    let userid = this.$store.getters.user.id;
                    // console.log(postuserid +'---'+userid);
            if (postuserid=== userid) { x=true;}else{x=false;}
        })
        return (x)? 'liked' : 'disliked' ;
       },
      showrepfilescontainer(val){
      if(val.length >0){
        return true;
      }else{
        return false;
      }
      console.log(val);
     },
      showrepsitting(postuser,tokenuser){
          if(postuser=== tokenuser){
            return true;
          }else{
            return false;
          }
     },
        getnumreplys(replys){
          return replys.length;
        },
        getuserimage(img) {
         return "images/profiles/"+img;
        },
        getreplyimages(img){
         return "images/posts/images/"+img;
        },
        deletereply(postid,commentid,replyid){
          window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.$store.state.user.token;
          axios.post('api/deletereply',{'postid':postid ,'commentid':commentid ,'replyid':replyid })
          .then((response)=>{
            //console.log(response.data);
          if(response.data.status=='success')
          {
             // save and update posts in vuex store
            let info={'postid':postid ,'commentid':commentid ,'replyid':replyid };
            this.$store.commit('deletereply',info);

            $('#closebtn').click();
             Toast.fire({
             icon: 'success',
             title: response.data.msg,
             });

          }
            
           });
        },

   ///////edit///////
        checkforedit(data){
        let dataedit={'type':'reply','data':data}
        // this.newdataedit = dataedit;
        this.$store.commit('setedit',dataedit);
        // this.editwatch = this.$store.state.edit;
        //console.log(dataedit);
        },     
   
  },
    created(){
         
      
    },
 
};
</script>