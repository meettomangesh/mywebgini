<?php
$this->load->view('vwHeader');
?>
<div class="search-res row no-con">
	<?php $this->load->view('vwSearchResultLeftPage'); ?>
	<div class="sres-main">
		<div class="row">
			<?php $this->load->view('vwSearchResultListing'); ?>			
			<?php $this->load->view('vwSearchResultRightPage'); ?>
		</div>
		<!--<div class="row">
		<div class="col s12">
			<div id="map" style="width: 100%; height: 90%"></div>
		</div>	
		</div>-->
	</div>
<?php
$this->load->view('vwFooter');
?>
<script>
function get_states(country_id){
			$.ajax({				
				url:"<?php echo base_url('states/get_country_states');?>",
				type:"post",
				data:{
					country_id:country_id
				},
				success:function(data){
					var state_array = JSON.parse(data);
										
					$('select').material_select();
					
					var $selectDropdown = $("#state_name").empty().html(' ');
					
					for(var i=0; i<state_array.length;i++){
						//console.log(state_array[i]);
						$selectDropdown.append($("<option></option>").attr("value",state_array[i].id).text(state_array[i].name));
					}

					// trigger event
					$selectDropdown.trigger('contentChanged');
					
				}
			});
			$('select').on('contentChanged', function() {
				// re-initialize (update)
				$(this).material_select();
			  });
		}
		function get_cities(state_id){
			$.ajax({				
				url:"<?php echo base_url('cities/get_state_cities');?>",
				type:"post",
				data:{
					state_id:state_id
				},
				success:function(data){
					var city_array = JSON.parse(data);
					$('select').material_select();
					
					var $selectDropdown = $("#city_name").empty().html(' ');
					
					for(var i=0; i<city_array.length;i++){
						//console.log(city_array[i]);
						$selectDropdown.append($("<option></option>").attr("value",city_array[i].id).text(city_array[i].name));
					}
					// trigger event
					$selectDropdown.trigger('contentChanged');
					
				}
			});
			$('select').on('contentChanged', function() {
				// re-initialize (update)
				$(this).material_select();
			});
		}
		function getMap(){
            var country_id = $("#country_name").val();
            var state_id = $("#state_name").val();
            var city_id = $("#city_name").val();
            $.ajax({
              url:'<?php echo base_url('search/getMapElements');?>',
              type:'POST',
              data:{'country_id':country_id,'state_id':state_id,'city_id':city_id},
              success:function(xml){
                    console.log(xml);
                    var markerNodes = xml.documentElement.getElementsByTagName("marker");
                    var bounds = new google.maps.LatLngBounds();
                    for (var i = 0; i < markerNodes.length; i++) {
                      var id = markerNodes[i].getAttribute("id");
                      var name = markerNodes[i].getAttribute("name");
                      var address = markerNodes[i].getAttribute("address");
                      var city_name = parseFloat(markerNodes[i].getAttribute("city_name"));
                      var latlng = new google.maps.LatLng(
                           parseFloat(markerNodes[i].getAttribute("lat")),
                           parseFloat(markerNodes[i].getAttribute("lng")));

                      createOption(name, city_name, i);
                      createMarker(latlng, name, address);
                      bounds.extend(latlng);
                    }
                    map.fitBounds(bounds);
                    map.setZoom(8);
                    //locationSelect.style.visibility = "visible";
                    /*locationSelect.onchange = function() {
                      var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
                      google.maps.event.trigger(markers[markerNum], 'click');
                    };*/
                    
              },
              error:function(){
                  
              }              
          });
          /*$.ajax({
              url:'ajaxCall.php',
              type:'POST',
              data:{'what':'mapList','country_id':country_id,'state_id':state_id,'city_id':city_id},
              success:function(data){
                 $("#maplist").html(data);   
                 $("div.listitem").click(function() {
                    var markerNum = $(this).attr('id');
                    google.maps.event.trigger(markers[markerNum], 'click');
                });
              },
              error:function(){
                  
              }              
          });*/
        }
		var map;
		var markers = [];
		var infoWindow;
		var locationSelect;

        function initMap() {
          //var sydney = {lat: -33.863276, lng: 151.107977};
          var Lucknow = {lat: 24.8559743, lng: 77.9075698};
          map = new google.maps.Map(document.getElementById('map'), {
            center: Lucknow,
            zoom: 5,
            mapTypeId: 'roadmap',
            mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
          });
          infoWindow = new google.maps.InfoWindow();

          //searchButton = document.getElementById("searchButton").onclick = searchLocations;

          //locationSelect = document.getElementById("locationSelect");
          /*locationSelect.onchange = function() {
            var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
            if (markerNum != "none"){
              google.maps.event.trigger(markers[markerNum], 'click');
            }
          };*/          
        }
		function createOption(name, distance, num) {
          var option = document.createElement("option");
          option.value = num;
          option.innerHTML = name;
          //locationSelect.appendChild(option);
       }
	   function createMarker(latlng, name, address) {
           console.log(latlng);
          var html = "<b>" + name + "</b> <br/>" + address +"<br/><a href='http://google.com' target='_blank'>Click Here</a>";
          var marker = new google.maps.Marker({
            map: map,
            position: latlng
          });
          google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
          });
          markers.push(marker);
        }
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_8tVyvLsvHU6Aj_rw-_YZKQxdp4tpuFc&callback=initMap">
    </script>