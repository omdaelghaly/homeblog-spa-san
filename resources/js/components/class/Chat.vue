
<template>
  <div>

    <!-- <link rel="stylesheet" href="emojionearea/dist/emojionearea.min.css" /> -->
      <meta charset="UTF-8">

      <!--  bodychat---------------------------------------------- -->
<div class="col-12 border border-dark">
  <div class="row">  
   <!-- ----------------------------------buuton ------------------------------ -->
              <div class="container   " >
                <div style="background:gray">

                 <button @click="btnchat('msgdiv')"  type="button" class="btn btn-primary btn-sm">chat</button>
                <button @click="btnchat('pmdiv')"  type="button" class="btn btn-primary btn-sm">PM</button>
                <button  @click="btnchat('usersdiv')" type="button" class="btn btn-primary btn-sm">users</button>
                </div>
               </div>
      <!-- ---------------------------------------------------------------------- -->
        <div id="chatbody" ref="chatbody" class="chatbody col-12  pl-3 "
          style="height: 430px; overflow-y: scroll; overflow-x:hidden;scroll-behavior: smooth;">
          
          <!-- public---------- -->
  <div v-show="msgdiv">
        <div  id="chatmessage" v-for="(message,index) in messages" :key="index" class="d-flex m-1  " style="overflow-wrap: break-word;">
           <span><h5 style="color:red"> {{message.user.name}}</h5></span>
           <span class=" emojiandtext m-1 px-2" style="background:lightgray;border-radius:0 20px;color:blue; ">
            <h5> {{message.msg}}</h5> </span>
        </div>
                    msg

  </div>   
         <!-- pm -->
         <div v-show="pmdiv">
             pm
         </div>
         
    <!-- admins/////users -->
           <div v-show="usersdiv">
             <div class="text-center" style="color:red">users</div>
            
                         
            <!-- admins -->
             <div v-for="(admin,index) in admins" :key="index">

               <div  class="pl-2" style="color:red;background:skyblue;border-radius:30px"
                   :id="admin._id" @mouseover="adminhover(admin._id)" @mouseleave="adminhoverend(admin._id)"  >
                  <h5 > 
                            {{admin.name}}
                  </h5> 
                </div>
             </div>
            <!-- users -->
              <div v-for="(user,index) in users" :key="index">

               <div class="pl-2" style="color:blue;background:pink;border-radius:30px"
                   :id="user._id" @mouseover="userhover(user._id)" @mouseleave="userhoverend(user._id)"  >
                  <h5 > 
                            {{user.name }}
                  </h5> 
                </div>

               </div>

           </div>
        </div>

        <div class="notify col-12 pl-3">notifyrr
        </div>

      <!-- buton send ---------------------------------->
     

  <div class="container-fluid" >

       <div class="  border border-dark  mx-3 mb-1 p-1  " style="border-radius: 30px;display:flex">

     <input  id="textid"  type="text" name=""  class=" form-control ml-1 border-0" >
     <button  @click="sendmsg"  class="btn btn-primary mx-auto " style="border-radius: 0 30px 30px 30px"> send</button>
       </div>
 
       
       </div>
      <!-- ------------------------------- -->



      
</div>     
</div>
  </div>
</template>





<script>
import emojicss from '/node_modules/emojioneArea/dist/emojionearea.min.css'
import emojionearea from 'emojionearea'

export default {
  emojicss,
  emojionearea,
  props:['room'],
  data() {
    return {
             currentroom:this.$route.params.classroom,
             message:'',
             messages:[],
             user:this.$store.getters.user,
             oldroom:this.$store.getters.oldroom,
             users:'',
             admins:'',
             msgdiv:true,
             pmdiv:false,
             usersdiv:false,
     };
  },
  methods:{
        userhover(id){
        $('#'+id).css({background:'blue',color:'white'})
       },     
         userhoverend(id){
        $('#'+id).css({background:'pink',color:'blue'})
       },     
         adminhover(id){
        $('#'+id).css({background:'#77FF33',color:'#3384FF'})
       },     
         adminhoverend(id){
        $('#'+id).css({background:'skyblue',color:'red'})
       },   
       userhover(id){
        $('#'+id).css({background:'blue',color:'white'})
       },     
         userhoverend(id){
        $('#'+id).css({background:'pink',color:'blue'})
       },
        btnchat(zdiv){
           this.msgdiv=false;this.pmdiv=false;this.usersdiv=false;
          if(zdiv=='msgdiv'){this.msgdiv=true}
          else if(zdiv=='pmdiv'){this.pmdiv=true}
          else  {this.usersdiv=true}
        },
        scrolldown(){
          setTimeout(() => {
          var chatbody= document.getElementById("chatbody");
           chatbody.scrollTop=chatbody.scrollHeight
         }, 1000);

      },
      sendmsg(){
      var msgarea=$("#textid").emojioneArea();
       var aa =$("#textid")[0].emojioneArea.getText();
         socket.emit('msg',aa,this.currentroom,this.$store.getters.user );
         this.message='';
         msgarea[0].emojioneArea.setText('');    

      }
  },
  created(){
          
          if(!this.user){this.$router.push('/')}
          // peer.on('open', function(id) {
 	        //    console.log('My peer ID is: ' +id);
           socket.emit('join-room',this.currentroom,this.$store.getters.user);
           
            // });

            $(document).ready(function () {
             $("#textid").emojioneArea();
               });

                 socket.on('nmsg',(data)=>{
                 this.messages.push(data);
                 this.scrolldown();
                  })
      
     
                       socket.on('user_connected',(data)=>{
                      this.messages.push(data);
                       this.scrolldown();
                         })
                              
                       socket.on('updateusers',(data)=>{
                        this.users= data.users 
                        this.admins= data.admins                                                                             
                         })
                  
                         
                       socket.on('user_disconnected',(data)=>{
                      this.messages.push(data);
                       this.scrolldown();
                         })
            

  
  },
  beforeCreate(){
            if(this.oldroom !=''){ socket.emit('leave-room',this.oldroom)};

  },
   beforeDestroy() {
              socket.emit('leave-room',this.currentroom,this.user)
              this.$store.commit('setoldroom',this.currentroom);

           //console.log('beforeDestroy');
    },
};
</script>

<style>
</style>