

<template>
     <div>

          <div id="logincontainer" class=" col-xl-4  col-lg-6  col-md-9 col-sm-12 my-2 " style="margin:0 auto">
             <div id="login">

        <span id="vcx"></span>
        <span id="vc"></span>

             <h2 class="text-center"> {{this.$store.getters.lang.login}} </h2>
            
            <br><br><br>

             <form class="form-group" id="loginform" v-on:submit.prevent="login"  method="POST"  action="\newlogin" enctype="multipart/form-data">

<!--             <input hidden  type="text" value="{{csrf_token()}}" id="token" name="_token">
 -->

                <div class="form-group" >
                   <div style="display:flex" >
                      <label class="form-label my-auto p-0 ml-3" for="email"><i style="color:green;font-size:30px" class="fa fa-envelope  p-0 m-0"></i></label>
                      <input class="form-control" v-model="user.email" @keyup="RT" @keydown="resetRT" name="email" autocomplete="old-email" id="email" type="email" :placeholder="placeholdertext(this.$store.getters.lang.email)" required>
                      <span v-if="user.email && !errors.email"><i class="fa fa-check"  style="color:green;font-size:25px"></i></span>
                   </div>

                   <center>  <span id="email_error" class="text-danger error  "  v-if="errors.email">{{errors.email[0]}}</span> </center>
                </div>




               <div class="form-group" >
                    <div style="display:flex"  >
                         <label class="form-label my-auto p-0 ml-3" for="password"><span><i style="color:green;font-size:30px" class="fa fa-lock  p-0 m-0"></i></span></label>
                         <input class="form-control" v-model="user.password" @keyup="RT" @keydown="resetRT" name="password" autocomplete="old-password" id="password" :type="showpwd ? 'text' : 'password' " :placeholder="placeholdertext(this.$store.getters.lang.inputpassword)" required>
                        <span v-if="user.password && !errors.password"><i class="fa fa-check" style="color:green;font-size:25px"></i></span>
                    </div>

                     <center> <span id="password_error" class="text-danger error  "   v-if="errors.password">{{errors.password[0]}}</span> </center>
               </div>



                     
                     <div style="display:flex" class="mx-5">
                           <div>
                               <input class="mr-" type="checkbox" name="remember" v-model="remember">
                                {{this.$store.getters.lang.rememberme}}
                           </div>

                           <span  v-show="showpwd" @click="showpwd=!showpwd"  class="mr-5">
                               <i class="fa fa-eye-slash"/>
                           </span>

                           <span v-show="!showpwd" @click="showpwd=!showpwd"  class="mr-5">
                            <i class="fa fa-eye"/>
                           </span>
                     </div>   
                   
                <br>

                <div class="form-group">
                    <button type="submit" class="btn btn-success w-100 form-control"  id="loginbtn">  {{this.$store.getters.lang.login}}  </button>
                </div>

            </form>
 
            <br>
                <router-link to='/forgetpwd' class="nav-link" > {{this.$store.getters.lang.forgetmypassword}}  </router-link>

            <br>
            <center>
                   <router-link to='/register' class="nav-link" > {{this.$store.getters.lang.doesthaveaccount}}  </router-link>
            </center>
           


           </div> 
	      </div>

      </div>
</template>


<style>
    #logincontainer {
        border-radius: 70px 0px 70px;
        background-color: skyblue;
        margin-top: 100px;
        direction: rtl;
        box-shadow: 10px 10px 5px gray;
    }
    #login {
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
  
<script type="text/javascript">
    
export default {
// props:['lang','mysite'],
     data(){
        return{
              user:{
                email:'',
                password:'',
              } ,
              errors:[],
              error:'',
              success:false,
              start:3000 ,
              countfunc:'',
              remember:'',
              showpwd:false,

            
         }
    },
     methods:{
        resetinputs()
        {
            this.user.email = '';
            this.user.password = '';
        },

         login()
         {
                    this.errors='';
                    let that = this ;
           axios.post("api/login",this.user)
           .then((response)=>{
               if(response.data.status=='errors')
                {
                  this.errors=response.data;
                  console.log(response.data)
                }else
                {//user
                      this.resetinputs();
                      this.$store.commit('setauth',response.data.data);
                      localStorage.setItem('tokenx',response.data.data.token);
                     // console.log(response.data.data.token);
                      var userx = response.data.data;
                       if(userx.verifyemail == 1)
                        {
                            this.$router.push('/');             
                        }else
                        {
                            this.$router.push('/sendverifyemail');             
                        }
                     
                }
             }).catch((errors)=>{
               // console.log(errors.response.data.errors);
                    this.errors = errors.response.data.errors;
              });
           } ,//end login

      realtimevalidate()
         {
            axios.post('api/RTlogin',this.user)
            .then((response)=>{
                console.log('validate ok')
                this.errors='';
                this.resetRT();
            }).catch((errors)=>{
                    this.errors = errors.response.data.errors;
            })
         },
         RT()
         {
            this.countfunc = setTimeout(()=>{
                 this.realtimevalidate();
                 this.hideerrorinemptyinputs();
                
            },this.start)
         },
         resetRT()
         {
            clearInterval(this.countfunc);
            this.start=3000;
         },

         hideerrorinemptyinputs()
         {
            if(this.user.email !='' ){$('#email_error').show()}else {$('#email_error').hide()};
            if(this.user.password !='' ) {$('#password_error').show()}else{$('#password_error').hide()};
         },
         placeholdertext(transtext)
         {
            return transtext;
         },
       

         isauth()
         {
            // if(this.$store.state.user.token){
            //     this.$router.push('/');
            // }
         }
           
       },//end methods
       created()
       {
        //this.isauth();
       }

  


};
</script>
