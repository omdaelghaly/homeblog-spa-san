
<template>
    <div class="text-right">

     <!-- -000000000000000000000000000000000000000000 -->
<!-- Button trigger modal -->

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal ">
 Add New Post
</button>

<!-- Modal -->
<form id="postform" action="/savepost" @submit.prevent="savepost"  enctype="multipart/form-data">

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header p-0">
        <h5 class="modal-title " id="exampleModalLabel" style="display:flex">
         <h3 class="ml-2"> Add New Post ..... </h3> <span class="ml-2" id="warnsize" style="color:red"></span>
         </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <!--  -->
                <textarea v-model="post.post" name="post" style="box-shadow: 0px 0px 0px" class="form-control border-0 postbox text-right">
                  
                </textarea>
        <!--  -->
      </div>
      <!-- btnsss -->
      <div id="btns" >

        <div class="btnfile"  >
             <input type="file" hidden multiple   name="image" ref="image" id="imgup"   accept=".png, .jpg, .jpeg" @change="setimages"  />
             <span id="i" @click="clickbtn('imgup')" >
             <i  class="fa fa-images fa-2x" aria-hidden="true"></i></span>
             <span id="numimage">{{numimg}}</span> 

             <input type="file" hidden name="file" ref="file" id="fileup" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf" @change="setfiles" multiple />
             <span id="i" @click="clickbtn('fileup')">
             <i class="fa fa-file fa-2x" aria-hidden="true"></i></span>
             <span id="numfile">{{numfile}}</span> 
        </div>

<!-- <div v-for="item in post.photo">
  {{item.size}}
</div> -->

        <div class="modal-footer">
        <button type="button" @click="clearbtn" class="btn btn-secondary" >Clear</button>
        <button type="button" id="closebtn" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input name="" type="submit"  class="btn btn-primary" value="post" />
        </div>
       
      </div>
      <!-- end btns -->
    </div>
  </div>
</div>

</form>
     <!-- -oooooooooooooooooooooo0000000000 -->
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

    data(){
        return{
              post:{
                   myid:'',
                   post:'',
                   photo:[],
                   file:[],
              },
              errors:[],
              success:false,
              numimg:'',
              numfile:'',
              previewImage:'',
        }
    },
    methods:{
      clickbtn(name){
          $('#'+name).click();
      },
      clearbtn(){
          this.post.post='';this.post.photo=[]; this.post.file=[];this.numimg='';this.numfile='';
      },
      checkimage(){
        $("#warnsize").text('Image size is too big ')
        this.post.photo=[];this.numimg='';
          setTimeout(()=>{
            $("#warnsize").text(' ');
          },5000);
      },
       checkfile(){
        $("#warnsize").text('File size is too big ')
        this.post.file=[];this.numfile='';
          setTimeout(()=>{
            $("#warnsize").text(' ');
          },5000);
      },
      setimages(e){
            this.numimg ='+'+ this.$refs.image.files.length ;
            for (let i = 0; i < this.$refs.image.files.length; i++) {
                  this.post.photo.push(this.$refs.image.files[i]);
                   if(this.$refs.image.files[i].size > 50000)
                   {
                    this.checkimage()
                   }
                };
                  //const file = e.target.files[0];
                  //this.previewImage = URL.createObjectURL(file);
      }, 
      setfiles(e){
            this.numfile ='+'+ this.$refs.file.files.length ;
            for (let i = 0; i < this.$refs.file.files.length; i++) {
                this.post.file.push(this.$refs.file.files[i]);
                if(this.$refs.file.files[i].size > 500000)
                   {
                    this.checkfile()
                   }
                 };
      },
      savepost(){
       window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.$store.state.user.token;
        let newpost = new FormData();
        let that = this;
        //post
            newpost.append('post',this.post.post);
        //photo-s
            for (let w = 0; w < this.post.photo.length; w++) {
            let file = that.post.photo[w];
               newpost.append("image[" + w + "]", file);
             } ;
         //file-s    
             for (let e = 0; e < this.post.file.length; e++) {
            let file = that.post.file[e];
               newpost.append("file[" + e + "]", file);
             } ;
 
       axios.post('api/savepost',newpost).then((response)=>{
          console.log(response.data.data);
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
               this.$store.commit('savepost',post);
              
            // console.log(response.data.data)
            $('#closebtn').click();
             Toast.fire({
             icon: 'success',
             title: response.data.msg,
             });

          }
       }).catch((err)=>{
          console.log()
       })
      },            
    

    },
    created(){
        // window.axios.defaults.headers.common['Authorization'] = `Bearer `+localStorage.getItem('token');
        // axios.get('api/user/').then((response)=>{
        //     this.school.myid = response.data.id

        //     // console.log(this.user);
        // }).catch((errors)=>{
        //     console.log(errors)
        // });
    }


};
</script>