

import Vue from 'vue'

import store from './store/store'

import VueRouter from 'vue-router'

Vue.use(VueRouter)



 import home from './components/home/Home'
 import login from './components/Auth/Login'
 import register from './components/Auth/Register'
 import sendverifyemail from './components/Auth/Emailsent'
 import callback_ve from './components/Auth/Callback_ve'
 import forgetpwd from './components/Auth/forgetpwd'
 import callback_pwd from './components/Auth/Callback_pwd'
// import classroom from './components/class/room'

 import myprofile from'./components/profiles/my-profile/Index.vue'

  import notfound from './components/nopage/Notfound'




const routes =[
  
  
    {path:'/login', component:login ,name:'login', meta: { title:'login' },
        beforeEnter:(to,from,next)=>{
          if(store.getters.user){
          	return next({name:'sendverifyemail'});
          }else{
          	return next();
          }
        } 
    },
    {path:'/register', component:register ,name:'register' , meta: { title:'register' },
        beforeEnter:(to,from,next)=>{
          if(store.getters.user){
          	return next({name:'sendverifyemail'});
          }else{
          	return next();
          }
        } 
     },
    {path:'/sendverifyemail', component:sendverifyemail ,name:'sendverifyemail' , meta: { title:'sendverifyemail'},
        beforeEnter:(to,from,next)=>{
            if (store.getters.user.token ) {
         	    if(store.getters.user.verifyemail ==1)
         	      {
         	           return next({name: 'home'});
         	      }else{
         	           return next();
         	      }
            }else{
             return next({name: 'home'});
            }
        }
     },
    {path:'/callback_ve/e/:emailx/t/:tokenx', component:callback_ve ,name:'callback_ve' , meta: { title:'emailVerify'},},

    {path:'/', component:home ,name:'home', 
        beforeEnter:(to,from,next)=>{
            if (store.getters.user ) {
         	    if(store.getters.user.verifyemail ==1)
         	      {
         	           return next();
         	      }else{
         	           return next({name: 'sendverifyemail'});
         	      }
            }else{

                return next();
            }
        }
    },
     {path:'/forgetpwd', component:forgetpwd ,name:'forgetpwd' },
     {path:'/callback_pwd/e/:emailx/t/:tokenx', component:callback_pwd ,name:'callback_pwd' },
     {path:'/myprofile', component:myprofile,name:'myprofile',
        beforeEnter:(to,from,next)=>{
            if (store.getters.user ) {
              if(store.getters.user.verifyemail ==1)
                {
                     return next();
                }else{
                     return next({name: 'sendverifyemail'});
                }
            }else{

                return next({name:'home'});
            }
        }
      },

  //{path:'/callback_ve/e/:email/t/:token', component:callback_ve ,name:'callback_ve' , meta: { title:'emailVerify'  } },

  // {path:'/:classroom', component:classroom ,name:'classroom'},

 
   {path:'/:any', component:notfound ,name:'notfound'},


];




const router = new VueRouter({ 
    mode:'history',
    routes ,    
  });


//router.beforeEach((to, from ,next)=>{
           // if(to.name !== "login" ||to.name !== "register"  )
           // {
               // if(store.state.user)
               // {
               //     	next("/");
               // }else{
               // 	 return next("/sendverifyemail");
               // }
      //     //}
      // if(store.state.user && (to.fullPath != '/login' || to.fullPath != '/register'))
      //  {
      //  	         console.log('To path2: ',"jjjjjjj")

      //    return next()
      //  } else if (to.fullPath == '/login' || to.fullPath == '/register') { 
      //    console.log('To path2: ', to.fullPath)
      //     next()
      //  } else {
      //      return next('/login')
      //   }
           //}
      // if(! store.state.user)
      //  {
       	        
      //  	         console.log('To path2: ',"jjjjjjj")

      //    return next('/register')
      //  } 
      //  else{ 
        
      //      return next('/login')
      //   }

//});

  export default router;