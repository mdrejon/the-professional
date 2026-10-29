<?php
session_start();


// if(!isset($_SESSION['member_id'])){
//     header("location:login.php");
// }
 $member_sql = "SELECT * FROM ".$db_suffix."member WHERE member_id = '".$_SESSION['member_id']."'";
$member_query = $db->select($member_sql);
$member_data  = mysqli_fetch_object($member_query);
 $member_img = $member_data->member_img;
 if ($member_img == '') {
        if ($member_data->member_gender == 'male') {
            $member_img = 'male-avata.png';
        }elseif ($member_data->member_gender == 'female'){
            $member_img = 'female-avata.png';
        }
    }
?>

<style type="text/css">

</style>
<div class="card card-bordered user_list" >

    <div class="card-header card-active">
        <h4 class="card-title"> <span class="chat-icon"><i class="fas fa-headset"></i></span><strong>Chat</strong></h4> <a class="btn btn-xs btn-secondary minimize" href="#" data-abc="true"><i class="fas fa-window-minimize"></i></a>
      
    </div>
    <div id="list_show" class="ps-container chat-content ps-theme-default ps-active-y" id="chat-content" style="overflow-y: scroll !important; max-height:325px !important;">
        
    </div>



</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div id="user_model_details">
    
</div>
<!-- <div class="card card-bordered single-chat">
    <div class="card-header">
        <h4 class="card-title"><strong>Chat</strong></h4> <a class="btn btn-xs btn-secondary chat-close" href="#" data-abc="true"><i class="fas fa-times"></i></a>

    </div>
    <div class="ps-container chat-content ps-theme-default ps-active-y" id="chat-content2" style="overflow-y: scroll !important; height:325px !important;">
       
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
            <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;">
            <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div>
        </div>
    </div>
    <div class="publisher bt-1 border-light"> <img class="avatar avatar-xs" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="..."> <input class="publisher-input" type="text" placeholder="Write something"> <span class="publisher-btn file-group"> <i class="fa fa-paperclip file-browser"></i> <input type="file"> </span> <a class="publisher-btn" href="#" data-abc="true"><i class="fa fa-smile"></i></a> <a class="publisher-btn text-info" href="#" data-abc="true"><i class="fa fa-paper-plane"></i></a> </div>
</div> -->
     


<!-- 
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card card-bordered">
                    <div class="card-header">
                        <h4 class="card-title"><strong>Chat</strong></h4> <a class="btn btn-xs btn-secondary" href="#" data-abc="true">Let's Chat App</a>
                    </div>
                    <div class="ps-container chat-content ps-theme-default ps-active-y" id="chat-content2" style="overflow-y: scroll !important; height:325px !important;">
                        <div class="media media-chat"> <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                            <div class="media-body">
                                <p>Hi</p>
                                <p>How are you ...???</p>
                                <p>What are you doing tomorrow?<br> Can we come up a bar?</p>
                                <p class="meta"><time datetime="2018">23:58</time></p>
                            </div>
                        </div>
                        <div class="media media-meta-day">Today</div>
                        <div class="media media-chat media-chat-reverse">
                            <div class="media-body">
                                <p>Hiii, I'm good.</p>
                                <p>How are you doing?</p>
                                <p>Long time no see! Tomorrow office. will be free on sunday.</p>
                                <p class="meta"><time datetime="2018">00:06</time></p>
                            </div>
                        </div>
                        <div class="media media-chat"> <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                            <div class="media-body">
                                <p>Okay</p>
                                <p>We will go on sunday? </p>
                                <p class="meta"><time datetime="2018">00:07</time></p>
                            </div>
                        </div>
                        <div class="media media-chat media-chat-reverse">
                            <div class="media-body">
                                <p>That's awesome!</p>
                                <p>I will meet you Sandon Square sharp at 10 AM</p>
                                <p>Is that okay?</p>
                                <p class="meta"><time datetime="2018">00:09</time></p>
                            </div>
                        </div>
                        <div class="media media-chat"> <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                            <div class="media-body">
                                <p>Okay i will meet you on Sandon Square </p>
                                <p class="meta"><time datetime="2018">00:10</time></p>
                            </div>
                        </div>
                        <div class="media media-chat media-chat-reverse">
                            <div class="media-body">
                                <p>Do you have pictures of Matley Marriage?</p>
                                <p class="meta"><time datetime="2018">00:10</time></p>
                            </div>
                        </div>
                        <div class="media media-chat"> <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                            <div class="media-body">
                                <p>Sorry I don't have. i changed my phone.</p>
                                <p class="meta"><time datetime="2018">00:12</time></p>
                            </div>
                        </div>
                        <div class="media media-chat media-chat-reverse">
                            <div class="media-body">
                                <p>Okay then see you on sunday!!</p>
                                <p class="meta"><time datetime="2018">00:12</time></p>
                            </div>
                        </div>
                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                            <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;">
                            <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div>
                        </div>
                    </div>
                    <div class="publisher bt-1 border-light"> <img class="avatar avatar-xs" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="..."> <input class="publisher-input" type="text" placeholder="Write something"> <span class="publisher-btn file-group"> <i class="fa fa-paperclip file-browser"></i> <input type="file"> </span> <a class="publisher-btn" href="#" data-abc="true"><i class="fa fa-smile"></i></a> <a class="publisher-btn text-info" href="#" data-abc="true"><i class="fa fa-paper-plane"></i></a> </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<script>  

$(document).ready(function(){
    
 fetch_user();
 
 setInterval(function(){
    update_last_activity();
    fetch_user();
 }, 5000);
 function fetch_user() {
    $.ajax({
        url:"<?php echo SITE_URL ?>member/fetch_user.php",
        method:"POST",
        success:function(data){
            $('#list_show').html(data);
        }
    })
 }

function view_chat(){
    // alert("hello");
}
 function update_last_activity() {
    $.ajax({
        url:"<?php echo SITE_URL ?>update_last_activity.php",
        success:function(){}
    })
 }

function make_chat_dialog_box(to_user_id, to_user_name) {
    var modal_content = '<div class="card card-bordered single-chat">';
    modal_content += '<div class="card-header chat-header"> <h4 class="card-title"><strong>'+to_user_name+'</strong></h4><a class="btn btn-xs btn-secondary chat-close" href="javascript:void(0);" data-abc="true"><i class="fas fa-times"></i></a></div>';
    modal_content += '<div id="chat_history_'+to_user_id+'" class="ps-container chat-content'+to_user_id+' ps-theme-default ps-active-y chat_history" style="overflow-y: scroll !important; height:325px !important; data-touserid="'+to_user_id+'"">';

    modal_content += '</div>';
    modal_content += '<div class="publisher'+to_user_id+' chat_publisher bt-1 border-light">';
    modal_content += '<img class="avatar avatar-xs" src="<?php echo SITE_URL ?>member/images/<?php echo $member_img ?>" alt="...">';
    modal_content += '<input class="publisher-input" name="chat_message_'+to_user_id+'" type="text" id="chat_message_'+to_user_id+'" placeholder="Write something"> ';
    // modal_content += '<span class="publisher-btn file-group"> <i class="fa fa-paperclip file-browser"></i>  <input type="file"> </span>';
    // modal_content += ' <a class="publisher-btn" href="#" data-abc="true"><i class="fa fa-smile"></i></a> <a class="publisher-btn text-info" href="#" data-abc="true"></a> ';
    modal_content += '<button type="button" name="send_chat" id="'+to_user_id+'" class="publisher-btn send_chat"><i class="fa fa-paper-plane"></i></button>';
    modal_content += '</div>';
    
    modal_content += '</div>'
    modal_content += '</div>'
    // modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
    // modal_content += '</div>';
    // modal_content += '<div class="form-group">';
    // modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control xd"></textarea>';
    // modal_content += '</div><div class="form-group" align="right">';
    // modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
    // var inhtml = $('#user_model_details').html();
    // modal_content+=inhtml;
    $('#user_model_details').html(modal_content);
}
$(document).on('click', '.start_chat', function(){
    var to_user_id = $(this).data('touserid');
    var to_user_name = $(this).data('tousername');
    make_chat_dialog_box(to_user_id, to_user_name);
    
    // $("#user_dialog_"+to_user_id).dialog({
    //     autoOpen:false,
    //     width:400
    // });
    // $('#user_dialog_'+to_user_id).dialog('open');
        setInterval(function(){ // set interval for take messages for every 1 seconds and show into chat 
            refreshMsg();
        }, 1000); // <---- here 
function refreshMsg() {
    // alert(to_user_id);
    $.ajax({
          url: "<?php echo SITE_URL ?>member/take_msg.php",
          method: "POST",
          data:{to_user_id:to_user_id},
          success: function(data) {
            // $('#chat_message_'+to_user_id).val('');
              $('#chat_history_'+to_user_id).html(data);
          }
     })
}
});
 //abort ajax call if user close chat :) 
// $( ".selector" ).on( "dialogclose", function( event, ui ) {
//         //alert("todo - later");
// });
$(document).on('click', '.send_chat', function(){
    // alert("hello");
    // $.playSound("mp3/click.mp3") // here we set MP3 SOUND FOR "send" button click
    var to_user_id = $(this).attr('id');
    var chat_message = $('#chat_message_'+to_user_id).val();
    // alert(to_user_id);
    // alert(chat_message);

    $.ajax({
            url:"<?php echo SITE_URL ?>member/insert_chat.php",
            method:"POST",
            data:{to_user_id:to_user_id, chat_message:chat_message},
        success:function(data){
            $('#chat_message_'+to_user_id).val('');
            // alert(to_user_id);
            $('#chat_history_'+to_user_id).html(data);
        }
    });

 });
$(document).on("keypress", ".publisher-input", function(e){
        if(e.which == 13){
            // alert('');
           var to_user_id = $('.send_chat').attr('id');
            var chat_message = $('#chat_message_'+to_user_id).val();
             // alert(to_user_id);
            // alert(chat_message);

            $.ajax({
                    url:"<?php echo SITE_URL ?>member/insert_chat.php",
                    method:"POST",
                    data:{to_user_id:to_user_id, chat_message:chat_message},
                success:function(data){
                    $('#chat_message_'+to_user_id).val('');
                    // alert(to_user_id);
                    $('#chat_history_'+to_user_id).html(data);
                }
            });
        }
    });
 
 
});  

var objDiv = document.getElementsByClassName("chat_history");
objDiv.scrollTop = objDiv.scrollHeight;
</script>