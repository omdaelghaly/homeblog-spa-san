
<template>
  <div class="" >
<!-- 0000000000000000 -->

<!-- <editbox :dataedit="newdataedit"></editbox>
 -->

<!-- 00000000000000000 -->
<div class="col-12 mb-3   xpost " id="post.id"    style="direction:rtl;background:white ">
    <div class="row">

<!--                    -head post   -->

<div id="postinfo"  style="background:skyblue;" class="col-12 ">
 
  <div style="float:right;display:flex;  ">
      <img :src="getuserimage(post.getuser.image)"  
         style="width:50px;height:50px;border-radius:50px;    ">
           <span  class="mr-2 text-right mt-1 p-0" style="line-height: 1.0;" >
               <big class="m-0 p-0" > {{post.getuser.name}} </big>
        <br class=" m-0 p-0 ">

               <small class="m-0 p-0"> {{post.created_at}} </small>
           </span>


   </div>


<!-- -          post sitting left option                -->


<div class="navbar col-1 float-left p-0 m-0" v-if="showpostsitting(post.user_id,this.$store.getters.user.id)" >
<div class="dropdown"  >
  <button class="btn btn- dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" @click.prevent="deletepost(post.id)" href="#">delete</a>
    <a class="dropdown-item" @click.prevent="checkforedit(post)" href="#">edit</a>
   
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

   <p id="onlypost" class="text-right" v-if="post.post">
      {{post.post}}
 

    </p>
        
        </a>


 </div>  


<!--     - - - - -  - - - - - -postimg - -   - - - - -->

<div class="col-12 p-0 m-0 my-0" v-if="showfilescontainer(post.getimages)" >
  <div id="postimg" class="col-12 p-0 m-0" style="position:relative" 
      v-for="(image,i) in post.getimages" :key="i"  v-if="showallimages(i,image.name)" >

          <div id="btnshowallimages" class="text-center" v-if="showbtnshowallimg" @click="showallimgclick()" >
            <span > {{btnshowallimg}}</span> 
          </div>
     <a >
         <img :src="getpostimages(image.name)"    style="border-radius:5px;width:100%;height:100%">
    </a>
 </div>  
</div>


<!--     - - - - -  - - - - - -postfile - -   - - - - -->

<div class="col-12 p-0 m-1 my-0" style="display:flex;"  v-if="showfilescontainer(post.getimages)" >
  <div id="postfile" class="mr-2" 
      v-for="(image,i) in post.getimages" :key="i" v-if="image.file" >
     <a :href="getpostimages(image.file)"  download>
      <div style="width:50px;" class="p-0 m-0">
        <img src="images/posts/files/default.png"    style="border-radius:5px;width:100%">
         <p style="font-size:12px;text-center;" class="p-0 m-0">
           {{getfilename(image.file,i)}} </p>
      </div>
    </a>
    
 </div>  
</div>



<hr class=" mb-2" >


<!---   end postcontainer- - - - -start like coment/share- - -buttons- - - - - - - - - - - -->
<div class=" col-12 mb-3 p-0 m-0 "    style="direction:rtl;display:flex;  ">
  
<!--- - - - buttlike-  - - - - - -->

<div style="width:45% ; " id=""  class="alertyy text-center">



                           <span :class="classname(post.getlikes)" 
                            @click="liked =! liked"  class="mr-5">
                            <i class="fa fa-heart" aria-hidden="true"/> 
                            <a style="color:gray" >{{(post.getlikes.length)}}</a>
                           </span>

    
</div>


<!--- - - -buttoncomment - - - - - - - - - - - - - - - - - - - - - -->
<div style="width:45%" class="text-center" >


                           <span  href="javascript:void(0)" @click="commentshow =! commentshow"
                             class=" mr-5" style="color:gray">
                            <i class="fa fa-comments" aria-hidden="true"/> 
                            <a style="color:gray" >{{getcommentsnum(post.getcomments)}}</a>
                           </span>

</div>




 

</div>

<!-- comments -->
<div v-if="commentshow" class="col-12 pt-0 mb-2 ">
<!--   <hr class="m-0 ">
 --><!-- input insert comment  -->
<div class="col-12"  >
            <center>  <span id="comwarnsize" style="color:orange"> </span> </center>

    <div v-if="this.$store.getters.user" class="border border-dark mb-1 p-1" 
      style="border-radius:10px;display:flex">

      <button  @click="savecomment(post.id,post.getcomments.length)" class="btn btn-primary mx-auto" style="border-radius: 0 10px 10px 10px"> send</button>
      <img :src="getuserimage(this.$store.getters.user.image)" style="width:40px;height:40px;border-radius:50px;">
      <input style="box-shadow: 0px 0px 0px " v-model="comment"  id="comtextid"  type="text" name=""  class="form-control ml-1 border-0" >
      <!-- no multiple now........ use if u want -->
      <input type="file"  hidden name="image" ref="image" id="comimgup" accept=".png, .jpg, .jpeg"
       @change="setcomimages"  />

        <span id="numimage">{{commentnumimages}}</span> 
        <span id="i" @click="clickbtn('comimgup')" > <i class="fa fa-images fa-2x" aria-hidden="true"></i></span>
    </div>
    <div v-else>
         <center><span style="color:orange">   لا يمكنك التعليق لانك غير مسجل ... </span>  </center>
    </div>

       
</div>


<!-- 
<div v-for="item in commentimages">
  {{item.size}}
</div> -->
<!-- - - - -->
  <comments class="m-2"   v-for="(comment,index) in post.getcomments" :key="index"  :comment="comment"></comments>

</div>
 
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
  .xpost{
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
.fa-comments ,.fa-heart{
  font-size:25px
}
#btnshowallimages{
   position:absolute;margin-top:20%;
/*   width:40px;height:40px;
*/   border:1px solid orange; 
   border-radius:50px 0px 0px 50px ;
   padding: 5px;
}
/*.form-control{
        box-shadow: 0px 0px 0px gray;
            border-radius:10px;
}*/
</style>




<script>

 import comments from './Comments.vue'
 import editbox from './Editall.vue'

export default {
  components:{comments,editbox},
  props:['post'],

  data() {
    return {
             myid:'',
             posts:'',
             liked:false,
             likes:0,
             showallimg:0,
             togal:false,
             btnshowallimg:'show all ++',
             showbtnshowallimg:false,
             commentshow:false,
             // comments:6,
             commentnumimages:'',
             commentnumfiles:'',
             commentimages:[],
             commentfiles:[],
             comment:'',
            
            // newedataedit:'',  //editpost
            };
  },
  computed:{
     // classname:function(){
     //  return (this.liked)? 'liked' : 'disliked' ;
     // }
      // edit:function(){
      //   return this.$store.getters.getedit;
      // }
  },
  methods: {
      showallimgclick(){
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
      showallimages(i,val){
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
      classname(val){
         let x ;
        val.forEach((row)=>{
                    let postuserid = row.user_id ;
                    let userid = this.$store.getters.user.id;
                    // console.log(postuserid +'---'+userid);
            if (postuserid=== userid) { x=true;}else{x=false;}
        })
        return (x)? 'liked' : 'disliked' ;
     },
     showfilescontainer(val){
      if(val.length >0){
        return true;
      }else{
        return false;
      }
      console.log(val);
     },
      showpostsitting(postuser,tokenuser){
          if(postuser=== tokenuser){
            return true;
          }else{
            return false;
          }
     },
      getfilename(file,num){
          var parts = file.split('.');
              return 'file'+(num+1)+'.'+parts[parts.length-1];
      },
      clearcommentinput(){
          this.comment='';this.commentimages=[]; this.commentfile=[];this.commentnumimages='';commentnumfiles='';
       },
       checkcomimage(){
          $("#comwarnsize").text('Image size is too big ')
          this.commentimages=[];this.commentnumimages='';
          setTimeout(()=>{
            $("#comwarnsize").text(' ');
          },5000);
        },
        clickbtn(name){
          $('#'+name).click();
        },
        getcommentsnum(comments){
         return comments.length;
        },
        getuserimage(img) {
         return "images/profiles/"+img;
        },
        getpostimages(img){
         return "images/posts/images/"+img;
        },
        getpostfiles(file){
         return "images/posts/files/"+file;
        },

       setcomimages(e){
            this.commentnumimages = this.$refs.image.files.length+'+' ;
            for (let i = 0; i < this.$refs.image.files.length; i++) {
                  this.commentimages.push(this.$refs.image.files[i]);
                   if(this.$refs.image.files[i].size > 50000)
                   {
                    this.checkcomimage()
                   }
                };
                  const file = e.target.files[0];
                  //this.previewImage = URL.createObjectURL(file);
        },
      savecomment(postid,comlength){
       window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.$store.state.user.token;
        let newcomment = new FormData();
        let that = this;
        //post
            newcomment.append('postid',postid);
            newcomment.append('comment',this.comment);
        //photo-s
            for (let w = 0; w < this.commentimages.length; w++) {
            let file = that.commentimages[w];
               newcomment.append("image[" + w + "]", file);
             } ;
         //file-s    
            //  for (let e = 0; e < this.files.length; e++) {
            // let file = that.files[e];
            //    newcomment.append("file[" + e + "]", file);
            //  } ;
 
       axios.post('api/savecomment',newcomment).then((response)=>{
           // console.log(response.data.data);
          // that.posts = this.$store.getters.getposts;
          if(response.data.status=='error')
          {
             Toast.fire({
             icon: 'error',
             title:response.data.msg,
             });
          }else if(response.data.status=='success')
          {
             // save and update posts in vuex store 
            let ncomment = response.data.data;
             let infx ={'postid':ncomment.post_id,'comment':ncomment}
            this.$store.commit('setcomment',infx);
            that.clearcommentinput() ;
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
        deletepost(id){
          window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.$store.state.user.token;
          axios.post('api/deletepost',{'id':id}).then((response)=>{
            //console.log(response.data);
          if(response.data.status=='success')
          {
             // save and update posts in vuex store 
              this.$store.commit('deletepost',id);
              
            //console.log(response.data.msg)
            $('#closebtn').click();
             Toast.fire({
             icon: 'success',
             title: response.data.msg,
             });

          }
            
           });

        },
        checkforedit(data){
        let dataedit={'type':'post','data':data}
        this.newdataedit = dataedit;
        this.$store.commit('setedit',dataedit);
        // this.editwatch = this.$store.state.edit;
        //console.log(dataedit);
        },
        // editpost(data){
        //   window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.$store.state.user.token;
        //   axios.post('api/deletetry',{'id':id}).then((response)=>{
        //     //console.log(response.data);
        //   if(response.data.status=='success')
        //   {
        //      // save and update posts in vuex store 
        //       this.$store.commit('deletepost',id);
              
        //     //console.log(response.data.msg)
        //     $('#closebtn').click();
        //      Toast.fire({
        //      icon: 'success',
        //      title: response.data.msg,
        //      });
        //   }          
        //   });
        // },

        like(postid,ownerid){
          window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.$store.state.user.token;
          axios.post('api/like',{'postid':postid,'ownerid':ownerid}).then((response)=>{
            // console.log(response.data);
          if(response.data.status=='success')
          {
             // save and update posts in vuex store
               if(response.data.msg=='like')
               {
                 let likerow = response.data.data;
                 this.$store.commit('makelike',likerow);
               }else{
                  let rowid = response.data.data;
                  let info={'postid':postid,'rowid':rowid};
                 this.$store.commit('makedislike',info);
               } 

            // this.classname(this.$store.state.posts.find(val=>val.id === postid).getlikes);
          }          
          });
        },
   

  },
    created(){
         // this.setpostlike();
      
    },
    watch:{
            liked:function(val){
              if(this.$store.getters.user){
                    let that = this;
                      if(val){
                            that.like(that.post.id,that.post.user_id);
                      }else{
                            that.like(that.post.id,that.post.user_id);
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