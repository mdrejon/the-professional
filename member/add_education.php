<?php
$db = new database();
$degree_sql = "SELECT * FROM ".$db_suffix."degree WHERE degree_status='1' order by degree_order";
$degree_query = $db->select($degree_sql);
$degree_options = '';
while($degree_data = mysqli_fetch_object($degree_query)){
	$degree_options .='<option value="'.$degree_data->degree_title.'">'.$degree_data->degree_title.'</option>';
}
?>
<style type="text/css">
	
#show_error span, #show_error2 span {
  display: inherit;
  color: red;
  font-size: 11px;
}

.education-action a {
  color: ;
  transition: 0.4s;
  cursor: pointer;
}
.education-action a:hover {
  color: #284F6B;
}

.education-action a {
  margin-left: 0 !important;
  padding-left: 0 !important;
}
.education-action a span:hover {
  color: #2A5992 !important;
}
.form-content .form-group span.red {
	display: inline-block !important;
	width: auto;
	color: red !important;
	padding-left: 4px;
}
</style>
<div id="add-contet" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		<h5 class="modal-title">Add Education</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <div class="modal-body">
       <div class="row">
			<div class="col-lg-12">
				<div class="form-content">
					<div id="show_error"></div>
					<!-- <form method="POST" accept="#"> -->
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Qualification<span class="red">*</span></label>
									<select id="degree2" >
										<option disabled selected="selected">Select  your qualification</option>
										<?php echo $degree_options;?> 										
									</select>

								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Course Title<span class="red">*</span></label>
									<input type="text" required id="course-title2" placeholder="Course Title ">
									<input type="hidden" id="member_id2" placeholder="Course Title " value="<?php echo $member_id ?>">
									
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>University/College/Institute<span class="red">*</span> </label>
									<input type="text" required id="university2" placeholder="Type Your University/College  ">
									
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Passing Year<span class="red">*</span></label>
									<select id="p-year2" name="p-year2"  class="" >
										<option disabled selected="selected">Select  your passing year</option>
										<?php
										$year = date("Y");
											for ($x = 1951; $x <= $year; $x++) {
											  echo '<option value="'.$x.'">'.$x.'</option>';
											} 

										 ?>									
									</select>
									<!-- <input type="number" required id="p-year2" min="1900" max="2099" step="1" value="2021" placeholder="2021"> -->
									
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									
									
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
      	<button type="submit" onclick="addEducation()" >Add Education</button>
      </div>
    </div>

  </div>
</div>
<!-- <div id="education" class=" mfp-hide white-popup">
	<div class="container">
		
	</div>
</div> -->

<script type="text/javascript">
	$(document).ready(function(){
		readEducation();
	});
  	function readEducation(){
  		var readrecord = 'readrecord';
  		$.ajax({
  			url:"member/ajax_education.php",
  			type: "post",
  			data:{readrecord: readrecord},
  			success:function(data,status){
  				$('#show-content').html(data);
  			}
  		})
  	}
  	function addEducation(){
  			var degree2 = $("#degree2").val();
  		var ecourse_title2 = $('#course-title2').val();
  		var university2 = $("#university2").val();
  		var p_year2 = $("#p-year2").val();
      // alert(p_year2)
  		var member_id2 = $("#member_id2").val();
  		var set_data = ('set_data');
  		// alert(ecourse_title);
  		$.ajax({
  			url:"member/ajax_education.php",
  			type:"post",
			dataType: "json",
  			data: {
  				degree2: degree2,
  				ecourse_title2: ecourse_title2,
  				university2: university2,
  				p_year2: p_year2,
  				member_id2: member_id2,
  				set_data: set_data

  			},
			success:function(result){
				
               // alert(result['data']);
				if (result.status.trim() == 'success')
                {
					$('#show_error').html(result.data);
					setTimeout(function(){ 
					
					var modalID = '#add-contet';
					readEducation();
					
					
					$('#show_error').html('');
					
					$("#degree2 option:selected").val('Select  your qualification');
					$('#course-title2').val('');
					$("#university2").val('');
					$("#p-year2").val('');
					
					$(modalID).modal('hide');
					

					}, 1000);

				}
				else if (result.status.trim() == 'error')
                {
					$('#show_error').html(result.data);
				}
			},
			error: function (result) {

                $('#show_error').html(result.data);
				//var p = JSON.stringify(result);
                var p = JSON.stringify(result);
                var intIndexOfMatch = p.indexOf("&");
                while (intIndexOfMatch != -1) {
                    p = p.replace("&", "%26");
                    intIndexOfMatch = p.indexOf("&");
                }

               // alert(p);
                //alert('error found');
                //alert('error');
                //$.unblockUI();
            }
			  			
  		});
  	}
	
	$('body').delegate('.editEducation', 'click', function () {
        
		var error_flag = 0;
		var $this = $(this);
		var degree = $this.parent().parent().find(".degree option:selected").val();
		
		var ecourse_title = $this.parent().parent().find('.course-title').val();
		//alert(ecourse_title);
		var university = $this.parent().parent().find(".university").val();
		var p_year = $this.parent().parent().find(".p-year").val();
		var education_id = $this.parent().parent().find(".education_id").val();
		var set_data = ('update_data');
		
		$.ajax({
			url:"member/ajax_education.php",
			type:"post",
			dataType: "json",
			data: {
			  degree: degree,
			  ecourse_title: ecourse_title,
			  university: university,
			  p_year: p_year,
			  education_id: education_id,
			  set_data: set_data

			},
			beforeSend: function () {
				$this.css("background-color", "#ff4556");
			},
			success:function(result){
				
               // alert(result['data']);
				if (result.status.trim() == 'success')
                {
					$this.parent().parent().find('.show_error2').html(result.data);
					setTimeout(function(){ 
					$this.parent().parent().find('.show_error2').html('');
					
					var modalID = '#edit_contet'+education_id;
					readEducation();
					$(modalID).modal('hide');

					}, 1000);
					
					
					
					

				}
				else if (result.status.trim() == 'error')
                {
					$this.parent().parent().find('.show_error2').html(result.data);
				}
			},
			error: function (result) {

                $this.parent().parent().find('.show_error2').html(result.data);
				//var p = JSON.stringify(result);
                var p = JSON.stringify(result);
                var intIndexOfMatch = p.indexOf("&");
                while (intIndexOfMatch != -1) {
                    p = p.replace("&", "%26");
                    intIndexOfMatch = p.indexOf("&");
                }

               // alert(p);
                //alert('error found');
                //alert('error');
                //$.unblockUI();
            }
			
		});
		
    });
	
	/*$('body').delegate('#edit-expertise', 'click', function () {
        
		var $this = $(this);
		var skills = '';
		var a = new array();
		var selectedSkills = $('.selectExpertiseSkills').select2("data");
		for (var i = 0; i <= selectedSkills.length-1; i++) {
            a[] = selectedSkills[i].text;
		}
			
		var p = JSON.stringify(a);
		var intIndexOfMatch = p.indexOf( "&" );		
		while (intIndexOfMatch != -1){
			p = p.replace("&", "%26");
			intIndexOfMatch = p.indexOf( "&" );
		}	 
		//alert(p);
		
		
		$.ajax({
			url:"member/updateSkills.php",
			type:"post",
			dataType: "json",
			data: {
			  degree: degree,
			  ecourse_title: ecourse_title,
			  university: university,
			  p_year: p_year,
			  education_id: education_id,
			  set_data: set_data

			},
			beforeSend: function () {
				$this.css("background-color", "#ff4556");
			},
			success:function(result){
				
               // alert(result['data']);
				if (result.status.trim() == 'success')
                {
					$this.parent().parent().find('.show_error2').html(result.data);
					setTimeout(function(){ 
					$this.parent().parent().find('.show_error2').html('');
					
					var modalID = '#edit_contet'+education_id;
					readEducation();
					$(modalID).modal('hide');

					}, 1000);
					
					
					
					

				}
				else if (result.status.trim() == 'error')
                {
					$this.parent().parent().find('.show_error2').html(result.data);
				}
			},
			error: function (result) {

                $this.parent().parent().find('.show_error2').html(result.data);
				//var p = JSON.stringify(result);
                var p = JSON.stringify(result);
                var intIndexOfMatch = p.indexOf("&");
                while (intIndexOfMatch != -1) {
                    p = p.replace("&", "%26");
                    intIndexOfMatch = p.indexOf("&");
                }               
            }
			
		});
		
    });*/

    function editEducation(){
		
		

      // alert('Hello')
	  var $this = $(this);
	  
      
      var university = $("#university").val();
      var p_year = $("#p-year").val();
      var education_id = $("#education_id").val();
      var set_data = ('update_data')
      // alert(education_id)
      $.ajax({
        url:"member/ajax_education.php",
        type:"post",
        data: {
          degree: degree,
          ecourse_title: ecourse_title,
          university: university,
          p_year: p_year,
          education_id: education_id,
          set_data: set_data

        },
        success:function(data,status,close){
          $('#show_error2').html(data);
          // $('#show_error').html(data);
          // readEducation()
        }
      });

    }
    function deleteEducation(edu){
      // alert();
      var education_id = edu;
       //alert(education_id);
      var set_data = ('delete_data');
      // alert(education_id)
      $.ajax({
        url:"member/ajax_education.php",
        type:"post",
		dataType:"json",
        data: {
          education_id: education_id,
          set_data: set_data

        },
        success:function(result){
			
			// alert(result['data']);
				if (result.status.trim() == 'success')
                {
					$('#show_error2').html(result.data);
					
					setTimeout(function(){ 
					$('#show_error2').html('');
					
					var modalID = '#edit_contet'+education_id;
					readEducation();
					$(modalID).modal('hide');

					}, 1000);
					
					
					
					

				}
				else if (result.status.trim() == 'error')
                {
					$('#show_error2').html(result.data);
				}
        },
		error: function (result) {

                $('#show_error2').html(result.data);
            }
		
		
      });
    }
  </script>