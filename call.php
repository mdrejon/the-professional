<?php
session_start();
require_once("function.php"); 
$db = new database();
$room_id = $_GET['room']; 
$joinroom_id = $_GET['joinroom']; 
$user_id = $_GET['user']; 
 ?>

<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
	<!-- mobile responsive meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Seo Tags -->
	<meta name="description" content="Directory" />
	<meta name="keywords" content="Directory"/>
	<!-- <meta name="robots" content="index, follow">  -->

	<link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/mmenu.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/all.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/owl.carousel.min.css"> 

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/jquery.animatedheadline.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/bootstrap-tagsinput.css">
 <!--    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/intlTelInput.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/nice-select.min.css"> -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/dropify.min.css">
    <!-- <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/typehead-min.css"> -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/call.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/style-new.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/responsive.css">
    <!-- <link rel="stylesheet" href="<?php echo SITE_URL ?>assets/css/responsive-2.css"> -->

     <script src="https://maps.google.com/maps/api/js?key=AIzaSyBLqyqBMRgUe1VQg4ZozSH8ZzM7V39orrg&libraries=places&language=en"></script>


	<script src="<?php echo SITE_URL ?>assets/js/jquery-1.12.4.min.js"></script>

	<title><?php echo SITE_NAME; ?></title>
</head>
<body>
	<?php if (isset($user_id) || $user_id !=''): ?>
		<?php 
			 $query = "SELECT * FROM   ".$db_suffix."member  WHERE  member_id = '".$user_id."' limit 1";
			$member_sql = $db->select($query);
			$member = mysqli_fetch_object($member_sql);
		 ?>
	<?php endif ?>
<input type="hidden" id="roomNumber" value="<?php echo $room_id ?>" name="">
<?php if (isset($joinroom_id) && !empty($joinroom_id)): ?>
    <input type="hidden" id="joinroom_id" value="<?php echo $joinroom_id ?>" name="">
<?php endif ?>
<input type="hidden" id="userid" value="<?php echo $user_id ?>" name="">
<section class="call">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-xl-12 col-md-12">
				<div class="call-worap d-table">
					<div class="d-table-cell">
						<img src="<?php echo SITE_URL ?>member/images/<?php echo $member->member_img ?>" alt="user-img">
						<h4><?php echo $member->member_first_name ?> <?php echo $member->member_last_name ?></h4>
						<span id="call-status">
							<?php //echo $_GET['room']; ?>
							<?php //echo $_GET['user']; ?>
						</span>
            <!-- <div id="basicUsage">00:00:00</div> -->
						<div id="consultingRoom">
					    	<video id="remoteVideo" autoplay></video>
						</div>
            <div id="toot-toot"></div>
					</div>
					<div class="call-bar">
						<button class="cencel" id="cencel-call"><span><i class="fas fa-phone-slash"></i></span></button>
            <!-- <button class="cencel" id="redial"><span><i class="fas fa-phone-alt"></i></span></button> -->
					</div>

				</div>
			</div>
		</div>
	</div>
</section>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
 <!-- node ja audio calling -->

    <script src="<?php echo SITE_URL ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo SITE_URL ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo SITE_URL ?>assets/js/jquery.animatedheadline.js"></script>
     <script src="<?php echo SITE_URL ?>assets/js/jquery.magnific-popup.js"></script>
     <script src="<?php echo SITE_URL ?>assets/js/typed.js"></script>
     <script src="<?php echo SITE_URL ?>assets/js/typed-code.js"></script>
    <script src="<?php echo SITE_URL ?>assets/js/jquery.sticky.js"></script>
    <script src="<?php echo SITE_URL ?>assets/js/select2.full.min.js"></script>
    <script src="<?php echo SITE_URL ?>assets/js/bootstrap-select.min.js"></script>
	
	
   <!--  <script src="<?php echo SITE_URL ?>assets/js/bootstrap-tagsinput.min.js"></script>-->
	
    <script src="<?php echo SITE_URL ?>assets/js/infinite-scroll.pkgd.js"></script>
    <!-- <script src="<?php echo SITE_URL ?>assets/js/intlTelInput.js"></script> -->
    <!-- <script src="<?php echo SITE_URL ?>assets/js/jquery.easing.min.js"></script> -->
    <!-- <script src="<?php echo SITE_URL ?>assets/js/popper.min.js"></script> -->
    <!-- <script src="<?php echo SITE_URL ?>assets/js/jquery.nice-select.min.js"></script> -->
    <script src="<?php echo SITE_URL ?>assets/js/dropify.min.js"></script>
    

    <!-- <script src="<?php echo SITE_URL ?>assets/js/plugins.js"></script> -->
    <script src="<?php echo SITE_URL ?>assets/js/typeahead.js"></script>
	
	<script src="<?php echo SITE_URL ?>assets/js/bootstrap-tagsinput.js"></script>
  <!-- <script src="http://albert-gonzalez.github.io/easytimer.js/dist/easytimer.js"></script> -->
  <script src="http://albert-gonzalez.github.io/easytimer.js/dist/examples.min.js"></script>
	
    <script src="<?php echo SITE_URL ?>assets/js/all.min.js"></script>
    <script src="<?php echo SITE_URL ?>assets/js/main.js"></script>
    <script src="<?php echo SITE_URL ?>assets/js/mmenu.js"></script>
    <script type="text/javascript">
// var start = new Date;

// setInterval(function() {
//     $('.Timer').text((new Date - start) / 1000 + " Seconds");
// }, 1000);

    var timerInstance = new easytimer.Timer();

    </script>
  
<?php if (isset($_SESSION['member_id'])): ?>

     <script src="https://cdn.jsdelivr.net/npm/socket.io-client@2/dist/socket.io.js"></script>
    <!-- <script src="<?php echo SITE_URL ?>assets/js/app.js"></script> -->
  <!-- node ja audio calling -->  

  <script type="text/javascript">
function call_status() {
  // alert('receving');
  var userid = $('#userid').val().trim();
  var roomNumber = $('#roomNumber').val().trim();
  var call_status = 1;
     jQuery.ajax({
             url: '<?php echo SITE_URL ?>inc/call/call_status.php',
             type: 'post',
             data: 'json',
             dataType: "json",
            // data: {call_status: call_status},
             data: {userid: userid, roomNumber: roomNumber, call_status: call_status},
            success: function(response){
               // alert(response.call_status);
               if (response.call_status =='2') {
                    $('#call-status').html('connected...');
                    $('#toot-toot').html('');
               }else if(response.call_status =='3'){
                  window.close();
                   
               }else if(response.call_status =='1'){
                  $('#call-status').html('Your are in an aonuter call');
                  // $('#toot-toot').html('Your are in an aonuter call');
               }
            }
        });
}
setInterval(call_status,1000);


  </script>
 <script type="text/javascript">
    $(document).ready(function () {
        $("#cencel-call").click(function(){
          // alert('allah mohan');
            var userid = $('#userid').val().trim();
            <?php if ($joinroom_id !='') {
                ?>
                var roomNumber = $('#joinroom_id').val().trim();
                <?php
                }else{
                ?>
                 var roomNumber = $('#roomNumber').val().trim();
                <?php 
                }
             ?>
            var send = 3;

          if(userid != '' && roomNumber !='' && send =='3'){
             $.ajax({
                url: '<?php echo SITE_URL ?>inc/call/cencel_call.php',
                type: 'post',
                data: 'json',
                dataType: "json",
                data: {userid: userid, roomNumber: roomNumber, send: send},
                success: function(response){
                  if (response.call_status == 3) {
                    // alert(response.call_room_id);
                    destroyroom(response.call_room_id);
                    // alert(response.call_room_id);
                     window.close();
                     // alert(response.call_room_id);
                     // 
                    
                  }
                 }

             });

          }else{

             alert('not get')

          }
        }); 
    
        var socket = io('https://test.xpertsfinder.com/');
        // https://node.notarybd.com/
        socket.on('connect', function () {
            
    });
    socket.on('event', function (data) { });
    socket.on('disconnect', function () { });
    // getting dom elements
    var divSelectRoom = document.getElementById("selectRoom");
    var divConsultingRoom = document.getElementById("consultingRoom");
    var inputRoomNumber = document.getElementById("roomNumber");
    var btnGoRoom = document.getElementById("goRoom");
    var localVideo = document.getElementById("localVideo");
    var remoteVideo = document.getElementById("remoteVideo");
    
    // variables
    var localStream;
    var remoteStream;
    var rtcPeerConnection;
    var mediascreen;
    var bitvalue = 0;
    var recorder;
    var iceServers = {
        'iceServers': [
            { 'urls': 'stun:stun.services.mozilla.com' },
            { 'urls': 'stun:stun.l.google.com:19302' }
        ]
    }
    var streamConstraints = { audio: true, video: false };
    var isCaller;

    
    <?php if ($room_id != '') { ?>
    // var user_busy = 1;
    function user_busy() {
    // alert('user_busy');
    var user_busy = 1;
    var userid = $('#userid').val().trim();
    var roomNumber = $('#roomNumber').val().trim();
    // alert(userid)
       jQuery.ajax({
               url: '<?php echo SITE_URL ?>inc/call/user_busy.php',
               type: 'post',
               data: 'json',
               dataType: "json",
              data: {user_busy: user_busy, userid: userid, roomNumber: roomNumber, },
              success: function(response){
                 // alert(response);
                 if (response.call_status =='4') {
                      $('#call-status').html('not responded');
                      $('#toot-toot').html('');
                      user_busy = 2;
                 }
         

              }
          });
  }
  setInterval(user_busy,25000);
    $("#roomNumber").ready(function () {
        // alert('allah mohan')
        var userid = $('#userid').val().trim();
        var roomNumber = $('#roomNumber').val().trim();
        var send = '1';
        // alert(userid);

        // alert('email')

      if(userid != '' && roomNumber !='' && send =='1'){
        // alert(userid);
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/send_call.php',
            type: 'post',
            data: {userid: userid, roomNumber: roomNumber, send: send},
            success: function(response){
               
                if (response == 1) {
                  $('#call-status').html('Ringing...');
                   $('#toot-toot').html('<audio controls autoplay class="d-none"> <source src="<?php echo  SITE_URL ?>/audio/toot-toot.mp3" type="audio/ogg"> </audio>');
                     next(); 
                    // alert('Connected');
                }
                else if(response == 0 ){
                  // alert('user is not online');
                  $('#call-status').html('user is not online');
                  // window.close();
                }
                else if(response == 2 ){
                   // alert('you are in anouther call');
                   $('#call-status').html('Your are in an aonuter call');
                    // window.close();
                  
                }
                else if(response == 3 ){
                  // $('#call-status').html('Your are in an aonuter call');
                   alert('Your are in an aonuter call');
                   // window.close();
                  
                }
             }

         });
      }else{

         alert('not get')

      }

    });

   



<?php }  ?>
 <?php if ($joinroom_id != '') { ?>

     $("#joinroom_id").ready(function () {
        // alert('allah mohan')
        var userid = $('#userid').val().trim();
        var roomNumber = $('#joinroom_id').val().trim();
         send = '2';
        // alert(userid);

        // alert('email')

      if(userid !='' && roomNumber !='' && send =='2'){
          // next();
        // alert(userid);
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/call/received_call.php',
            type: 'post',
            data: 'json',
            dataType: "json",
            data: {userid: userid, roomNumber: roomNumber, send: send},
            success: function(response){
               // alert(response.call_status);
                if (response.call_status == 2) {
                   $('#call-status').html('connected...');
                    next();
                    // $('#call-status').html('connected...');
                    
                }
                else if(response.call_status == 0 ){
                  alert('user is not online');
                  // window.close();
                   // alert('Connected');
                  
                }
                else{
                  alert('user is not online');
                  // window.close();
                  
                }
             }

         });
      }else{

         alert('not get')

      }

    });
 
<?php }  ?>
    // $("#goRoom").click(function(){
      
    // }); 

    function next() {

        socket.emit('create or join', roomNumber);
    
    }

    // message handlers
    socket.on('created', function (room) {
        console.log('created');
        navigator.mediaDevices.getUserMedia({ audio: true, video: false }).then(function (stream) {
            localStream = stream;
            
            isCaller = true;
        }).catch(function (err) {
            console.log('An error ocurred when accessing media devices', err);
        });
        
    
    });

    socket.on('joined', function (room) {
        console.log('joined');
        navigator.mediaDevices.getUserMedia({ audio: true, video: false }).then(function (stream) {
            localStream = stream;
        
            socket.emit('ready', roomNumber);
        }).catch(function (err) {
            console.log('An error ocurred when accessing media devices', err);
        });
    });

    socket.on('candidate', function (event) {
        var candidate = new RTCIceCandidate({
            sdpMLineIndex: event.label,
            candidate: event.candidate
        });
        rtcPeerConnection.addIceCandidate(candidate);
    });

    socket.on('ready', function () {
        if (isCaller) {
            rtcPeerConnection = new RTCPeerConnection(iceServers);
            rtcPeerConnection.onicecandidate = onIceCandidate;
            rtcPeerConnection.ontrack = onAddStream;
            rtcPeerConnection.addTrack(localStream.getTracks()[0], localStream);            
        
            rtcPeerConnection.createOffer()
                .then(sessionDescription => {
                    rtcPeerConnection.setLocalDescription(sessionDescription);
            socket.emit('offer', {
                type: 'offer',
                sdp: sessionDescription,
                room: roomNumber
            });
        })
        .catch(error => {
            console.log(error)
        })
    }
    });

socket.on('offer', function (event) {
    if (!isCaller) {
        rtcPeerConnection = new RTCPeerConnection(iceServers);
        rtcPeerConnection.onicecandidate = onIceCandidate;
        rtcPeerConnection.ontrack = onAddStream;
        rtcPeerConnection.addTrack(localStream.getTracks()[0], localStream);
        
        rtcPeerConnection.setRemoteDescription(new RTCSessionDescription(event));
        rtcPeerConnection.createAnswer()
            .then(sessionDescription => {
                rtcPeerConnection.setLocalDescription(sessionDescription);
        socket.emit('answer', {
            type: 'answer',
            sdp: sessionDescription,
            room: roomNumber
        });
    })
    .catch(error => {
        console.log(error)
    })
}
});

socket.on('answer', function (event) {
    rtcPeerConnection.setRemoteDescription(new RTCSessionDescription(event));
})

// handler functions
function onIceCandidate(event) {
    if (event.candidate) {
        console.log('sending ice candidate');
        socket.emit('candidate', {
            type: 'candidate',
            label: event.candidate.sdpMLineIndex,
            id: event.candidate.sdpMid,
            candidate: event.candidate.candidate,
            room: roomNumber
        })
    }
}

function onAddStream(event) {
    console.log(event.streams[0]);
    document.getElementById("remoteVideo").srcObject = event.streams[0];
            
    
}
function destroyroom(roomnumber){
  socket.emit('destroy', {            
            room: roomnumber
        });
  
}

});
</script>
<?php endif ?>
</body>
</html>
