
<template>
	
    <div id="verifyform" class="col-xxl-4 col-xl-4  col-lg-6  col-md-9 col-sm-12 my-4" style="margin:0 auto">
        <div id="verify">

            <h1 class="text-center"> {{ this.$store.getters.lang.emailcallback}} </h1>
            <div>

                <br>

                        <span id="infosend" class="btn btn-primary text-center">
                          {{this.msg}} 
                        </span><br><br>

                  
                        <span id="info" v-if="success" :class="classname">
                          {{this.msgres}} 
                        </span><br><br>

                      
                <br>


                <br>


                <br>
              

                <hr>


                <p  class="text-center" id="sendwarn">
                    {{this.$store.getters.lang.emailwarn}}
                </p>
 

            </div>


        </div>

    </div>

</template>

<style type="text/css">
	
            #verifyform {
                border-radius: 70px 0px 70px;
                background-color: skyblue;
                margin-top: 100px;
                direction: rtl;
               box-shadow: 10px 10px 5px gray;

            }

            #verify {
                padding: 20px
            }

            #sendinfo {
                color: green;
                font-weight: bold;
            } 
             #sendwarn {
                color: red;
            }
        
</style>


<script>
  
export default {
// props:['lang','mysite'],
     data(){
        return{
              user:this.$store.getters.user,
              token:this.$store.getters.user.token,
              success:false,
              msg:this.$store.getters.lang.wait,
              msgres:'',
              classname:'',
              emailx:this.$route.params.emailx,
              tokenx:this.$route.params.tokenx,
         }
    },
     methods:{   
        callback_ve()
        {
                  var token=localStorage.getItem('tokenx');
           window.axios.defaults.headers.common['Authorization'] = `Bearer `+token;
           axios.post('api/callback_ve',{emailx:this.emailx,tokenx:this.tokenx})
           .then((response)=>{
             let that = this;
                if(response.data.status=='success')
                { 
                  this.success=true;              
                  this.msgres = response.data.msg;
                  this.classname="btn btn-success text-center";
                  this.$store.commit('setvemail', 1);///update store vuex like database
                  setTimeout(()=>{
                    this.$router.push('/');                                              
                   },4000);
                }else if(response.data.status=='error')
                {
                   this.success=true;              
                   this.msgres = response.data.msg;
                   this.classname="btn btn-danger text-center";
                   setTimeout(()=>{
                    this.$router.push('/sendverifyemail');                                              
                   },4000);
                }

           }).catch((errors)=>{
                   if(this.$route.name!== 'login')
                      {
                         this.$router.push('/login');
                      }
                });
           
        },
       
       
           
       },//end methods
       created()
       {
          setTimeout(()=>{
               this.callback_ve();
          },3000)
        }

      
  


};
</script>