

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
             
                <button @click="userstream" type="button" class="btn btn-primary btn-sm">Small button</button>
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
             currentroom:this.$route.params.classroom,
             user:this.$store.getters.user,
             defaultvideosrc:'',
                      peer :new Peer(this.$route.params.classroom),
                currentPeer:'',
                streamroom:this.$store.getters.streams,


         }
       },
       methods:{
               userstream(){

    let local_stream;
   let room_id = this.currentroom;
          const dataConnection = this.peer.connect(this.$route.params.classroom);

      this.peer.on('open', (id) => {
        console.log("Peer Connected with ID: ", id)
// var getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

 
//         getUserMedia({ video: true, audio: true }, (stream) => {
//          local_stream = stream;
//         var video=this.$refs.localref;
//        video.srcObject = stream;
//        video.onloadedmetadata = (e) => {
//                 video.play();
//                 };    
//             }, (err) => {
//             console.log(err)
//         })


            this.answercall();

     });





    

 },
  defaultstream(){
             //this.defaultvideosrc='video/resetstream/video.mp4';
          

  },
  closepeer(){
        
       // this.peer.close();
       call.close()
  },

  answercall(){

  this.peer.on('call', (call) => {
        call.answer(null);
        call.on('stream', (stream) => {
            var vid=this.$refs.localref;
            this.streamroom=stream;
          this.$store.commit('setstream',this.currentroom,stream);
           vid.srcObject =this.streamroom ;
           vid.onloadedmetadata = (e) => {
                vid.play();
                };
        })
        
      // this.currentPeer= call;
    })
  }
 
               

       },
       created(){
      this.defaultstream();
      this.userstream();

        
      


      },
      beforeDestory(){
        this.closepeer();
       },

};
</script>

