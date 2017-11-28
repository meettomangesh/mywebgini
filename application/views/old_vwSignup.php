<?php
$this->load->view('vwHeader');
?>

<div class="page-header container">
  <h1><small>SignUp</small></h1>
</div>


<div class="container">
    
 <div class="panel panel-default" >
        <!-- Default panel contents -->
        <div class="panel-heading">Register User </div>
		<form action="<?php echo base_url();?>users/insert_user" method="post" enctype="multipart/form-data">
		
        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Titles</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Is a company/individual</td>
			  <td>
			  <input type="radio" name="is_company_individual" value="company" checked> Company <input type="radio" name="is_company_individual" value="individual"> Individual </td>
            </tr>
            <tr>
              <td>Name of company/individual</td>
			  <td><input type="textbox" class="form-control" name="company_name" placeholder="Name of company/individual" required></td>
            </tr>
            <tr>
              <td>Country</td>
			  <td>
				<select name="country_name" id="country_name" class="form-control" onchange="get_states(this.value);">
					<option value="">Select Country</option>
					<?php foreach($countries as $country){ ?>
						<option value="<?php echo $country->id;?>" ><?php echo $country->name; ?></option>
					<?php } ?>
				</select>
			  </td>
            </tr>
            <tr>
              <td>State</td>
			  <td id="state">
				<select name="state_name" id="state_name" class="form-control">
					<option value="" >Select State</option>
				</select>
			  </td>
            </tr>
            <tr>
              <td>City</td>
			  <td id='city'>
				<select name="city_name" id="city_name" class="form-control">
					<option value="" >Select City</option>
				</select>
			  </td>
            </tr>
            <tr>
              <td>Landmark</td>
			  <td><textarea name="landmark" id="landmark" class="form-control" placeholder="Landmark"></textarea></td>
            </tr>
            <tr>
              <td>Address</td>
			  <td><textarea name="address" id="address" class="form-control" placeholder="Address"></textarea></td>
            </tr>
            <tr>
              <td>Email</td>
			  <td><input type="textbox" name="email" id="email" required class="form-control" placeholder="Email" onblur="check_email(this.value);"></td>
            </tr>
            <tr>
              <td>Phone</td>
			  <td><input type="textbox" class="form-control" name="phone" id="phone" placeholder="Phone" required></td>
            </tr>
            <tr>
              <td>Years of experience</td>
			  <td><input type="textbox" class="form-control" name="years_of_experience" id="years_of_experience" placeholder="Years of experience" required></td>
            </tr>
            <tr>
              <td>Turn Over</td>
			  <td><input type="textbox" class="form-control" name="turn_over" id="turn_over" placeholder="Turn Over" required></td>
            </tr>
            <tr>
              <td>Website</td>
			  <td><input type="textbox" class="form-control" name="website" id="website" placeholder="Website" required></td>
            </tr>
            <tr>
              <td>About company/individual</td>
			  <td><textarea name="about_company" id="about_company" class="form-control" placeholder=" About company/individual"></textarea></td>
            </tr>
            <tr>
              <td>No of employee</td>
			  <td><input type="textbox" class="form-control" name="no_of_employee" id="no_of_employee" placeholder="No of employee" required></td>
            </tr>
            <tr>
              <td>Portfolio</td>
			  <td>
				<div id="portfolio_div">
					<textarea name="portfolio_description[]" id="portfolio_description" class="form-control" placeholder="Project description"></textarea>
					<input type="text" name="portfolio_url[]" id="portfolio_url" class="form-control" placeholder="Project URL">
				</div>
				<input type="button" id="add_more" value="Add More" class="btn btn-default">
			  </td>
            </tr>
            <tr>
              <td>Roles of company/individual</td>
			  <td>
				<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
				  Select Roles of company/individual
				</button>
				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Roles of company/individual</h4>
					  </div>
					  <div class="modal-body">
						<?php foreach($skillsets as $skillset){ ?>
							<br><input type="checkbox" name="roles_of_company[]" value="<?php echo $skillset->id;?>"> <?php echo $skillset->skill; ?>
						<?php } ?>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
					  </div>
					</div>
				  </div>
				</div>

				<!--<select name="roles_of_company[]" id="roles_of_company"  multiple="multiple">
					<?php foreach($skillsets as $skillset){ ?>
						<option value="<?php echo $skillset->id;?>" ><?php echo $skillset->skill; ?></option>
					<?php } ?>
				</select>-->		
				</td>
            </tr>
            <tr>
              <td>Upload Company Logo / Individual Photo</td>
			  <td><input type="file" name="userfile" id="userfile" class="form-control"> </td>
            </tr>			
            <tr>
              <td>Password</td>
			  <td><input type="password" name="password" id="password" class="form-control" placeholder="Password"> </td>
            </tr>			
            <tr>
              <td>Confirm Password</td>
			  <td><input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password"> </td>
            </tr>
			<tr>
				<td colspan='2' style="text-align:center"><input type="submit" name="submit" value="Submit" class="btn"></td>
				
			</tr>
          </tbody>
        </table>
		</form>
		
      </div>


</div>

  
     <hr>
<?php
$this->load->view('vwFooter');
?>

<script>
		function get_states(country_id){
			$.ajax({				
				url:"<?php echo base_url('states/get_countrywise_states');?>",
				type:"post",
				data:{
					country_id:country_id
				},
				success:function(data){
					//console.log(data);
					$("#state").html(data);;
				}
			});
		}
		function get_cities(state_id){
			$.ajax({				
				url:"<?php echo base_url('cities/get_statewise_cities');?>",
				type:"post",
				data:{
					state_id:state_id
				},
				success:function(data){
					//console.log(data);
					$("#city").html(data);;
				}
			});
		}
		function check_email(emailid){
			$.ajax({				
				url:"<?php echo base_url('signup/check_email');?>",
				type:"post",
				data:{
					emailid:emailid
				},
				success:function(data){
					//console.log(data);
					if(data!=''){
						swal('Oops...',data,'error');
						$("#email").val('');
					}
				}
			});
		}
	</script>
	<script type="text/javascript">
			$(document).ready(function() {
				$('#roles_of_company').multiselect({
					includeSelectAllOption: true,
					 maxHeight: 200,
					onChange: function(option, checked) {
						var id=option.context.value;
						$.ajax({
							url:"<?php echo base_url('SignUp/check_parent_skillset');?>",
							type:"POST",
							data:{
								id:id
							},
							success: function(data){
								var res;
								if(data!=''){
									res = data.split(",");
								}
								$('#roles_of_company').multiselect('select', res);
							}
						});
					}
				});
			});
		</script>
		<script>
			$("#add_more").on("click",function(){
				//alert("hi");
				$("#portfolio_div").append('<textarea name="portfolio_description[]" id="portfolio_description" class="form-control" placeholder="Project description"></textarea><input type="text" name="portfolio_url[]" id="portfolio_url" class="form-control" placeholder="Project URL">');
			});
		</script>