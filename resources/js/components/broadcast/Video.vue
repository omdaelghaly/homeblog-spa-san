

<template>
    <div>


  <div class="col-12 border border-dark" >  
    <div class="row">
   
        <div class="col-12  p-0     ">
            
            
         <video id="videoid" autoplay ref="localref" :src="defaultvideosrc" loop   controls muted  style="width:100%;height:450px;object-fit:fill;">
             
             <source src="" type='application/ogg; codecs="bogus"'>
             <source src="" type='application/octet-stream; codecs="bogus"'>
             <source src="" type='video/ogg; codecs="dirac, vorbis"'>
             <source src="" type='video/webm; codecs="vp09"'>
             <source src="" type='video/mp4; codecs="hev1.1.6.L93.B0"'>
             <source src="" type='video/mp4; codecs="mp4v.20.8, mp4a.40.2"'>
    
       
        </video>
              <div class="caption ml-3 mt-1" style="height:80px">
                <button @click="adminstream" type="button" class="btn btn-primary btn-sm">Start Stream</button>
                <button  type="button" class="btn btn-primary btn-sm">Small button</button>
              </div>

        </div>
        
        
          <video id="videoid" autoplay ref="re"  controls muted  style="width:250;height:250px;object-fit:fill;">
             
             <source src="" type='application/ogg; codecs="bogus"'>
             <source src="" type='application/octet-stream; codecs="bogus"'>
             <source src="" type='video/ogg; codecs="dirac, vorbis"'>
             <source src="" type='video/webm; codecs="vp09"'>
             <source src="" type='video/mp4; codecs="hev1.1.6.L93.B0"'>
             <source src="" type='video/mp4; codecs="mp4v.20.8, mp4a.40.2"'>
    
       
        </video>
    </div>
  </div>   

    </div>
</template>



<script>
 
export default {
 // components: { Chat },
       data(){
         return{
             currentroom:this.$store.getters.myroom,
             user:this.$store.getters.user,
             defaultvideosrc:'',
             
         }
       },
       methods:{
         adminstream(){
let currentPeer;
 let room_id = this.currentroom ;
       let peer = new Peer()
       peer.on('open', (id) => {
        console.log("Connected with Id: " + id)
var getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;


        getUserMedia({ video: true, audio: true }, (stream) => {
       var video=this.$refs.localref;
       video.srcObject = stream;
       video.onloadedmetadata = (e) => {
                video.play();
                };

               this.makecall(peer,room_id,stream)
     
        }, (err) => {
            console.log(err)
        })
        
        




    });
    
 },
 makecall(peer,room_id,stream){
           
            let call = peer.call(room_id, stream)
       //      call.on('stream', (stream) => {
       //    var video=this.$refs.localref;
       // video.srcObject = stream;
       // video.onloadedmetadata = (e) => {
       //          video.play();
       //          };
       //      })

                   currentPeer = call;

 },
  defaultstream(){
             this.defaultvideosrc='video/resetstream/video.mp4';
          

  }
 
               

       },
       created(){
      this.defaultstream();

 
 socket.on('user_connected',(data)=>{
                        setTimeout(()=>{
                          this.adminstream();

                        },5000)
                       
                         })

      },

};
</script>

<style>

</style>