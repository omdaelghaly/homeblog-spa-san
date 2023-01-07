


<template>
	
<div>





    <div id="registercontainer" class=" col-xl-4  col-lg-6  col-md-9 col-sm-12 my-2" style="margin:0 auto">
        <div id="register">



            <h2 class="text-center"> {{ this.$store.getters.lang.register }}    </h2>
        <br>


            <p id="notifysuccess" v-if="success"  class="btn-success text-center" >  {{ this.$store.getters.lang.notifysuccess }}   </p>
            <p id="notifyerror" v-if="error"  class="btn-danger text-center" >  {{ this.$store.getters.lang.notifyerror   }}</p>
            

            <br><br>
              <form id="newregister"  v-on:submit.prevent="register" class="form-group" method="POST"  action="" enctype="multipart/form-data"  >

<!--                <input hidden  type="text" value="{{csrf_token()}}" id="token" name="_token">
 -->
                <div class="form-group" >
                    <div class="p-0 m-0" style="display:flex">
                        <label class="form-label my-auto  p-0 ml-3" for="name"><i style="color:green;font-size:30px" class="fa fa-user  p-0 m-0"></i></label>
                        <input type="text" v-model="user.name" @keyup="RT" @keydown="resetRT" name="name" id="name" class="form-control" :placeholder="placeholdertext(this.$store.getters.lang.name)" >
                        <span v-if="user.name && !errors.name"><i class="fa fa-check" style="color:green;font-size:25px"></i></span>
                   </div>

                    <center>  <span id="name_error" class="text-danger  error "  v-if="errors.name">{{errors.name[0]}}</span> </center>
                </div>


                <div class="form-group" >
                      <div style="display:flex">
                         <label class="form-label my-auto p-0 ml-3" for="email"><i style="color:green;font-size:30px" class="fa fa-envelope  p-0 m-0"></i></label>
                         <input class="form-control" v-model="user.email" @keyup="RT" @keydown="resetRT" name="email" autocomplete="old-email" id="email" type="email" :placeholder="placeholdertext(this.$store.getters.lang.email)" required>
                          <span v-if="user.email && !errors.email"><i class="fa fa-check"  style="color:green;font-size:25px"></i></span>
                      </div>

                      <center>  <span id="email_error" class="text-danger error  "  v-if="errors.email">{{errors.email[0]}}</span> </center>
                </div>


                <div class="form-group" >
                       <div style="display:flex">
                          <label class="form-label my-auto p-0 ml-3" for="password"><span><i style="color:green;font-size:30px" class="fa fa-lock  p-0 m-0"></i></span></label>
                          <input class="form-control" v-model="user.password" @keyup="RT" @keydown="resetRT" name="password" autocomplete="new-password" id="password" type="password" :placeholder="placeholdertext(this.$store.getters.lang.inputpassword)" required>
                          <span v-if="user.password && !errors.password"><i class="fa fa-check" style="color:green;font-size:25px"></i></span>
                      </div>

                     <center> <span id="password_error" class="text-danger error  "   v-if="errors.password">{{errors.password[0]}}</span> </center>
                </div>



                <div class="form-group" >
                        <div style="display:flex">
                           <label class="form-label my-auto p-0 ml-3 " for="confirmpwd"><i style="color:green;font-size:30px" class="fa fa-lock  p-0 m-0"></i></label>
                           <input type="password" v-model="user.confirmpwd" @keyup="RT" @keydown="resetRT" autocomplete="new-password" name="confirmpwd" id="confirmpwd" class="form-control" :placeholder="placeholdertext( this.$store.getters.lang.inputconfirmpassword )" required>
                           <span v-if="user.confirmpwd && !errors.confirmpwd"><i class="fa fa-check" style="color:green;font-size:25px"></i></span>
                        </div>

                      <center>  <span id="confirmpwd_error" class="text-danger error " v-if="errors.confirmpwd">{{errors.confirmpwd[0]}}</span></center>
                </div>


                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-success w-100 form-control" id="registerbtn">{{  this.$store.getters.lang.btnsubmitregister }}</button>
                </div>

            </form>


            <br>
            <center>
                  <router-link to='/Login' class="nav-link" >  {{  this.$store.getters.lang.alreadyhaveaccount }} </router-link>
            </center>



          </div>
       </div>
  </div>
</template>




<style>
    #registercontainer {
        border-radius: 70px 0px 70px;
        background-color: skyblue;
        margin-top: 100px;
        direction: rtl;
        box-shadow: 10px 10px 5px #aaaaaa;
    }

    #register {
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
.fa-sold{
    color:red;
    background: green;
    font-size: 30px 
}

</style>


<script type="text/javascript">
    
export default {
// props:['lang','mysite'],
     data(){
        return{
              user:{
                name:'',
                email:'',
                password:'',
                confirmpwd:'',
              } ,
              errors:[],
              error:'',
              success:false,
              start:3000 ,
              countfunc:'',

            
         }
    },
     methods:{
        resetinputs()
        {
            this.user.name = '';
            this.user.email = '';
            this.user.password = '';
            this.user.confirmpwd = '';
        },

         register()
         {
            this.errors='';
            let that = this ;
            axios.post("api/register",this.user)
            .then((response)=>{
            if(response.data.status=='errors')
           {this.errors=response.data.data}
       else{
             console.log('saved successfully');
             this.success=true;
             this.resetinputs();
            // console.log(response.data);
             setTimeout(function(){
               that.success=false;
              that.$router.push("/Login");
             },3000)
         }
            }).catch((errors)=>{
                console.log(errors.response.data.errors);
                    this.errors = errors.response.data.errors;
            });
         } ,

         realtimevalidate()
         {
            axios.post('api/RTregister',this.user)
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
            if(this.user.name !='' ){$('#name_error').show()}else{$('#name_error').hide()};
            if(this.user.email !='' ){$('#email_error').show()}else {$('#email_error').hide()};
            if(this.user.password !='' ) {$('#password_error').show()}else{$('#password_error').hide()};
            if(this.user.confirmpwd !='' ) {$('#confirmpwd_error').show()}else{$('#confirmpwd_error').hide()};
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