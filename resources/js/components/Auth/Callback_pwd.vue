

<template>

<div >
  


    <div id="verifyform" class="col-xxl-4 col-xl-4  col-lg-6  col-md-9 col-sm-12 my-4" style="margin:0 auto">
    <div id="verify" >



        <h2 class="text-center"> {{this.$store.getters.lang.changepwdform}} </h2>

     <br>
              
     <p id="xsuccess" v-if="success"  class="text-right btn-success text-center" > {{msg}}   </p>
     <p id="xerror" v-if="errorlink" class="text-right btn-danger text-center" >  {{msg}}  </p>     
   
<br>
          
       
    
        <form class="form-group" id="changepwdform"  v-on:submit.prevent="savenewpwd"  >
             
        <!-- <input hidden  type="text" value="{{csrf_token()}}" id="token" name="_token" autocomplete="token"> -->
        <input v-model="data.emailx" hidden type="text" value="" id="tokenx" name="tokenx" autocomplete="tokenx">
        <input v-model="data.tokenx" hidden="" type="text" value="" id="emailx" name="emailx" autocomplete="emailx">


               <div class="form-group" v-if="hidinput"  >
                    <div style="display:flex"  >
                         <label class="form-label my-auto p-0 ml-3" for="password"><span><i style="color:green;font-size:30px" class="fa fa-lock  p-0 m-0"></i></span></label>
                         <input class="form-control" v-model="data.password" @keyup="" name="password" autocomplete="old-password" id="password" :type="showpwd ? 'text' : 'password' " 
                         :placeholder="placeholdertext(this.$store.getters.lang.inputpassword)" required>
                        <span v-if="data.password && error"><i class="fa fa-check" style="color:green;font-size:25px"></i></span>
                    </div>

                     <center> <span id="password_error" class="text-danger error  "   v-if="errors">{{errors}}</span> </center>
               </div>


               <div class="form-group"  v-if="hidinput" >
                    <div style="display:flex"  >
                         <label class="form-label my-auto p-0 ml-3" for="password"><span><i style="color:green;font-size:30px" class="fa fa-lock  p-0 m-0"></i></span></label>
                         <input class="form-control" v-model="data.confirmpwd" @keyup='' name="password" autocomplete="old-password" id="passwordcon" :type="showpwd ? 'text' : 'password' " :placeholder="placeholdertext(this.$store.getters.lang.inputconfirmpassword)" required>
                        <span v-if="data.password && error"><i class="fa fa-check" style="color:green;font-size:25px"></i></span>
                    </div>

                     <center> <span id="password_error" class="text-danger error  "   v-if="errors">{{errors}}</span> </center>
               </div>


                         
                      <div v-if="hidinput"  class="mr-5 text-right">
                        
                          <span  v-show="showpwd" @click="showpwd=!showpwd" >
                               <i class="fa fa-eye-slash"/>
                           </span>

                           <span v-show="!showpwd" @click="showpwd=!showpwd" >
                            <i class="fa fa-eye"/>
                           </span>

                      </div>   

         <br>
                <div class="form-group" v-if="hidinput" >
                    <button id="savenewpwd" class="btn btn-success w-100 form-control" type="submit">{{ this.$store.getters.lang.savenewpwd}}</button>
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
#verifyform{
    border-radius: 70px 0px 70px ;
    background-color: skyblue;
    margin-top:100px;
    direction: rtl;
    box-shadow: 10px 10px 5px gray;
   
    
}
#verify{
    padding:20px
}
.form-label{
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
             data:{
                password:'',
                confirmpwd:'',
                emailx:this.$route.params.emailx,
                tokenx:this.$route.params.tokenx,
             },
             showpwd:false ,
             errors:'',
             success:false,
             error:false,
             errorlink:true,
             msg: this.$store.getters.lang.checklink ,
             hidinput:false,

         }
    },
     methods:{
        savenewpwd()
        {
          // check email link
           axios.post("api/savenewpwd",this.data)
           .then((response)=>{
               if(response.data.status == 'success')
               {
                    // console.log(response.data.msg)
                     this.msg = response.data.msg;
                     this.errorlink = false;
                     this.success = true;
                     setTimeout(()=>{
                         this.$router.push('/login');             
                     },3000)

               }else
               {
                    // console.log(response.data.msg)
                     this.msg = response.data.msg;
                     this.success = false;
                     this.errorlink = true;                     
               }
           })
           .catch((errors)=>{
               console.log(errors.response.data.errors)
           });
        },        
        checklink()
        {
          // check email link
           axios.post("api/callback_pwd_check",{'emailx':this.data.emailx , 'tokenx':this.data.tokenx})
           .then((response)=>{
               if(response.data.status == 'success')
               {
                     console.log(response.data.msg)
                     this.msg = response.data.msg;
                      this.errorlink = false;
                     this.success = true;
                    this.hidinput = true ;


               }else
               {
                     console.log(response.data.msg)
                     this.msg = response.data.msg;
                     this.success = false;
                     this.errorlink = true; 
               }
           })
           .catch((errors)=>{
               console.log(errors.response.data.errors)
           });
        },         
        placeholdertext(transtext)
        {
            return transtext;
        },
     
              
           
       },//end methods
       created()
       {
         this.checklink();
        }
};

</script>