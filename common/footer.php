
<section class="new-footer" style="background-image: url('<?php echo SITE_URL ?>assets/img/footer_bg.jpg');">
<?php 
if (isset($_SESSION['member_id'])) {
   require_once('member/chat.php'); 
}
?>
     
	<div class="new-cta">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-5">
					<span class="cta-icon"><i class="fas fa-bell"></i></span>
					<div class="cta-text">
						<h4>Get Our Newsletters</h4>
						<p>Lorem ipsum dolor sit amet, consectetur</p>

					</div>
				</div>
				<div class="col-lg-7 col-md-7">
					<div class="subscribe-input">
                         <div id="subscribe-done" style="margin-bottom: 10px;"></div>
						<input type="email" required name="subscribe" id="subscribe" placeholder="Enter your Email">
						<input class="subs-button" onclick="addRecord()" type="button" name="submit" placeholder="Submit" value="Submit">

           
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="new-footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="footer-logo">
						<!-- <img src="" alt=""> -->
						<h4></h4>

					</div>
				</div>
			</div>
			<div class="row">
                <?php 
               $menu_query = "SELECT * FROM ".$db_suffix."menu WHERE menu_position='FOOTER' ORDER BY menu_id asc, menu_order asc";
                
                $menu_sql = $db->select($menu_query);
                while ($row = mysqli_fetch_object($menu_sql)): ?>
				<div class="col-lg-3 col-md-3">
					<div class="new-footer-widget">
						<h4 class="new-footer-title">
							<?php echo $row->menu_title; ?>
						</h4>

						<p><?php echo $row->menu_item ?></p>
					</div>
				</div>
            <?php endwhile; ?>
				
			</div>
		</div>
	</div>
	<div class="new-footer-bottom-text">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8">
					<?php echo FOOTER_COPY; ?> | Design & Developed by <a target="_blank" href="http://smartframeworkbd.com/">Smart Framework</a>
				</div>
				<div class="col-lg-4 col-md-4">
          <?php  
                $social_sql = "SELECT * FROM ".$db_suffix."social ORDER BY social_id desc, social_order asc";
                
                $social_query = $db->select($social_sql);?>
					<div class="social-icon text-right">
            <?php while ($row = mysqli_fetch_object($social_query)):  ?>
              
           
						<a href="<?php echo $row->social_url ?>"> <i class="fab <?php echo $row->social_icon ?>"></i></a>
             <?php endwhile; ?>
						<!-- <a href="#"> <i class="fab fa-twitter"></i></a>
						<a href="#"> <i class="fab fa-whatsapp"></i></a> -->
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="modal fade" id="incomming-call" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">incoming call</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
              <div id="from-img" class="call-img">
                
              </div>
              
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
              <div class="call-user">
                <h4 id="from-name"></h4>
                <input hidden="" type="text" id="room_id" name="">
                <input hidden="" type="text" id="from_id" name="">
                <div id="audio_received"></div>
                <!-- <p>Modal body text goes here.</p> -->
              </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <!-- data-dismiss="modal" -->
          <button type="button" id="cencel_call"  class="btn btn-primary" >Decline</button>
          <button type="button" id="accept_call" class="btn btn-secondary">Accept</button>
        </div>
      </div>
    </div>
</div>
<!-- <div class="modal" tabindex="-1" role="dialog">
  
</div> -->
	<?php if (isset($_SESSION['member_id'])): ?>
	<!-- 	<div id="consultingRoom">
	        <video id="remoteVideo" autoplay></video>
	    </div> -->
	<?php endif ?> 
</section>

 	
<!-- <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

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
    <script src="<?php echo SITE_URL ?>assets/js/dropify.min.js"></script>
    
 
    <script src="<?php echo SITE_URL ?>assets/js/typeahead.js"></script>
	
	<script src="<?php echo SITE_URL ?>assets/js/bootstrap-tagsinput.js"></script>
	
    <script src="<?php echo SITE_URL ?>assets/js/all.min.js"></script>
    <script src="<?php echo SITE_URL ?>assets/js/main.js"></script>
    <script src="<?php echo SITE_URL ?>assets/js/mmenu.js"></script>
  
<?php if (isset($_SESSION['member_id'])): ?>
<script> 
  var send = 1;
    function refresh_div() {  
        jQuery.ajax({
             url: '<?php echo SITE_URL ?>inc/chk_call.php',
             type: 'post',
             data: 'json',
             dataType: "json",
            data: {send: send},
            success: function(response){
               
               if (response.call_room_id !='') { 
                 $('#display-area').html();
                 $('#from-img').html('<img src="<?php echo SITE_URL ?>member/images/'+response.member_img+'" alt="sydur">');
                 
                 $('#from-name').html(''+response.member_first_name+' '+response.member_last_name+' is calling you'); 
                  $('#room_id').val(response.call_room_id);
                  $('#from_id').val(response.from_id);
                  // $('#audio_received').html('<audio controls autoplay class="d-none"> <source src="<?php echo  SITE_URL ?>/audio/call-send.mp3" type="audio/ogg"> </audio>');
                  $('#incomming-call').modal('toggle');
                    send = 2;


                 }
                 
            }
        });
    }
    setInterval(refresh_div,1000);


// accept Call
    $("#accept_call").click(function(){
        var userid = $('#from_id').val().trim();
        var roomNumber = $('#room_id').val().trim();
         send = '2';
      if(userid != '' && roomNumber !='' && send =='2'){
        $('#audio_received').html('');
        $('#incomming-call').modal('toggle');

        window.open("https://hostdivine.com/clients/directory-admin/call.php?joinroom="+roomNumber+"&user="+userid+"");
          
          
          send = '1';
        }else{
         alert('not get');
        }
    }); 

// Cencel Call
    $("#cencel_call").click(function(){
      // alert('allah mohan');
        var userid = $('#from_id').val().trim();
        var roomNumber = $('#room_id').val().trim();
         send = 3;
        // alert(userid);

        // alert('email')

      if(userid != '' && roomNumber !='' && send =='3'){
        // window.open("https://hostdivine.com/clients/directory-admin/call.php?joinroom="+roomNumber+"&user="+userid+"");
        // alert(userid);
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/call/cencel_call.php',
            type: 'post',
            data: 'json',
            dataType: "json",
            data: {userid: userid, roomNumber: roomNumber, send: send},
            success: function(response){
             
              if (response.call_status == 3) {
                $('#incomming-call').modal('toggle');
                $('#audio_received').html('');
                send = 1;
              }
             }

         });

      }else{

         alert('not get')

      }
    }); 


</script>
     <script src="https://cdn.jsdelivr.net/npm/socket.io-client@2/dist/socket.io.js"></script>
    <!-- <script src="<?php echo SITE_URL ?>assets/js/app.js"></script> -->
  <!-- node ja audio calling -->  
 <script type="text/javascript">
    $(document).ready(function () {
     
    var socket = io('https://nodejs.xpertsfinder.com/');
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

    
    // function refresh_div() {
    //   // alert('allah mohan');
    //     jQuery.ajax({
    //          url: '<?php echo SITE_URL ?>inc/chk_call.php',
    //          type: 'post',
    //          data: 'json',
    //          dataType: "json",
    //         // data: {userid: userid, roomNumber: roomNumber, send: send},
    //         success: function(response){
    //           alert('mohan')
    //             // jQuery(".result").html(results);
                
    //              // alert('done');
    //          // var obj = $.parseJSON(response);
    //          //      var jsonError = obj.jsonError;
    //          if (response.call_room_id != '' ) {
    //           // alert('allah mohan 2');
    //           roomNumber = response.call_room_id;
    //             // next();
    //          }
    //          // alert(response);
             
    //          // alert(response.call_room_id);

    //         }
    //     });
    // }
    // setInterval(refresh_div,3000);

    // $("#goRoom_id").click(function(){
      $('body').delegate('.goRoom_id2', 'click', function () {
        // alert('allah mohan');
       var userid = $(this).parent().find('.userid').val();
       var roomNumber = $(this).parent().find('.roomNumber').val();
        // alert(roomNumber);
        // var userid = $('.userid').val().trim();

        // var roomNumber = $('.roomNumber').val().trim();
        var send = '1';
        // alert(userid);

        // alert('email')

      if(userid != '' && roomNumber !='' && send =='1'){
      	window.open("<?php echo SITE_URL ?>/call.php?room="+roomNumber+"&user="+userid+"");
        // alert(userid);
         // $.ajax({
         //    url: '<?php echo SITE_URL ?>inc/send_call.php',
         //    type: 'post',
         //    data: {userid: userid, roomNumber: roomNumber, send: send},
         //    success: function(response){
         //        // $('#call_response').html(response);
         //        // alert(response);
         //        if (response == 1) {
         //          // alert('calling')
         //          // roomNumber = roomNumber.value
         //    //  roomNumber = inputRoomNumber.value
         //      next();
         //    //  function next() {
         //    //     socket.emit('create or join', roomNumber);
         //    // }
         //        }
         //        else if(response == 0 ){
         //          alert('user not active')
         //        }
         //     }

         // });

      }else{

         alert('not get')

      }
    }); 
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
    console.log(isCaller);
    document.getElementById("remoteVideo").srcObject = event.streams[0];
            
    
}



});
</script>
<?php endif ?>
    
    <script type="text/javascript">
        

    </script>
    <?php if (isset($_SESSION['member_id'])): ?>
      <input type="hidden" value="<?php echo $_SESSION['member_id']; ?>" id="get_msg_data">
 <!--      <script type="text/javascript">
        $(document).ready(function(){

                 window.setInterval(function () {
                  var get_msg_data = $("#get_msg_data").val();
                  // alert(get_msg_data);
                  var msg_status = 1;
                if (msg_status == 1) {
                  msg_status = 2;
                  $.ajax({
                     url:"<?php echo SITE_URL ?>inc/get_msg_data.php",
                     type:"post",
                      data: {
                        get_msg_data: get_msg_data,

                    },
                    success:function(data){
                       var active = data;
                        console.log(active.trim());
                       if (active.trim() == "active") {
                        // alert(active.trim());
                        $( "#list_show" ).addClass( 'active');
                         
                         // alert(msg_status);
                       }
                    }
                });
                   }
                }, 5000);
             
          });
        </script> -->
    <?php endif ?>

<script>
$(document).ready(function(){
    $('.publisher-input').keyup(function(e){
            alert('done');
            if(e.keyCode == 13)
            {
                alert('done');
                
            }
        });
  $('#searchtypo').typeahead({
      source: function (query, result) {
      	alert("hello2");
          $.ajax({
              url: "<?php echo SITE_URL ?>inc/search.php",
    data: 'query=' + query,
              dataType: "json",
              type: "POST",
              success: function (data) {
      result($.map(data, function (item) {
        return item;
        alert("done");
                  }));
              }
          });
      }
  });
 $('#txtCountry').typeahead({
              source: function (query, result) {
                // alert("echo");
                  $.ajax({
                      url: "<?php echo SITE_URL ?>inc/search.php",
                      data: 'query=' + query,
                      dataType: "json",
                      type: "POST",
                      success: function (data) {
              result($.map(data, function (item) {
                return item;
                          }));
                      }
                  });
              }
          });
 $('#txtCountry3').typeahead({
              source: function (query, result) {
                // alert("echo");
                  $.ajax({
                      url: "<?php echo SITE_URL ?>inc/search.php",
            data: 'query=' + query,
                      dataType: "json",
                      type: "POST",
                      success: function (data) {
              result($.map(data, function (item) {
                return item;
                          }));
                      }
                  });
              }
          });
 $('#txtCountry2').typeahead({
              source: function (query, result) {
                // alert("echo");
                  $.ajax({
                      url: "<?php echo SITE_URL ?>inc/search.php",
            data: 'query=' + query,
                      dataType: "json",
                      type: "POST",
                      success: function (data) {
              result($.map(data, function (item) {
                return item;
                          }));
                      }
                  });
              }
          });


 
});
</script>
    <script type="text/javascript">
        let infScroll = new InfiniteScroll( '.container');
        $(document).ready(function(){
                     // Basic
                $('.dropify').dropify();

                // Translated
                $('.dropify-fr').dropify({
                    messages: {
                        default: 'Glissez-déposez un fichier ici ou cliquez',
                        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                        remove:  'Supprimer',
                        error:   'Désolé, le fichier trop volumineux'
                    }
                });

                // Used events
                var drEvent = $('#input-file-events').dropify();

                drEvent.on('dropify.beforeClear', function(event, element){
                    return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
                });

                drEvent.on('dropify.afterClear', function(event, element){
                    alert('File deleted');
                });

                drEvent.on('dropify.errors', function(event, element){
                    console.log('Has Errors');
                });

                var drDestroy = $('#input-file-to-destroy').dropify();
                drDestroy = drDestroy.data('dropify')
                $('#toggleDropify').on('click', function(e){
                    e.preventDefault();
                    if (drDestroy.isDropified()) {
                        drDestroy.destroy();
                    } else {
                        drDestroy.init();
                    }
                })
            });
    </script>

 <script type="text/javascript">
   
    function addRecord(){

            var email = $("#subscribe").val();
            // alert(email);
        // alert(email);
        $.ajax({
             url:"<?php echo SITE_URL ?>inc/subscribe.php",
            type:"post",
            data: {
                email: email,

            },
            success:function(data){
               $('#subscribe-done').html(data);
            }
        });

    }
  </script>
	 <script>
		$(window).load(function(){
		  $(".header-new").sticky({ topSpacing: 0 });
		});
	</script>
<script>
var searchInput = 'CurrentLocation';

$(document).ready(function () {
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
        types: ['geocode'],
    });
    
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();
        document.getElementById('lat').value = near_place.geometry.location.lat();
        document.getElementById('lng').value = near_place.geometry.location.lng();
    });
});

$(document).on('change', '#'+searchInput, function () {
    document.getElementById('lat').value = '';
    document.getElementById('lng').value = '';
});


var searchInput2 = 'SignupCurrentLocation';

$(document).ready(function () {
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput2)), {
        types: ['geocode'],
    });
    
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();
        document.getElementById('slat').value = near_place.geometry.location.lat();
        document.getElementById('slng').value = near_place.geometry.location.lng();
    });
});

$(document).on('change', '#'+searchInput2, function () {
    document.getElementById('slat').value = '';
    document.getElementById('slng').value = '';
});

var searchInput3 = 'CurrentLocation3';

$(document).ready(function () {
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput3)), {
        types: ['geocode'],
    });
    
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();
        document.getElementById('lat').value = near_place.geometry.location.lat();
        document.getElementById('lng').value = near_place.geometry.location.lng();
    });
});

$(document).on('change', '#'+searchInput3, function () {
    document.getElementById('lat').value = '';
    document.getElementById('lng').value = '';
});
var searchInput4 = 'CurrentLocation2';

$(document).ready(function () {
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput4)), {
        types: ['geocode'],
    });
    
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();
        document.getElementById('2lat').value = near_place.geometry.location.lat();
        document.getElementById('2lng').value = near_place.geometry.location.lng();
    });
});

$(document).on('change', '#'+searchInput4, function () {
    document.getElementById('2lat').value = '';
    document.getElementById('2lng').value = '';
});

</script>

<?php if (!isset($_SESSION['location']) || $page=='reg'): ?>
<script>
$(document).ready(function () {
    getLocation();
});
</script>
<?php endif ?>

<script>

  $(document).ready(function () {
	  $('.location-track-icon').click(function () {
	      //alert('');
			getLocation();
	  });

});

function getLocation() {
	$("#CurrentLocation").val('');
	$("#SignupCurrentLocation").val('');
  $("#CurrentLocation3").val('');
	
    if ($('#lat').length) {
        $('#lat').val('');
    }
    if ($('#lng').length) {
        $('#lng').val('');
    }
	if ($('#slat').length) {
        $('#slat').val('');
    }
    if ($('#slng').length) {
        $('#slng').val('');
    }
	

    initAutocomplete();
    var location = '';
    if (location == '') { //alert('abcd');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (p) {
                var LatLng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);
                var mapOptions = {
                    center: LatLng,
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                $("#lat").val(p.coords.latitude);
                $("#lng").val(p.coords.longitude);
				
				        $("#slat").val(p.coords.latitude);
                $("#slng").val(p.coords.longitude);
				
				
//alert(p.coords.latitude);alert(p.coords.longitude);
                var geocoder;
                geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);

                geocoder.geocode(
                    { 'latLng': LatLng },
                    function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {

                                var city;
                                var county;
                                for (var i = 0; i < results[0].address_components.length; i++) {
                                    var addressType = results[0].address_components[i].types[0];
                                    if (addressType) {
                                        switch (addressType) {
                                            case 'postal_town':
                                                var gcity = results[0].address_components[i].types[0];
                                                if (gcity != null || gcity != undefined) {
                                                    city = results[0].address_components[i].long_name;
                                                }
                                                break;
                                            case 'locality':
                                                if (city != null || city == undefined) {
                                                    var glcity = results[0].address_components[i].types[0];
                                                    if (glcity != null || glcity != undefined) {
                                                        city = results[0].address_components[i].long_name;
                                                    }
                                                }
                                                break;
                                            case 'administrative_area_level_2':
                                                var gadmini = results[0].address_components[i].types[0];
                                                if (gadmini != null || gadmini != undefined) {
                                                    county = results[0].address_components[i].long_name;
                                                }
                                                break;
											
											             case 'country':
                                                var gadmini = results[0].address_components[i].types[0];
                                                if (gadmini != null || gadmini != undefined) {
                                                    country = results[0].address_components[i].long_name;
													         // $_SESSION
                                   '<%Session["location_country"] = "' + country + '"; %>';
								   <?php if(!isset($_REQUEST['country_id'])){?>
                                   if(country.trim()!=""){

                                      $("#country_id option").each(function() {
                                        //alert($(this).text())

                                        if($(this).text() == country) {
                                        
                                          $(this).attr('selected', 'selected');   
                                          $("#country_id option").change();
                                        }                        
                                     });
                                   }
												<?php }?>
                                    
                                   

												      //$("#GetCurrentCountry").val(country);
                                                }
                                                break;

																						
											
											
                                        }
                                    }
                                }

                                $("#CurrentLocation").val(city + ', '+ county);
								$("#SignupCurrentLocation").val(city + ', '+ county);
                $("#CurrentLocation3").val(city + ', '+ county);
								
								
								
								
                                //createCookie('Location', 'locationshared', 1);
//alert(city + ', '+ county);
                                UpdatePlaceDetails(results[0], '#CurrentLocation');
								UpdatePlaceDetails(results[0], '#SignupCurrentLocation');
                UpdatePlaceDetails(results[0], '#CurrentLocation3');
								
                              //  createCookie('LocationInfo', JSON.stringify(LocationInfo), 7);
                               // $('#UserLocationDetails').val(JSON.stringify(LocationInfo));

                            }
                            else {
                                alert("address not found");
                            }
                        }
                        else {
                            alert("Geocoder failed due to: " + status);
                        }
                    }
                );


            });
        } else {
            alert('Geo Location feature is not supported in this browser.');
        }
    }

}

function initAutocomplete() {
    var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(49.85, -6.4),
        new google.maps.LatLng(60.85, -0.866667),
        new google.maps.LatLng(52.483333, 1.766667),
        new google.maps.LatLng(57.583333, -13.683333));

    var options = { bounds: defaultBounds, types: ['geocode'] }
    var fields = ['address_component', 'formatted_address', 'geometry', 'id', 'name', 'place_id', 'types'];



}

//for current location errer handler
$("#CurrentLocation").keypress(function (e) {
    if (e.keyCode != 13 && e.keyCode != 9 && e.keyCode != 32) {
        if ($('#lat').length) {
            $('#lat').val('');
        }
        if ($('#lng').length) {
            $('#lng').val('');
        }


    }
});

$("#SignupCurrentLocation").keypress(function (e) {
    if (e.keyCode != 13 && e.keyCode != 9 && e.keyCode != 32) {
        if ($('#slat').length) {
            $('#slat').val('');
        }
        if ($('#slng').length) {
            $('#slng').val('');
        }


    }
});

$("#CurrentLocation3").keypress(function (e) {
    if (e.keyCode != 13 && e.keyCode != 9 && e.keyCode != 32) {
        if ($('#3lat').length) {
            $('#3lat').val('');
        }
        if ($('#3lng').length) {
            $('#3lng').val('');
        }


    }
});



var geocoder;
  var map;
  myMap(adrs);
  function myMap(address) {
	geocoder = new google.maps.Geocoder();
    var mapProp = {
                zoom: 5,
    };
    map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
	if (geocoder) {
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
			  map.setCenter(results[0].geometry.location);
			  map.setZoom(13);
			  var marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map: map
              });

			  marker.setMap(map);


          } else {
			  alert("No results found");
          }
        } else {
          alert("Geocode was not successful for the following reason: " + status);
        }
      });
    }
  }

</script>

<script>

  $(document).ready(function () {
    $('.location-track-icon2').click(function () {
        //alert('');
      getLocation_2();
    });

});

function getLocation_2() {
  $("#CurrentLocation2").val('');
  
    if ($('#2lat').length) {
        $('#2lat').val('');
    }
    if ($('#2lng').length) {
        $('#2lng').val('');
    }
  

    initAutocomplete();
    var location = '';
    if (location == '') { //alert('abcd');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (p) {
                var LatLng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);
                var mapOptions = {
                    center: LatLng,
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                $("#2lat").val(p.coords.latitude);
                $("#2lng").val(p.coords.longitude);
        
        
//alert(p.coords.latitude);alert(p.coords.longitude);
                var geocoder;
                geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);

                geocoder.geocode(
                    { 'latLng': LatLng },
                    function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {

                                var city;
                                var county;
                                for (var i = 0; i < results[0].address_components.length; i++) {
                                    var addressType = results[0].address_components[i].types[0];
                                    if (addressType) {
                                        switch (addressType) {
                                            case 'postal_town':
                                                var gcity = results[0].address_components[i].types[0];
                                                if (gcity != null || gcity != undefined) {
                                                    city = results[0].address_components[i].long_name;
                                                }
                                                break;
                                            case 'locality':
                                                if (city != null || city == undefined) {
                                                    var glcity = results[0].address_components[i].types[0];
                                                    if (glcity != null || glcity != undefined) {
                                                        city = results[0].address_components[i].long_name;
                                                    }
                                                }
                                                break;
                                            case 'administrative_area_level_2':
                                                var gadmini = results[0].address_components[i].types[0];
                                                if (gadmini != null || gadmini != undefined) {
                                                    county = results[0].address_components[i].long_name;
                                                }
                                                break;
                      
                                   case 'country':
                                                var gadmini = results[0].address_components[i].types[0];
                                                if (gadmini != null || gadmini != undefined) {
                                                    country = results[0].address_components[i].long_name;
                                   // $_SESSION
                                   '<%Session["location_country"] = "' + country + '"; %>';
                                   if(country.trim()!=""){

                                      $("#country_id option").each(function() {
                                        //alert($(this).text())

                                        if($(this).text() == country) {
                                        
                                          $(this).attr('selected', 'selected');   
                                          $("#country_id option").change();
                                        }                        
                                     });
                                   }
                                    
                                   

                              //$("#GetCurrentCountry").val(country);
                                                }
                                                break;

                                            
                      
                      
                                        }
                                    }
                                }

                                $("#CurrentLocation2").val(city + ', '+ county);
                
                
                
                
                                //createCookie('Location', 'locationshared', 1);
//alert(city + ', '+ county);
                                UpdatePlaceDetails(results[0], '#CurrentLocation2');
                
                              //  createCookie('LocationInfo', JSON.stringify(LocationInfo), 7);
                               // $('#UserLocationDetails').val(JSON.stringify(LocationInfo));

                            }
                            else {
                                alert("address not found");
                            }
                        }
                        else {
                            alert("Geocoder failed due to: " + status);
                        }
                    }
                );


            });
        } else {
            alert('Geo Location feature is not supported in this browser.');
        }
    }

}

function initAutocomplete() {
    var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(49.85, -6.4),
        new google.maps.LatLng(60.85, -0.866667),
        new google.maps.LatLng(52.483333, 1.766667),
        new google.maps.LatLng(57.583333, -13.683333));

    var options = { bounds: defaultBounds, types: ['geocode'] }
    var fields = ['address_component', 'formatted_address', 'geometry', 'id', 'name', 'place_id', 'types'];



}

//for current location errer handler
$("#CurrentLocation2").keypress(function (e) {
    if (e.keyCode != 13 && e.keyCode != 9 && e.keyCode != 32) {
        if ($('#2lat').length) {
            $('#2lat').val('');
        }
        if ($('#2lng').length) {
            $('#2lng').val('');
        }


    }
});



var geocoder;
  var map;
  myMap(adrs);
  function myMap(address) {
  geocoder = new google.maps.Geocoder();
    var mapProp = {
                zoom: 5,
    };
    map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
  if (geocoder) {
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
        map.setCenter(results[0].geometry.location);
        map.setZoom(13);
        var marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map: map
              });

        marker.setMap(map);


          } else {
        alert("No results found");
          }
        } else {
          alert("Geocode was not successful for the following reason: " + status);
        }
      });
    }
  }

</script>

 <script>

    $(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2

        $(".select2").select2({
        });
		$(".selectProfession").select2({
			tags: true
        });
		
		
		$(".selectExpertiseSkills").select2({
			tags : true
		});
		
		
        $(".categories_id").select2({
          dropdownParent: $(".select-2-search"),
        });
        $(".country_id").select2({
          dropdownParent: $(".country_id_search"),
        });
        $(".region_id").select2({
          dropdownParent: $(".region_id_search"),
        });
        $(".city_id").select2({
          dropdownParent: $(".city_id_search"),
        });

        $(".country_code").select2({
          dropdownParent: $(".country_code_search"),
        });

        // $("#SignupCurrentLocation").select2({
        //   dropdownParent: $(".SignupCurrentLocation_search"),
        // });

        // $('.selectpicker').selectpicker();
        // //Bootstrap-TouchSpin
        // $(".vertical-spin").TouchSpin({
        //     verticalbuttons: true,
        //     verticalupclass: 'ti-plus',
        //     verticaldownclass: 'ti-minus'
        // });
        // var vspinTrue = $(".vertical-spin").TouchSpin({
        //     verticalbuttons: true
        // });
        // if (vspinTrue) {
        //     $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        // }
        // $("input[name='tch1']").TouchSpin({
        //     min: 0,
        //     max: 100,
        //     step: 0.1,
        //     decimals: 2,
        //     boostat: 5,
        //     maxboostedstep: 10,
        //     postfix: '%'
        // });
        // $("input[name='tch2']").TouchSpin({
        //     min: -1000000000,
        //     max: 1000000000,
        //     stepinterval: 50,
        //     maxboostedstep: 10000000,
        //     prefix: '$'
        // });
        // $("input[name='tch3']").TouchSpin();
        // $("input[name='tch3_22']").TouchSpin({
        //     initval: 40
        // });
        // $("input[name='tch5']").TouchSpin({
        //     prefix: "pre",
        //     postfix: "post"
        // });
        // // For multiselect
        // $('#pre-selected-options').multiSelect();
        // $('#optgroup').multiSelect({
        //     selectableOptgroup: true
        // });
        // $('#public-methods').multiSelect();
        // $('#select-all').on('click', function() {
        //     $('#public-methods').multiSelect('select_all');
        //     return false;
        // });
        // $('#deselect-all').on('click', function() {
        //     $('#public-methods').multiSelect('deselect_all');
        //     return false;
        // });
        // $('#refresh').on('click', function() {
        //     $('#public-methods').multiSelect('refresh');
        //     return false;
        // });
        // $('#add-option').on('click', function() {
        //     $('#public-methods').multiSelect('addOption', {
        //         value: 42,
        //         text: 'test 42',
        //         index: 0
        //     });
        //     return false;
        // });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password svg').addClass( "fa-eye-slash" );
                $('#show_hide_password svg').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password svg').removeClass( "fa-eye-slash" );
                $('#show_hide_password svg').addClass( "fa-eye" );
            }
        });
      });
      </script>
    <script>
        new Mmenu(document.querySelector('#menu'));
    </script>


  <script type="text/javascript">
   $('.select2').select2({
        dropdownParent: $('#add_job')
    });
		
</script>


  <?php  
 // echo  $_SESSION['member_id']
   ?>
</body>
</html>

