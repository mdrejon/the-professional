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
</style>
<div id="update_expertise" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		<h5 class="modal-title">Update your expertise to work</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <div class="modal-body">
       <div class="row">
			<div class="col-lg-12">
				<div class="form-content">
					<div id="show_error"></div>
					<!-- <form method="POST" accept="#"> -->
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<select class="select2 mb-10 select2-multiple expertise_list" name="expertise_list[]" style="width: 100%" multiple="multiple" data-placeholder="Choose">

									<?php foreach ($expertise_lists as $expertise_list): ?>
										<option disabled selected="selected" value="<?php echo $expertise_list ?>"><?php echo $expertise_list ?></option>
									<?php endforeach ?>
									<?php
										$sql_parent_menu = "SELECT e.expertise_title as expertise_title FROM dir_expertise e  union select c.categories_name as expertise_title from dir_categories c";

									   $parent_query = $db->select($sql_parent_menu);

										while($parent_obj = mysqli_fetch_object($parent_query)):
									 ?>
									 
										<option value="<?php echo $parent_obj->expertise_title ?>"><?php echo $parent_obj->expertise_title ?></option>
									  <?php endwhile; ?>
										<!-- <option value="HI">Hawaii</option> -->
									
								 </select>

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
      	<button type="submit" onclick="updateExpertise()" >Update Expertise</button>
      </div>
    </div>

  </div>
</div>
<!-- <div id="education" class=" mfp-hide white-popup">
	<div class="container">
		
	</div>
</div> -->
<script type="text/javascript">
  	function updateExpertise(){
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
  </script>