<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">

                    Register Form
                                 </div>

                    <div class="card-body">

   <div class="btn btn-success form-control " v-if="success" > تم التسجيل بنجاح</div>

<form action="/register" method="post" v-on:submit.prevent="register">
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" name="name" v-model="newuser.name" class="form-control" placeholder="Enter name" id="name">
    <span style="color:red" v-if="errors.name">{{errors.name[0]}}</span>
  </div>

   <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" name="email" v-model="newuser.email" class="form-control" placeholder="Enter email" id="email">
      <span style="color:red" v-if="errors.email">{{errors.email[0]}}</span>
  </div>

    <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" name="password" v-model="newuser.password" class="form-control" placeholder="Enter password" id="pwd">
      <span style="color:red" v-if="errors.password">{{errors.password[0]}}</span>
  </div>
  
  <div class="form-group">
    <label for="pwd">confirm Password:</label>
    <input type="password" name="conpass" v-model="newuser.confirm" class="form-control" placeholder="confirm password" id="confpwd">
      <span style="color:red" v-if="errors.confirm">{{errors.confirm[0]}}</span>
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
  data() {
    return {
      newuser: {
                name: "",
                email: "",
                 password: "",
                 confirm: "",
                  },
            errors:[],
            success:false,
                     
            };
           },
  methods: {
    register(){
      this.errors='';
      let that=this;
      axios.post("api/register", this.newuser)
        .then((res) => {
          if(res.data.status=='errors')
           {this.errors=res.data.data}else{
             console.log('saved successfully');
             this.success=true;
             setTimeout(function(){
               this.success=false;
              that.$router.push("/Login");
             },8000)
           };
             });
               },
           },
 
  




};
</script>
