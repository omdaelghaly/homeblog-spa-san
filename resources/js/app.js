/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 require('./bootstrap');

 // import $ from 'jquery'
 // window.jQuery = window.$ = $;
 
window.Vue = require('vue')

import store from './store/store'

import router from './router'

import Swal from 'sweetalert2'
window.Swal = Swal
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
 
   customClass: {
    popup: 'colored-toast',
     icon: 'iconcolor',
      color: 'color',
  },
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Toast = Toast



import mynavbar from './components/inc/Mynav.vue'








const app = new Vue({

    el: '#app',
    store,
    router,
       components:{
        mynavbar
    },
    
    data(){
        return{
              user:this.$store.getters.user,
              token:this.$store.getters.user.token,
              url:'',
            
        }
    },
    methods:{
      refreshlogin()
        {
          var token=localStorage.getItem('tokenx');
               window.axios.defaults.headers.common['Authorization'] = `Bearer `+token;            
          axios.post('api/autologin',{token:token}).then((response)=>{
                if(response.data.status=='success')
                {
                     this.$store.commit('setauth',response.data.data);
                      var userx=response.data.data;

                     if(this.$router.currentRoute.name!== 'home' )
                     {      
                        if(userx.verifyemail == 1)
                        {
                            this.$router.push('/');             
                        }else
                        {
                            this.$router.push('/sendverifyemail');             
                        }
                     }
                    
                }else{

                       localStorage.removeItem('tokenx');
                      if(this.$router.currentRoute.name!== 'home')
                      {
                          this.$router.push('/');
                      }
                }
            }).catch((errors)=>{
                  var err = errors.response.data.message ;
                  if(err){//unauthenticated  token expired
                      //localStorage.removeItem('tokenx')
                      if(this.$router.currentRoute.name!== 'home')
                      {
                          this.$router.push('/');
                      }
                  }
          });  
        },
        autologin()
        {
          var token=localStorage.getItem('tokenx');
          // console.log(token);
                if(token)
                 {  
                   this.refreshlogin();  
                 }else{
                      if(this.$router.currentRoute.name!== 'home')
                      {
                          this.$router.push('/');
                      }

                }
        },

       

    },//end methods
    created()
    {
      this.autologin();    

    },//end created
  

    

});
