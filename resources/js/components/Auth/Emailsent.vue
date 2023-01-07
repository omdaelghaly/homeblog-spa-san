
<template>
	
    <div id="verifyform" class="col-xxl-4 col-xl-4  col-lg-6  col-md-9 col-sm-12 my-4" style="margin:0 auto">
        <div id="verify">

            <h1 class="text-center"> {{ this.$store.getters.lang.emailv}} </h1>
            <div>

                <br>

                        <span id="infosend" class="btn btn-primary text-center">
                          {{this.msg}} 
                        </span><br><br>

                <p class="text-right" v-if="success">
                    <a :href="myemail_link()" target="_blank" class="btn btn-success"> {{this.$store.getters.lang.gotomyemail}} </a>
                </p>

                <br>


                <br>


                <br>
                <p v-if="success" class="text-right" id="sendinfo">
                    {{ this.$store.getters.lang.sendemailok }}
                </p>


                <hr>


                <p v-if="success" class="text-center" id="sendwarn">
                    {{this.$store.getters.lang.sendwarn}}
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
         }
    },
     methods:{   
        sendverifyemail()
        {
            window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.token;
           axios.post('api/sendverifyemail',{token:this.$store.getters.user.token})
           .then((res)=>{
                if(res.data.status=='success')
                {   
                  this.success=true;            
                  this.msg = res.data.data;
                }else if(res.data.status=='auth')
                {
                 this.$router.push('/');                             
                }

           }).catch((errors)=>{
              if(this.$route.name!== 'login')
                      {
                         this.$router.push('/login');
                      }
                });
        },
        myemail_link()
        {
           return 'https://'+this.$store.getters.user.email ;
        },
      
           
       },//end methods
       created()
       {
          setTimeout(()=>{
               this.sendverifyemail();
          },2000)
        }

      
  


};
</script>