<!-- start Footer Section -->
 <?php require_once('common/footer_menu.php'); ?>
 <!-- End Footer Section -->

  <script src="<?php echo SITE_URL;?>/js/vendor/modernizr-3.8.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="<?php echo SITE_URL;?>/js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <!-- Bootstrap Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!--Bootstrap Js -->
  <script src="<?php echo SITE_URL;?>/js/bootstrap.min.js"></script>
  <!--Bootstrap Js -->
  <script src="<?php echo SITE_URL;?>/hdadmin/assets/plugins/select2/select2.min.js"></script> <!-- Select2 Js -->

  <script src="<?php echo SITE_URL;?>/hdadmin/assets/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo SITE_URL;?>/hdadmin/assets/js/pages/forms/editors.js"></script>
  <script src="<?php echo SITE_URL;?>/js/stellarnav.js"></script>
   <!--Owl carousel Js -->
  <script src="<?php echo SITE_URL;?>/js/owl.carousel.min.js"></script>
  <script type="text/javascript" src="typeahead.js"></script>
   <!--All Custom Js -->
  <script src="<?php echo SITE_URL;?>/js/plugins.js"></script>
  <script src="<?php echo SITE_URL;?>/js/main.js"></script>
  <script>
    window.onload=load();
    function load() {
    document.getElementById('noscriptmsg').style.display = "none";
  }
  </script>

  <script type="text/javascript">
  function CheckFrom(val) {
    var element = document.getElementById('otherfrom');
    if (val == 'others') {
      element.style.display = 'block';
    } else {
      element.style.display = 'none';
      var once = document.getElementById('once');
      once.style.background = 'white';
      var oi = document.getElementById('of');
      oi.value = '';
    }
  }
</script>

<script src="https://nutajir.com/hdadmin/assets/js/jquery.PrintArea.js" ></script>

  <script>
      $(document).ready(function () {
        $("#print").on('click', function() {
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printableArea").printArea(options);
            });



            $('#myModal3b').modal('show');

            function sub_popup() {
              setTimeout(function(){ $('#myModal3b').modal('hide'); }, 5000);
            }
            sub_popup();

            function regpopup() {
              setTimeout(function(){ $('#myModal3a').modal('show'); }, 5000);
            }
            regpopup();

            $("#sub_user").keyup(function(){
              var user = $('#sub_user').val();
              $.ajax({
                url:'newsletter_action.php',
                data:
                      {
                          u: user
                      },
                success: function(data){
                  $('#sub_content').html(data);
                  },
              });
          });
            $("#nl_button").click(function(){
              var user = $('#sub_user').val();
              $.ajax({
                url:'newsletter_action.php',
                data:
                      {
                          click_nl: user
                      },
                success: function(data){
                  $('#sub_content').html(data);
                  },
              });
          });





          $('#txtCountry').typeahead({
              source: function (query, result) {
                  $.ajax({
                      url: "search.php",
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




  <script>
  $(document).ready(function () {
	  $('.location-track-icon').click(function () {
	      //alert('');
			getLocation();
	  });


    $("#CurrentLocation").val('');
    if ($('#lat').length) {
        $('#lat').val('');
    }
    if ($('#lng').length) {
        $('#lng').val('');
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
                                        }
                                    }
                                }

                                $("#CurrentLocation").val(city + ', '+ county);
                                //createCookie('Location', 'locationshared', 1);
//alert(city + ', '+ county);
                                UpdatePlaceDetails(results[0], '#CurrentLocation');
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
});

function getLocation() {
	$("#CurrentLocation").val('');
    if ($('#lat').length) {
        $('#lat').val('');
    }
    if ($('#lng').length) {
        $('#lng').val('');
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
                                        }
                                    }
                                }

                                $("#CurrentLocation").val(city + ', '+ county);
                                //createCookie('Location', 'locationshared', 1);
//alert(city + ', '+ county);
                                UpdatePlaceDetails(results[0], '#CurrentLocation');
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

    if ($("#CurrentLocation").length) {

        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('CurrentLocation')),
            options);

        autocomplete.setFields(fields);
        //autocomplete.addListener('place_changed', fillInAddress);
    }


}
function updateLocation(location='') {
   url = 'https://academichub.hostdivine.com/';

	if(location){ alert('call');
		$.ajax({
			type:'POST',
			url:'libs/updatelocation.php',
			data:'location='+location,
			success:function(html){

			}
		});
	}
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
   <script src="<?php echo SITE_URL;?>/js/ipay-ghana.js"></script>


</body>

</html>
