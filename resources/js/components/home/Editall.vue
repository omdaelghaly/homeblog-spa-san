
<template>
    <div class="text-right">

 
<!-- Button trigger modal -->

<button type="button" hidden id="editbtnmodel" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalEDIT ">
  Edit 
</button>

<!-- Modal -->
<form id="postform" action="/editall" @submit.prevent="editall()"  enctype="multipart/form-data">

<div class="modal fade" id="exampleModalEDIT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header p-0">
        <h5 class="modal-title " id="exampleModalLabel" style="display:flex">
         <h3 class="ml-2"> Edit {{editwhat}} ..... </h3> <span class="ml-2" id="warnsize" style="color:red"></span>
         </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <!--  -->
                <textarea type="text" style="box-shadow: 0px 0px 0px"  v-model="post.post" id="area" ref="area" name="edit"  class="form-control border-0 text-right" >
                  
                </textarea >
        <!--  -->
      </div>
      <!-- btnsss -->
      <div id="btns" >

        <div class="btnfile"  >
             <input type="file" hidden :multiple="multiple"   name="imageedit" ref="imageedit" id="imgupedit"   accept=".png, .jpg, .jpeg" @change="setimages"  />
             <span id="i" v-if="inputimg" @click="clickbtn('imgupedit')" >
             <i  class="fa fa-images fa-2x" aria-hidden="true"></i></span>
             <span id="numimageedit">{{numimgedit}}</span> 

             <input type="file" hidden name="fileedit" ref="fileedit" id="fileupedit" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf" @change="setfiles" multiple />
             <span id="i" v-if="inputfile" @click="clickbtn('fileupedit')">
             <i class="fa fa-file fa-2x" aria-hidden="true"></i></span>
             <span id="numfileedit">{{numfileedit}}</span> 
        </div>


        <div class="modal-footer">
        <button type="button" @click="clearbtn" class="btn btn-secondary" >Clear</button>
        <button type="button" id="closebtnedit" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input  name="" type="submit"  class="btn btn-primary" value="Edit" />
        </div>
       
      </div>
      <!-- end btns -->
    </div>
  </div>
</div>

</form>

     <!-- -oooooooooooooooooooooo0000000000 -->
<!--         <button type="button" @click="cl" class="btn btn-secondary" >click me</button>
             <button type="button" @click="cl2" class="btn btn-secondary" >click2 me</button>

 -->
    </div>
</template>

<style type="text/css">
  .postbox{
    width: 100% ;height:100% ;border-radius:10px;padding:5px;
    direction:rtl;    
  }
  .btnfile{
    float:left;display: flex;margin-left:5px;      
  }
  #i{
    margin-left:10px; color:#aaa  
  }
  h3{
  color: coral;
  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}
.postform{
    box-shadow: 10px 10px 5px gray;
    border-radius:10px
}
</style>

<script>
export default {
  props:['dataedit'],
    data(){
        return{
              post:{
                   id:'',   //post/comment/reply ->>> id
                   userid:'',
                   post:'', //post /comment /reply
                   photo:[],
                   file:[],
                   copostid:'', //postid in comment
                   commentid:'',
                   type:'',
              },
              errors:[],
              success:false,
              numimgedit:'',
              numfileedit:'',
              previewImage:'',
              editwhat:'',
              multiple:true,
              inputfile:true,
              inputimg:true,

              //dataeditwatch:'',
        }
    },
     computed: {
           dataeditwatch(){
             return this.$store.getters.getedit;
          },
      },
    methods:{

////////////

      checkimage(){
        $("#warnsize").text('Image size is too big ')
        this.post.photo=[];this.numimgedit='';
          setTimeout(()=>{
            $("#warnsize").text(' ');
          },5000);
      },
       checkfile(){
        $("#warnsize").text('File size is too big ')
        this.post.file=[];this.numfileedit='';
          setTimeout(()=>{
            $("#warnsize").text(' ');
          },5000);
      },

    ///////////////////////////////////////////
      showeditdatainbox(data){
                  this.post.photo =[];
                  this.numimgedit ='';
                  this.post.file  =[];
                  this.numfileedit='';
                  this.editwhat=data.type;

              if(data.type==='post')
              {//set text
                  this.post.post= data.data.post;
                  this.post.id= data.data.id;
                  this.post.userid= data.data.user_id;
                  this.post.type= data.type;
                  this.multiple=true;
                  this.inputfile=true;
                  this.inputimg=true;

                //set images /files
                  // this.$store.getters.getedit.data.getimages.forEach((row)=>{
                  //      if(row.name){
                  //            this.post.photo.push(row.name);
                  //      }else if(row.file){
                  //            this.post.file.push(row.file);              
                  //      }
                  // });                
              }else if(data.type==='comment'){
                  this.post.id= data.data.id;  //comment id
                  this.post.post= data.data.comment;
                  this.post.copostid= data.data.post_id;  //post id
                  this.post.userid= data.data.user_id;
                  this.post.type= data.type;
                  this.multiple=false;
                  this.inputfile=false;
                  this.inputimg=true;


              }else if(data.type==='reply'){
                  this.post.id= data.data.id;  //reply id
                  this.post.post= data.data.reply;
                  this.post.copostid= data.data.post_id;  //post id
                  this.post.userid= data.data.user_id;
                  this.post.commentid= data.data.comment_id;
                  this.post.type= data.type;
                  this.multiple=false;
                  this.inputfile=false;
                  this.inputimg=false;

                   
              }      
      },
      clickbtn(name){
                 $('#'+name).click();
      },
      clearbtn(){
          this.post.post='';this.post.photo=[]; this.post.file=[];this.numimg='';this.numfile='';
      },
      setimages(e){
            this.post.photo=[];
            for (let i = 0; i < this.$refs.imageedit.files.length; i++) {
                  this.post.photo.push(this.$refs.imageedit.files[i]);
                   if(this.$refs.imageedit.files[i].size > 50000)
                   {
                    this.checkimage()
                   }
            }
            this.numimgedit ='+'+this.$refs.imageedit.files.length ;
      }, 
      setfiles(e){
            this.post.file=[];
            for (let i = 0; i < this.$refs.fileedit.files.length; i++) {
                this.post.file.push(this.$refs.fileedit.files[i]);
                if(this.$refs.fileedit.files[i].size > 500000)
                   {
                    this.checkfile()
                   }
            }   
            this.numfileedit ='+'+this.$refs.fileedit.files.length ;
      },
/////////////////
                 ///save edit data
      editall(){
                  let newedit = new FormData();
                  let that = this;
        //text
                  newedit.append('text',this.post.post);
                  newedit.append('id',this.post.id);
                  newedit.append('userid',this.post.user_id);
                  newedit.append('postid',this.post.copostid);
                  newedit.append('commentid',this.post.commentid);
                  newedit.append('type',this.post.type);
        //photo-s
                   for (let w = 0; w < this.post.photo.length; w++) {
                   let file = that.post.photo[w];
                   newedit.append("image[" + w + "]", file);
                   } ;
         //file-s    
                   for (let e = 0; e < this.post.file.length; e++) {
                   let file = that.post.file[e];
                   newedit.append("file[" + e + "]", file);
                   };
                    
            window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.$store.state.user.token;
            axios.post('api/editall',newedit).then((response)=>{
                   // console.log(response.data.data);
                   if(response.data.status=='error')
                   {
                         $('#closebtn').click();
                         Toast.fire({
                         icon: 'error',
                         title:response.data.msg,
                         });
                    }else if(response.data.status=='success')
                    {
             // save and update posts in vuex store 
                          let post = response.data.data;
                        if(response.data.type =='post'){
                            this.$store.commit('editpost',post);
            // console.log(response.data.data)
                           $('#closebtnedit').click();
                           Toast.fire({
                           icon: 'success',
                           title: response.data.msg,
                           });
                       
                        }else if(response.data.type =='comment'){
                          this.$store.commit('editcomment',post);
            // // console.log(response.data.data)
                           $('#closebtnedit').click();
                           Toast.fire({
                           icon: 'success',
                           title: response.data.msg,
                           });

                        }else if(response.data.type =='reply'){
                          this.$store.commit('editreply',post);
            // // console.log(response.data.data)
                           $('#closebtnedit').click();
                           Toast.fire({
                           icon: 'success',
                           title: response.data.msg,
                           });
                        

                        }

                    }
              }).catch((err)=>{
                        // console.log()
               })
       },                


    
    },
    watch:{
         dataeditwatch:function(val){
            if(val){
              this.showeditdatainbox(val);
              $('#editbtnmodel').click();
            }
         }

    },
    created(){
    },


};
</script>