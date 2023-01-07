
<template>
	

<div >
  


    <div id="verifyform" class="col-xxl-4 col-xl-4  col-lg-6  col-md-9 col-sm-12 my-4" style="margin:0 auto">
    <div id="verify" >



        <h2 class="text-center"> {{this.$store.getters.lang.changepwd}}
         </h2>
     
        

     <br>

                     

         <p id="notifyemailsent"  class="text-right btn-success" >     {{msg}}  
         </p>
<br>
         <p v-if="success" class="text-right">
         <a id="gotomyemail"  :href="myemail_link()" target="_blank"  class="btn btn-success"> {{this.$store.getters.lang.gotomyemail}} 
          </a> 
         </p>

         <br>
         <br> 
       
         <p id="info" style="color:blue"  class="text-center"> {{this.$store.getters.lang.notifyemaillink}} </p>
    
        <form class="form-group" id="sendpwdemailform" v-on:submit.prevent="sendpwdemail" >
             
<!--         <input hidden  type="text" value="{{csrf_token()}}" id="token" name="_token">
 -->
                 <div class="form-group" >
                   <div style="display:flex" >
                      <label class="form-label my-auto p-0 ml-3" for="email"><i style="color:green;font-size:30px" class="fa fa-envelope  p-0 m-0"></i></label>
                      <input class="form-control" v-model="email" @keyup="seterror" name="email" autocomplete="old-email" id="email" type="email" :placeholder="placeholdertext(this.$store.getters.lang.email)" required>
                      <span v-if="email && !error"><i class="fa fa-check"  style="color:green;font-size:25px"></i></span>
                   </div>

                   <center v-if="errors && email"> 
                        <span id="email_error" class="text-danger error "  >{{errors}}</span> 
                   </center>
                </div>

             <br>
                <div class="form-group">
                    <button  class="btn btn-success w-100 form-control" id="sendemailpwdbtn">{{ this.$store.getters.lang.btnsubmitforgetpwd}}</button>
                </div>
        </form>



            <center>
                   <router-link to='/Login' class="nav-link" >  {{  this.$store.getters.lang.login }} </router-link>      
            </center>

    </div>
    </div>


  
</div>


</template>


<style>
    #verifyform {
        border-radius: 70px 0px 70px;
        background-color: skyblue;
        margin-top: 100px;
        direction: rtl;
        box-shadow: 10px 10px 5px gray;
    }
    #verify{
        padding: 20px
    }
    .form-label {
        float: right;
    }
    h2 {
  color: coral;
  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}
.form-control{
    box-shadow: 10px 10px 5px gray;
}
</style>


<script >
  
export default {
// props:['lang','mysite'],
     data(){
        return{
              email:'',
              success:false,
              msg:'',
              errors:'',
              error: true ,
         }
    },
     methods:{

        sendpwdemail()
        {
          this.errors='';
        	this.msg = this.$store.getters.lang.wait;
           axios.post("api/pwdsendemail",{'email':this.email})
           .then((response)=>{
           	   if(response.data.status == 'success')
           	   {
                     console.log(response.data.msg)
                     this.msg = response.data.msg;
                     this.success = true;

           	   }else
           	   {
                     console.log(response.data.msg)
                     this.errors = response.data.msg;
                     this.msg = '';

           	   }
           })
           .catch((errors)=>{
           	   console.log(errors.response.data.errors)
           });
        },
      
        myemail_link()
        {
           return 'https://'+this.email ;
        },
             
        placeholdertext(transtext)
        {
            return transtext;
        },
        seterror()
        {
        	if(!this.email)
        	{
        		this.errors="";
        		this.msg="";
        	}
        }
      
           
       },//end methods
       created()
       {
          
        }

      
  


};
</script>