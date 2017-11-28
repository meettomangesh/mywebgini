<?php
$this->load->view('admin/vwHeader');
?>
<link href="<?php echo HTTP_CSS_PATH; ?>starter-template.css" rel="stylesheet">
 <style>
/*     .panel{
       margin-left: 55px;
       float: left;
    width: 500px;}
     */
     </style>
<div class="page-header container">
  <h1><small>Users</small></h1>
</div>
    <div class="container">
 
 <div class="panel panel-default" >
        <!-- Default panel contents -->
        <div class="panel-heading">Edit User Details <span style='float:right; margin-top: -7px;'><a class="btn btn-info" href="<?php echo base_url('admin/users/');?>">Back</a></span></div>
		<form action="<?php echo base_url();?>admin/users/update_user" method="post">
		
        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Titles</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
			<?php 
			if(isset($users) && !empty($users)){
			foreach($users as $user){ ?>
            <tr>
              <td>Is a company/individual</td>
			  <td>
			  <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
			  <input type="radio" name="is_company_individual" value="company" <?php if($user->is_company_individual=="company"){echo "checked";} ?>> Company <input type="radio" name="is_company_individual" value="individual" <?php if($user->is_company_individual=="individual"){echo "checked";} ?>> Individual </td>
            </tr>
            <tr>
              <td>Name of company/individual</td>
			  <td><input type="textbox" class="form-control" name="company_name" value="<?php echo $user->company_name; ?>"  required></td>
            </tr>
            <tr>
              <td>Country</td>
			  <td>
				<select name="country_name" id="country_name" class="form-control" onchange="get_states(this.value);">
					<option value="">Select Country</option>
					<?php foreach($countries as $country){ ?>
						<option value="<?php echo $country->id;?>" <?php if($user->country==$country->id) echo "selected"; ?> ><?php echo $country->name; ?></option>
					<?php } ?>
				</select>
			  </td>
            </tr>
            <tr>
              <td>State</td>
			  <td id="state">
				<select name="state_name" id="state_name" class="form-control">
					<option value="<?php echo $user->state;?>" ><?php echo $user->state_name; ?></option>
				</select>
			  </td>
            </tr>
            <tr>
              <td>City</td>
			  <td id='city'>
				<select name="city_name" id="city_name" class="form-control">
					<option value="<?php echo $user->city;?>" ><?php echo $user->city_name; ?></option>
				</select>
			  </td>
            </tr>
            <tr>
              <td>Landmark</td>
			  <td><textarea name="landmark" id="landmark" class="form-control"><?php echo $user->landmark; ?></textarea></td>
            </tr>
            <tr>
              <td>Address</td>
			  <td><textarea name="address" id="address" class="form-control"><?php echo $user->address; ?></textarea></td>
            </tr>
            <tr>
              <td>Email</td>
			  <td><input type="textbox" name="email" id="email" required readonly value="<?php echo $user->email; ?>" class="form-control"></td>
            </tr>
            <tr>
              <td>Phone</td>
			  <td><input type="textbox" class="form-control" name="phone" id="phone" value="<?php echo $user->phone; ?>"  required></td>
            </tr>
            <tr>
              <td>Years of experience</td>
			  <td><input type="textbox" class="form-control" name="years_of_experience" id="years_of_experience" value="<?php echo $user->years_of_experience; ?>"  required></td>
            </tr>
            <tr>
              <td>Turn Over</td>
			  <td><input type="textbox" class="form-control" name="turn_over" id="turn_over" value="<?php echo $user->turn_over; ?>"  required></td>
            </tr>
            <tr>
              <td>Website</td>
			  <td><input type="textbox" class="form-control" name="website" id="website" value="<?php echo $user->website; ?>"  required></td>
            </tr>
            <tr>
              <td>About company/individual</td>
			  <td><textarea name="about_company" id="about_company" class="form-control"><?php echo $user->about_company; ?></textarea></td>
            </tr>
            <tr>
              <td>No of employee</td>
			  <td><input type="textbox" class="form-control" name="no_of_employee" id="no_of_employee" value="<?php echo $user->no_of_employee; ?>"  required></td>
            </tr>
            <tr>
              <td>Portfolio</td>
			  <td><textarea name="portfolio" id="portfolio" class="form-control"><?php echo $user->portfolio; ?></textarea></td>
            </tr>
            <tr>
              <td>Roles of company/individual</td>
			  <td><input type="hidden" name="roles_of_company" value="<?php echo $user->roles_of_company; ?>"><?php echo $user->roles_of_company; ?></td>
            </tr>
            <tr>
              <td>Status</td>
			  <td><input type="radio" name="status" value="active" <?php if($user->status=="active"){echo "checked";} ?>> Active <input type="radio" name="status" value="deactive" <?php if($user->status=="deactive"){echo "checked";} ?>> deactive <input type="radio" name="status" value="deleted" <?php if($user->status=="deleted"){echo "checked";} ?>> deleted</td>
            </tr>
			<tr>
				<td colspan='2' style="text-align:center"><input type="submit" name="submit" value="Submit" class="btn"></td>
				
			</tr>
			
			<?php } } ?>				
          </tbody>
        </table>
		</form>
		
      </div>
 
    </div><!-- /.container -->
     
	
<?php
$this->load->view('admin/vwFooter');
?>
<script>
		function get_states(country_id){
			$.ajax({				
				url:"<?php echo base_url('admin/states/get_countrywise_states');?>",
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
				url:"<?php echo base_url('admin/cities/get_statewise_cities');?>",
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
	</script>