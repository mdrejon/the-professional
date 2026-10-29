<!DOCTYPE html>
<html lang="en"><head>
    <title>Bootstrap Tags Input with Autocomplete</title>
	<link href="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/typeahead.css"  rel="stylesheet" />
	
    <link rel="stylesheet" href="https://hostdivine.com/clients/directory-admin/assets/css/bootstrap-tagsinput.css">
    <style>
	<!--
	.twitter-typeahead { display:initial !important; }
	.bootstrap-tagsinput {line-height:40px;display:block !important;}
	.bootstrap-tagsinput .tag {background:#09F;padding:5px;border-radius:4px;}
	.tt-hint {top:4px !important;}
	.tt-input{vertical-align:baseline !important;}
	.typeahead { border: 1px solid #CCCCCC;border-radius: 4px;padding: 8px 12px;width: 300px;font-size:1.5em;}
	.tt-menu { width:300px; }
	span.twitter-typeahead .tt-suggestion {padding: 10px 20px;	border-bottom:#CCC 1px solid;cursor:pointer;}
	span.twitter-typeahead .tt-suggestion:last-child { border-bottom:0px; }-->
	
	</style>

</head>
<body>


		<input type="text" id="tags-input" data-role="tagsinput" />
	

	<script src="https://phppot.com/demo/bootstrap-tags-input-with-autocomplete/jquery-1.11.2.min.js"></script>
	<script src="https://hostdivine.com/clients/directory-admin/assets/js/typeahead-v11.js"></script>
	
	<script src="https://hostdivine.com/clients/directory-admin/assets/js/bootstrap-tagsinput.js"></script>

	<script>
	var keySkills = new Bloodhound({
	  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	  queryTokenizer: Bloodhound.tokenizers.whitespace,
	  prefetch: {
		url: 'https://hostdivine.com/clients/directory-admin/inc/search.php',
		filter: function(list) {
		  return $.map(list, function(name) {
			return { name: name }; });
		}
	  }
	});
	keySkills.initialize();

	$('#tags-input').tagsinput({
	  typeaheadjs: {
		name: 'keySkills',
		displayKey: 'name',
		valueKey: 'name',
		source: keySkills.ttAdapter()
	  }
	});
	</script>


	
</body></html>