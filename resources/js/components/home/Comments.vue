
<template>
  <div class="" >



<div class=" col-12 mb-2 xcomment " id="comment.id"    style="direction:rtl;background:white ">
    <div class="row">



<!--                    -head post   -->

<div id="commentinfo" style="background: #d0ece7;" class="col-12">
 
  <div style="float:right;display:flex;  ">
      <img :src="getuserimage(comment.getcommentuser.image)"  
         style="width:40px;height:40px;border-radius:50px;    ">
           <span  class="mr-2 text-right mt-1 p-0" style="line-height:.80;" >
               <big class="m-0 p-0" > {{comment.getcommentuser.name}} </big>
        <br class=" m-0 p-0 ">

               <small class="m-0 p-0"> {{comment.created_at}} </small>
           </span>


   </div>


<!-- -          post sitting left option                -->


<div class="navbar col-1 float-left p-0 m-0" v-if="showcomsitting(comment.user_id,this.$store.getters.user.id)" >
<div class="dropdown"  >
  <button class="btn btn- dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" @click.prevent="deletecomment(comment.post_id, comment.id)" href="#">delete</a>
   <a class="dropdown-item" @click.prevent="checkforedit(comment)" href="#">edit</a>

   
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

   <p id="onlypost" class="text-right" v-if="comment.comment">
      {{comment.comment}}
 

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

<div class="col-12 p-0 m-0 my-0" v-if="showcomfilescontainer(comment.getcommentimages)" >
  <div id="postimg" class="col-12 p-0 m-0" style="position:relative" 
      v-for="(image,i) in comment.getcommentimages" :key="i"  v-if="showcomallimages(i,image.name)" >

          <div id="btnshowallimages" class="text-center" v-if="showcombtnshowallimg" @click="showcomallimgclick()" >
            <span > {{combtnshowallimg}}</span> 
          </div>
     <a >
         <img :src="getcommentimages(image.name)"    style="border-radius:5px;width:100%;height:200px">
    </a>
 </div>  
</div>

<hr class="mt-2" >


<!---   end postcontainer- - - - -start like coment/share- - -buttons- - - - - - - - - - - -->
<div class=" col-12 mb-3 p-0 m-0 "    style="direction:rtl;display:flex;height:20px  ">
  
<!--- - - - buttlike-  - - - - - -->

<div style="width:45%" class="text-center" >




                           <span :class="classnamecom(comment.getcommentlikes)" 
                            @click="liked =! liked"  class="mr-5">
                            <i class="fa fa-heart" aria-hidden="true"/> 
                            <a style="color:gray" >{{(comment.getcommentlikes.length)}}</a>
                           </span>

    
</div>


<!--- - - -buttoncomment - - - - - - - - - - - - - - - - - - - - - -->
<div style="width:45%" class="text-center" >


                           <span style="color:gray"  href="javascript:void(0)"
                             @click="replyshow =! replyshow"  class="  mr-5">
                             <i class="fa-solid fa-reply fa-1x" ></i>
                             <a style="color:gray" >{{comment.getcommentreplys.length}}</a>
                           </span>

</div>




 

</div>

<!-- reply -->
<div v-if="replyshow" class="col-12 ">
  <hr class="mt-2  ">

  <!-- input insert comment  -->
<div class="col-12 "  >
            <center>  <span id="comwarnsize" style="color:orange"> </span> </center>

    <div v-if="this.$store.getters.user" class="border border-dark mb-1 p-1 mx-3" 
      style="border-radius:10px;display:flex;height:44px">


      <button  @click="savereply(comment.post_id,comment.id)" class="btn-small btn-primary mx-auto" style="border-radius: 0 10px 10px 10px"> send</button>
      <img :src="getuserimage(this.$store.getters.user.image)" style="width:30px;height:30px;border-radius:50px;">
      <input style="box-shadow: 0px 0px 0px " v-model="reply"  id="comtextid"  type="text" name=""  class="form-control ml-1 border-0" >
      <!-- no multiple now........ use if u want -->
     <!--  <input type="file" hidden name="image" ref="image" id="comimgup" accept=".png, .jpg, .jpeg"
       @change="setreplyimages"  />

        <span id="numimage">{{replynumimages}}</span> 
        <span id="i" @click="clickbtn('repimgup')" hidden> <i class="fa fa-images fa-1x" aria-hidden="true"></i></span> -->
    </div>
    <div v-else>
         <center><span style="color:orange">   لا يمكنك التعليق لانك غير مسجل ... </span>  </center>
    </div>

       
</div>



  <replyx class="mx-4 " v-for="(reply,index) in comment.getcommentreplys" :key="index"  :reply="reply"></replyx>

</div>
 
<!-- end reply -->

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

 import replyx from './Reply.vue'

export default {
  components:{replyx},
  props:['comment'],

  data() {
    return {
             myid:'',
             posts:'',
             liked:false,
             likes:0 ,
             replyshow:false,
             showcomallimg:0,
             togal:false,
             combtnshowallimg:'show all ++',
             showcombtnshowallimg:false,
             comments:'',
             reply:'',
                
            };
  },
  computed:{
     // classname:function(){
     //  return (this.liked)? 'liked' : 'disliked' ;
     // }
  },
  methods: {
      clearreplyinput(){
         this.reply='';
      },
      showcomallimgclick(){
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
      showcomallimages(i,val){
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
       classnamecom(val){
         let x ;
        val.forEach((row)=>{
                    let postuserid = row.user_id ;
                    let userid = this.$store.getters.user.id;
                    // console.log(postuserid +'---'+userid);
            if (postuserid=== userid) { x=true;}else{x=false;}
        })
        return (x)? 'liked' : 'disliked' ;
       },
      showcomfilescontainer(val){
      if(val.length >0){
        return true;
      }else{
        return false;
      }
      console.log(val);
     },
      showcomsitting(postuser,tokenuser){
          if(postuser=== tokenuser){
            return true;
          }else{
            return false;
          }
     },
        getnumcomments(comments){
          return comments.length;
        },
        getuserimage(img) {
         return "images/profiles/"+img;
        },
        getcommentimages(img){
         return "images/posts/images/"+img;
        },
        deletecomment(postid,commentid){
          window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.$store.state.user.token;
          axios.post('api/deletecomment',{'postid':postid,'commentid':commentid}).then((response)=>{
            //console.log(response.data);
          if(response.data.status=='success')
          {
             // save and update posts in vuex store
            let info={'postid':postid,'commentid':commentid}; 
            this.$store.commit('deletecomment',info);

            // console.log(response.data.data)
            $('#closebtn').click();
             Toast.fire({
             icon: 'success',
             title: response.data.msg,
             });

          }
            
           });

        },
         comlike(postid,ownerid,commentid){
          window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.$store.state.user.token;
          axios.post('api/comlike',{'postid':postid,'ownerid':ownerid,'commentid':commentid}).then((response)=>{
             // console.log(response.data);
          if(response.data.status=='success')
          {
             //save and update posts in vuex store
               if(response.data.msg=='like')
               {
                 let likerow = response.data.data;
                 this.$store.commit('makecomlike',likerow);
               }else{
                    let likerow = response.data.data;
                  this.$store.commit('makecomdislike',likerow);
               } 
         }  
          })

          },
     savereply(postid,commentid){
       window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.$store.state.user.token;
        let newreply = new FormData();
        let that = this;
        //post
            newreply.append('postid',postid);
            newreply.append('commentid',commentid);
            newreply.append('reply',this.reply);
        //photo-s
            // for (let w = 0; w < this.commentimages.length; w++) {
            // let file = that.commentimages[w];
            //    newcomment.append("image[" + w + "]", file);
            //  } ;
         //file-s    
            //  for (let e = 0; e < this.files.length; e++) {
            // let file = that.files[e];
            //    newcomment.append("file[" + e + "]", file);
            //  } ;
 
       axios.post('api/savereply',newreply).then((response)=>{
            // console.log(response.data.data);
          that.posts = this.$store.getters.getposts;
          if(response.data.status=='error')
          {
             Toast.fire({
             icon: 'error',
             title:response.data.msg,
             });
          }else if(response.data.status=='success')
          {
             // save and update posts in vuex store 
            let nreply = response.data.data;

             let infx ={'postid':postid,'commentid':commentid ,'reply':nreply};
            this.$store.commit('setreply',infx);
            that.clearreplyinput() ;
             Toast.fire({
             icon: 'success',
             title: response.data.msg,
             });
           //   setTimeout(()=>{
           //   console.log(this.$store.state.posts.find(val=>val.id === postid).getcomments );

           // },3000)

          }

       }).catch((err)=>{
          console.log()
          })
        }, 
///////edit///////
        checkforedit(data){
        let dataedit={'type':'comment','data':data}
        // this.newdataedit = dataedit;
        this.$store.commit('setedit',dataedit);
        // this.editwatch = this.$store.state.edit;
        //console.log(dataedit);
        },


  },
    created(){
         
      
    },
   watch:{
            liked:function(val){
              if(this.$store.getters.user){ // if auth
                    let that = this;
                      if(val){
                          that.comlike(that.comment.post_id,that.comment.user_id,that.comment.id);
                      }else{
                          that.comlike(that.comment.post_id,that.comment.user_id,that.comment.id);

                      }
                                         }else{
                                                       Toast.fire({
                                                       icon: 'warning',
                                                       title: ' قم بالتسجيل اولا  ...',
                                                        })
                                         }
            }

    },   


};
</script>