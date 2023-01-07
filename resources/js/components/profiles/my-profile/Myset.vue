
<template>
	<div class="p-0 m-0">
		
     





<div class="p-0 m-0">
    <div class="main-body " >
    
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm" >

            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                  	    <div>
                  	    <img id="proimg" :src="setprofileimage(user.image)" alt="user image" 
                          class="rounded-circle" width="180" height="180" ref="proimg"  style="position:relative">
                          <a href="" v-show="img" @click.prevent="clearandset(user.image)" style="position:absolute">X</a>
                  	    </div>


                    <div class="mt-3">
                      <h4 id="fullnamep">{{user.name}}</h4>
                      <p  id="jobp"  class="text-secondary mb-1">{{user.job}}</p>
                      <p id="aboutp" class="text-muted font-size-sm">{{user.about}}</p>
                      <div class="btn btn-primary">𝔐.𝔈𝔫𝔤.𝔖𝔲𝔭𝔢𝔯𝔳𝔦𝔰𝔦𝔬𝔫</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>



            <div class="col-md-8" style="direction:rtl">
              <div class="card mb-3">
                <div class="card-body text-right" >
                  <div class="row col-12 p-0 m-0" style="display:flex;">
                      <span class="col-3 my-auto pr-2  ">Full Name</span>
                     
                       <div class="col-9 p-0 m-0" >
                             <input type="text" @keyup="checklength(user.name,20)"  name="name" class="col-12 p-0 m-0 form-control border-0 pr-2 " v-model="user.name">                     	
                       </div>

                  </div>
                  <hr>

                 <div class="row col-12 p-0 m-0" style="display:flex;">
                  
                      <span class="col-3 my-auto pr-2  ">Password</span>
                     
                       <div class="col-9 p-0 m-0" >
                             <input type="text"  name="Password" disabled class="col-12 p-0 m-0 form-control border-0 pr-2 " v-model="user.Password" >                     	
                       </div>

                  </div>
                  <hr>

                  <div class="row col-12 p-0 m-0" style="display:flex;">
                  
                      <span class="col-3 my-auto pr-2  "> Email </span>
                     
                       <div class="col-9 p-0 m-0" >
                             <input type="text"  name="email" disabled class="col-12 p-0 m-0 form-control border-0 pr-2 " v-model="user.email" >                     	
                       </div>

                  </div>
                  <hr>
               
                <div class="row col-12 p-0 m-0" style="display:flex;">
                  
                      <span class="col-3 my-auto pr-2 "> Job </span>
                     
                       <div class="col-9 p-0 m-0" >
                             <input type="text" @keyup="checklength(user.job,20)"  name="job" class="col-12 p-0 m-0 form-control border-0 pr-2 " v-model="user.job">                     	
                       </div>

                  </div>
                  <hr>

                  <div class="row col-12 p-0 m-0" style="display:flex;">
                  
                      <span class="col-3 my-auto pr-2  ">About</span>
                     
                       <div class="col-9 p-0 m-0" >
                             <input type="text" @keyup="checklength(user.about,50)"   name="about" class="col-12 p-0 m-0 form-control border-0 pr-2 " v-model="user.about">                     	
                       </div>

                  </div>
                  <hr>

                  
                   <div class="row col-12 p-0 m-0" style="display:flex; ">
                      <span class="col-3 my-auto pr-2" >Profile image </span>
                         <div class="col-9 p-0 m-0" >
 
                              <a href="" @click.prevent="upimage('fileup')" href="" id="upimg"
                                 style="color:green"> upload photo
                             	 <i class="fas fa-upload" style="font-size:20px "></i>
                               </a>
                           <input type="file"  hidden id="fileup" ref="image" name="image"  accept=".png, .jpg, .jpeg"
                            @change="setimageRT"  /> 

                            <img v-show="img" :src="img" class="p-0 m-0" width="50px" height="50px">  
                          </div>
                                     
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-12">
                       <center>
                         <button type="button" @click="updatemyinfo()" class="btn btn-info col-6" ref="saveinfo" >
                                          	Save 
                         </button>   
                       </center> 
                    </div>              
                                          
                                             


                  </div>

                </div>
              </div>





            </div>
          </div>

        </div>
    </div>




	</div>
</template>



<script>

export default {
  
        data(){
            return{
                  
                 img:'',
                 myimage:'',
                

            }  
      },
     computed:{
          user(){
              return this.$store.getters.user  ;
           },

     },
     methods:{
     	 checklength(val,num){
           if(val.length > num){
           	alert(' عدد الاحرف والارقام المسموح به  هو  '+num);
           	this.$refs.saveinfo.disabled=true;
           }else{
           	this.$refs.saveinfo.disabled=false;
           }
     	 },
     	  clearandset(imgurl){
     	  	 this.clearimg();
      		 this.$refs.proimg.src= 'images/profiles/'+imgurl;
      		 this.$refs.image.files[0]='';
     	  },
     	  clearimg(){
     	  	this.img='';
     	  },//
          setprofileimage(img){
               return 'images/profiles/'+img;
          },//
          setimageRT(e){
          	  if(this.$refs.image.files[0].size > 50000){
          	  	alert('حجم الصورة كبير  عن الحد المسموح بة ');
          	  	 this.$refs.image.files[0]='';
          	    return false;

          	  }else
          	  {
          	         this.myimage = this.$refs.image.files[0]; 	
             var tmppath = URL.createObjectURL(e.target.files[0]);
               this.img= tmppath;          	  	
          	  }

          },//
          upimage(btnid){
          	$('#'+btnid).click();
          },//
      updatemyinfo(){
       window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.$store.state.user.token;
        let newuserupdate = new FormData();
        let that = this;
        //data
            newuserupdate.append('name',this.user.name);
            newuserupdate.append('email',this.user.email);
            newuserupdate.append('Password',this.user.Password);
            newuserupdate.append('job',this.user.job);
            newuserupdate.append('about',this.user.about);
            newuserupdate.append('token',this.user.token);
        //image
          if(this.myimage){
               newuserupdate.append("image",this.myimage);
          }
          
 
       axios.post('api/updatemyinfo',newuserupdate).then((response)=>{
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
              let user = response.data.data;
              this.$store.commit('setauth',response.data.data);
              
             console.log(response.data.data)
            $('#closebtn').click();
             Toast.fire({
             icon: 'success',
             title: response.data.msg,
             });

          }
       }).catch((err)=>{
          console.log()
       })
      },///

    



        
      },//
    
      watch:{
      	img:function(imgurl){
      		if(imgurl){
      			this.$refs.proimg.src=imgurl;
      		}
      	}
      },
      
       


      created(){
             this.clearimg();
            },
 
};
</script>
