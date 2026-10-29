
(function ($) {
  "use strict";


$(document).ready(function(){
   $("#txt_username").keyup(function(){
      var username = $(this).val().trim();
      if(username != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_username.php',
            type: 'post',
            data: {username: username},
            success: function(response){
                $('#uname_response').html(response);
             }
         });
      }else{
         $("#uname_response").html("");
      }
    });
   $("#member_first_name").keyup(function(){
      var member_first_name = $(this).val().trim();
      if(member_first_name != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_name.php',
            type: 'post',
            data: {member_first_name: member_first_name},
            success: function(response){
                $('#first_name_response').html(response);
             }
         });
      }else{
         $("#first_name_response").html("");
      }
    });
   $("#member_last_name").keyup(function(){
      var member_last_name = $(this).val().trim();
      if(member_last_name != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_name.php',
            type: 'post',
            data: {member_last_name: member_last_name},
            success: function(response){
                $('#last_name_response').html(response);
             }
         });
      }else{
         $("#last_name_response").html("");
      }
    });
   $("#member_email").keyup(function(){
      var email = $(this).val().trim();
      // alert('email')
      if(email != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_email.php',
            type: 'post',
            data: {email: email},
            success: function(response){
                $('#email_response').html(response);
             }
         });
      }else{
         $("#email_response").html("");
      }
    });
   $("#member_password").keyup(function(){
      var member_password = $(this).val().trim();
      // alert('email')
      if(member_password != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_validation.php',
            type: 'post',
            data: {member_password: member_password},
            success: function(response){
                $('#member_password_response').html(response);
             }
         });
      }else{
         $("#member_password_response").html("");
      }
    });
    $("#member_c_password").keyup(function(){
      var member_c_password = $(this).val().trim();
      var member_password_c = $('#member_password').val().trim();
      // alert(member_password_c)
      if(member_c_password != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_validation.php',
            type: 'post',
            data: {member_c_password: member_c_password, member_password_c: member_password_c},
            success: function(response){
                $('#member_c_password_response').html(response);
             }
         });
      }else{
         $("#member_c_password_response").html("");
      }
    });
  $("#post_code").keyup(function(){
      var post_code = $(this).val().trim();
      // alert(member_password_c)
      if(post_code != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_validation.php',
            type: 'post',
            data: {post_code: post_code},
            success: function(response){
                $('#post_code_response').html(response);
             }
         });
      }else{
         $("#post_code_response").html("");
      }
    });
  $("#member_birth_date").keyup(function(){
      var member_birth_date = $(this).val().trim();
      if(member_birth_date != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_validation.php',
            type: 'post',
            data: {member_birth_date: member_birth_date},
            success: function(response){
                $('#member_birth_date_response').html(response);
             }
         });
      }else{
         $("#member_birth_date_response").html("");
      }
    });
  $("#member_experience_year").keyup(function(){
      var member_experience_year = $(this).val().trim();
      if(member_experience_year != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_validation.php',
            type: 'post',
            data: {member_experience_year: member_experience_year},
            success: function(response){
                $('#member_experience_year_response').html(response);
             }
         });
      }else{
         $("#member_birth_date_response").html("");
      }
    });


  $("#member_phone").keyup(function(){
      var member_phone = $(this).val().trim();
      // alert(member_phone);
      if(member_phone != ''){
         $.ajax({
            url: '<?php echo SITE_URL ?>inc/chk_validation.php',
            type: 'post',
            data: {member_phone: member_phone},
            success: function(response){
                $('#member_phone_response').html(response);
             }
         });
      }else{
         $("#member_phone_response").html("");
      }
    });

 });
}(jQuery));

