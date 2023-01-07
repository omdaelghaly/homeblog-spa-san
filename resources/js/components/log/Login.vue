<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    logiinn
                    </div>
   <div class="btn btn-sucess form-control " v-if="success" > {{success[0]}}</div>
   <div class="btn btn-danger form-control " v-if="message" > {{message[0]}}</div>

                    <div class="card-body">




<form action="/login" method="post"  v-on:submit.prevent="loginuser">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="text" v-model="form.email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      <span style="color:red" v-if="errors.email">{{errors.email[0]}}</span>
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" v-model="form.password" class="form-control" id="exampleInputPassword1" placeholder="Password">
       <span style="color:red" v-if="errors.password">{{errors.password[0]}}</span>

  </div>
 
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>



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
                          form:{
                              email:'',
                               password:'',
                               device_name:'browser',
                                },
                             errors:[],
                             success:'',
                             message:'',   
                          }
                   },
 methods:{
    loginuser(){
                  this.errors='';
                   this.message='';
                   this.sucess='';
                   axios.post('api/login',this.form)
                   .then((response)=>{
                     localStorage.setItem('token',response.data)
                    // this.form.token=response.data
                    this.$store.commit('userauth',this.form)
                     this.$router.push('/')

                     if(res.data.status=='errorv'){
                       this.errors=res.data.data;}
                     if(res.data.status=='errorauth'){
                     this.message=res.data.data;}
                      if(res.data.status=='sucess'){
                     this.sucess=res.data.data;}
                     
                     }).catch((errors)=>{
                     this.errors=errors.response.data.errors;
                       })
                 }
          },
                 



                    }
</script>