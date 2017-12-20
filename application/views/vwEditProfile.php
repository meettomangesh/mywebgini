<?php
$this->load->view('vwHeader');
?>
<?php 
    if(isset($users) && !empty($users)){
    foreach($users as $user){ 
			//echo "<pre>";print_r($user);print_r($members);print_r($skills);die;?>
<form action="<?php echo base_url("users/update_user");?>" method="post" name="edit_member_form" id="edit_member_form" onsubmit="return validate();" enctype="multipart/form-data" >			
<div class="signup-box">
        	<div class="container">
               	<div id="signup-company">
                    <div class="top-head">
                        <h3><i class="fa fa-briefcase" aria-hidden="true"></i> <?php if($user->is_company_individual=='2'){ ?>Company <?php }else{ ?> Individual<?php } ?> Profile</h3>
                        <p>Hey, it's easier than it looks. Take a deep breath and complete the fields below. You'll have a beautiful page!</p>
                    </div>
                    <div class="sign-form">
                        <div class="row">
                            <div class="col s6">
                                <div class="row">
                                    <div class="input-field col s12">
									<input type="hidden" name="user_id" value="<?php echo $user->id;?>">
									  <!--<input type="text" class=" nr" name="company_name" value="<?php echo $user->company_name; ?>"  required>-->
									  <input type="text" class=" nr" name="company_name" value="<?php echo $user->company_name; ?>"  required>
                                      <label for="first_name2">Name of the Company</label>
                                    </div>
                                    <div class="input-field col s12">
                                      <input type="text" class=" nr" name="website" id="website" value="<?php echo $user->website; ?>"  required>
                                      <label for="first_name2">Website</label>
                                    </div>									
									<div class="input-field col s6">
										<input name="emailid" id="emailid" type="text" class=" nr" value="<?php echo $user->email; ?>" readonly>
										<label for="emailid">Email</label>
									</div>
									<div class="input-field col s6">
										<input name="phone" id="phone" type="text" class=" nr" value="<?php echo $user->phone; ?>">
										<label for="extra_phone[]">Phone</label>
									</div>
                                    <div class="input-field s- col s6">
									<input type="text" class=" nr" name="no_of_employee" id="no_of_employee" value="<?php echo $user->no_of_employee; ?>"  required>
                                      <label for="no_of_employee">No of employee</label>
                                    </div>
                                    <div class="input-field s- col s6">
									<input type="text" class=" nr" name="years_of_experience" id="years_of_experience" value="<?php echo $user->years_of_experience; ?>"  required>
									<label for="years_of_experience">Year Established</label>
                                    </div>
                                    <div class="col s4">
                                        <div class="up-logo">
                                            <label>Company Logo</label>
                                            <div class="logo-box">
											<input type="hidden" name="hidden_photo" value="<?php echo $user->photo; ?>">
			  <?php 
				if(isset($user->photo) && $user->photo!=''){ ?>
					<img src="<?php echo base_url('images/'.$user->photo); ?>" height="100" width="100" style="border-radius: 50%;" id="company_logo">
				<?php } ?>
											</div>
											<input type="file" name="userfile" id="userfile" >
                                        </div>
                                    </div>
                                    <div class="col s8">
                                        <div class="input-field ab-comp">
                                            <textarea name="about_company" id="about_company" class="materialize-textarea " data-length="250"><?php echo $user->about_company; ?></textarea>
                                            <label for="textarea1">Write about your company</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s6">
								<div>
								<?php
									$extra_emailid = explode("|",$user->extra_emailid);
									$extra_phone = explode("|",$user->extra_phone);
									$landmark = explode("|",$user->landmark);
									$address = explode("|",$user->address);
									$ctry = explode("|",$user->country);
									$ste = explode("|",$user->state);
									$cty = explode("|",$user->city);				
									$ctry_ids = explode("|",$user->country_ids);
									$ste_ids = explode("|",$user->state_ids);
									$cty_ids = explode("|",$user->city_ids);
									$latitude = explode("|",$user->latitude);
									$longitude = explode("|",$user->longitude);
									$as_head_office = explode("|",$user->as_head_office);
									$address_id = explode("|",$user->address_id);
                                 	
								if(isset($ctry) && count($ctry)>0){	
								for($i=0; $i<count($ctry); $i++){	
								?>
                                <div class="add-box locationRow" id="locationRow_<?php echo ($i+1); ?>">
                                    <div class="row">
                                        <div class="input-field col s12">
										<input type="hidden" id="address_id_<?php echo ($i+1); ?>" name="address_id[]" value="<?php echo $address_id[$i];?>">
                                          <input id="address_<?php echo ($i+1); ?>" type="text" class=" nr" name="address[]" value="<?php echo $address[$i]; ?>">
                                          <label for="address[]">Address</label>
                                        </div>
                                        <div class="input-field s- col s6">
                                            <select name="country_name[]" id="country_name_<?php echo ($i+1); ?>" class="form-control" onchange="get_states(this.id,this.value);">
										<option value="">Select Country</option>
										<?php foreach($countries as $country){ ?>
											<option value="<?php echo $country->id;?>" <?php if($ctry_ids[$i]==$country->id) echo "selected"; ?> ><?php echo $country->name; ?></option>
										<?php } ?>
									</select>
									<label for="country_name[]">Country</label>                        
									</div>
                                        <div id="state_<?php echo ($i+1); ?>" class="input-field s- col s6">
                                            <select name="state_name[]" id="state_name_<?php echo ($i+1); ?>" class="form-control">
											<option value="<?php echo $ste_ids[$i];?>" ><?php echo $ste[$i]; ?></option>
										</select>
										<label for="state_name[]">State</label> 
                                        </div>										
                                        <div id="city_<?php echo ($i+1); ?>" class="input-field s- col s6">
                                            <select name="city_name[]" id="city_name_<?php echo ($i+1); ?>" class="form-control">
											<option value="<?php echo $cty_ids[$i];?>" ><?php echo $cty[$i]; ?></option>
										</select><label for="city_name[]">City</label> 
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="landmark_<?php echo ($i+1); ?>" name="landmark[]" type="text" class=" nr" value="<?php echo $landmark[$i]; ?>">
                                            <label for="landmark[]">Landmark</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input name="extra_emailid[]" id="extra_emailid_<?php echo ($i+1); ?>" type="text" class=" nr" value="<?php echo $extra_emailid[$i]; ?>">
                                            <label for="extra_emailid[]">Email</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input name="extra_phone[]" id="extra_phone_<?php echo ($i+1); ?>" type="text" class=" nr" value="<?php echo $extra_phone[$i]; ?>">
                                            <label for="extra_phone[]">Phone</label>
                                        </div>
                                    </div>
                                    <div class="mt10">
                                        <div class="right">							
                                          <input type="radio" class="filled-in" id="as_head_office_<?php echo ($i+1); ?>" name="as_head_office" <?php if($as_head_office[$i]=='1'){ echo "checked"; }?> value="<?php echo ($i+1); ?>" />
                                          <label id="lbl_as_head_office_<?php echo ($i+1); ?>" for="as_head_office_<?php echo ($i+1); ?>">Mark as Headoffice</label>
                                        </div>
                                        <div class="edit-del"><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></div>
                                    </div>
                                </div>
								<?php }
								}else{ ?>
								<div class="add-box locationRow" id="locationRow_1">
                                    <div class="row">
                                        <div class="input-field col s12">
										<input type="hidden" id="address_id_1" name="address_id[]" value="">
                                          <input id="address_1" type="text" class=" nr" name="address[]" value="">
                                          <label for="address[]">Address</label>
                                        </div>
                                        <div class="input-field s- col s6">
                                            <select name="country_name[]" id="country_name_1" class="form-control" onchange="get_states(this.id,this.value);">
										<option value="">Select Country</option>
										<?php foreach($countries as $country){ ?>
											<option value="<?php echo $country->id;?>"><?php echo $country->name; ?></option>
										<?php } ?>
									</select>
									<label for="country_name[]">Country</label>                        
									</div>
                                        <div id="state_1" class="input-field s- col s6">
                                            <select name="state_name[]" id="state_name_1" class="form-control">
											<option value="">Select State</option>
										</select>
										<label for="state_name[]">State</label> 
                                        </div>										
                                        <div id="city_1" class="input-field s- col s6">
                                            <select name="city_name[]" id="city_name_1" class="form-control">
											<option value="" >Select City</option>
										</select><label for="city_name[]">City</label> 
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="landmark_1" name="landmark[]" type="text" class=" nr" value="">
                                            <label for="landmark[]">Landmark</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input name="extra_emailid[]" id="extra_emailid_1" type="text" class=" nr" value="1">
                                            <label for="extra_emailid[]">Email</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input name="extra_phone[]" id="extra_phone_1" type="text" class=" nr" value="">
                                            <label for="extra_phone[]">Phone</label>
                                        </div>
                                    </div>
                                    <div class="mt10">
                                        <div class="right">							
                                          <input type="checkbox" class="filled-in" id="as_head_office_1" name="as_head_office" value='1' />
                                          <label id="lbl_as_head_office_1" for="as_head_office_1">Mark as Headoffice</label>
                                        </div>
                                        <div class="edit-del"><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></div>
                                    </div>
                                </div>
								<?php } ?>
								</div>
                                <div class="add-moread right-align mt15">
                                    <button  id="addMore" type="button" class="btn bts btn-grey"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add More Address</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 mt20">
                                <div class="shead mb5"><span><i class="fa fa-user" aria-hidden="true"></i> Key Members </span></div>
								<?php if(isset($members) && count($members)>0){	
								for($i=0; $i<count($members); $i++){ ?>
                                <div class="memberRow" id="memberRow_<?php echo ($i+1);?>">
								<div class="row key-mem">
                                    <div class="col s4">
                                        <div class="up-logo">
                                            <label>Photo</label>
                                            <div class="logo-box" id="logo-box_<?php echo ($i+1);?>">
											<?php if($members[$i]->member_image!=''){ ?>
											<img src="<?php echo base_url('images/members/'.$this->session->userdata('member_id').''.$members[$i]->member_image);?>" alt="<?php echo $members[$i]->member_name;?>" id="member_photo_<?php echo ($i+1);?>" class="member_photo">
											<?php }else{  ?>
											<img src="<?php echo base_url('images/members/default-member.jpg');?>" alt="" id="member_photo_<?php echo ($i+1);?>">
											<?php } ?>
											</div>
											<input type="file" name="member_image[]" id="member_image_<?php echo ($i+1); ?>"  class="member_photo">
                                        </div>
                                    </div>
                                    <div class="col s8">
                                        <div class="input-field">
                                          <input type="hidden" id="member_id_<?php echo ($i+1); ?>" name="member_id[]" value="<?php echo $members[$i]->id; ?>">
										  
										  <input id="member_name_<?php echo ($i+1); ?>" name="member_name[]" type="text" class=" nr" value="<?php echo $members[$i]->member_name; ?>">
                                          <label for="member_name[]">Name</label>
                                        </div>
                                        <div class="input-field">
                                          <input id="member_designation_<?php echo ($i+1); ?>" name="member_designation[]" type="text" class=" nr" value="<?php echo $members[$i]->member_designation; ?>">
                                          <label for="member_designation[]">Designation</label>
                                        </div>
                                        <div class="input-field ab-brif">
                                            <textarea  id="member_description_<?php echo ($i+1); ?>" name="member_description[]" class="materialize-textarea " data-length="100"><?php echo $members[$i]->member_description; ?></textarea>
                                            <label for="member_description[]">Write about your company</label>
                                        </div>
                                    </div>  
                                </div>
								</div>
								<?php }
								}else{ ?>
								<div class="memberRow" id="memberRow_1">
								<div class="row key-mem">
                                    <div class="col s4">
                                        <div class="up-logo">
                                            <label>Photo</label>
                                            <div class="logo-box" id="logo-box_1">			
											<img src="<?php echo base_url('images/members/default-member.jpg');?>" alt="" id="member_photo_1">
											</div>
											<input type="file" name="member_image[]" id="member_image_1"  class="member_photo">
                                        </div>
                                    </div>
                                    <div class="col s8">
                                        <div class="input-field">
                                          <input type="hidden" id="member_id_1" name="member_id[]">
										  <input id="member_name_1" name="member_name[]" type="text" class=" nr">
                                          <label for="member_name[]">Name</label>
                                        </div>
                                        <div class="input-field">
                                          <input id="member_designation_1" name="member_designation[]" type="text" class=" nr">
                                          <label for="member_designation[]">Designation</label>
                                        </div>
                                        <div class="input-field ab-brif">
                                            <textarea  id="member_description_1" name="member_description[]" class="materialize-textarea " data-length="100"></textarea>
                                            <label for="member_description[]">Write about your company</label>
                                        </div>
                                    </div>  
                                </div>
								</div>
								<?php } ?>
								
								<div class="add-moread right-align mt15">
									<button id="addMoreMember" type="button" class="btn bts btn-grey"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add More Member</button>
								</div>
								</div>
                            <div class="col s6 mt20">
                                <div class="shead mb5"><span><i class="fa fa-file-image-o" aria-hidden="true"></i> Portfolio</span></div>
								<?php if(isset($portfolios) && count($portfolios)>0){	
								for($i=0; $i<count($portfolios); $i++){ ?>
                                <div class="row key-portfolio portfolioRow" id="portfolioRow_<?php echo ($i+1);?>">
                                    <div class="col s12">
                                        <div class="input-field">
										<input type="hidden" id="portfolio_id_<?php echo ($i+1);?>" name="portfolio_id[]" value="<?php echo $portfolios[$i]->id; ?>">
                                          <input id="portfolio_url_<?php echo ($i+1);?>" name="portfolio_url[]" type="text" class=" nr" value="<?php echo $portfolios[$i]->portfolio_url; ?>">
                                          <label for="portfolio_url[]">Project URL</label>
                                        </div>
                                        <div class="input-field">
                                          <input id="portfolio_features_<?php echo ($i+1);?>" name="portfolio_features[]" type="text" class=" nr" value="<?php echo $portfolios[$i]->portfolio_features; ?>">
                                          <label for="portfolio_features[]">Features / Functions You Deployed  </label>
                                        </div>
                                        <div class="input-field ab-brif">
                                            <textarea name="portfolio_description[]" id="portfolio_description_<?php echo ($i+1);?>" class="materialize-textarea " data-length="100"><?php echo $portfolios[$i]->portfolio_description; ?></textarea>
                                            <label for="portfolio_description[]">Project description</label>
                                        </div>
                                    </div>
                                </div>
								<?php } }else{ ?>
								<div class="row key-portfolio portfolioRow" id="portfolioRow_1">
                                    <div class="col s12">
                                        <div class="input-field">
										<input type="hidden" id="portfolio_id_1" name="portfolio_id[]">
                                          <input id="portfolio_url_1" name="portfolio_url[]" type="text" class=" nr">
                                          <label for="portfolio_url[]">Project URL</label>
                                        </div>
                                        <div class="input-field">
                                          <input id="portfolio_features_1" name="portfolio_features[]" type="text" class=" nr">
                                          <label for="portfolio_features[]">Features / Functions You Deployed  </label>
                                        </div>
                                        <div class="input-field ab-brif">
                                            <textarea name="portfolio_description[]" id="portfolio_description_1" class="materialize-textarea " data-length="100"></textarea>
                                            <label for="portfolio_description[]">Project description</label>
                                        </div>
                                    </div>
                                </div>
								<?php } ?>
                                <div class="add-moread right-align mt15">
                                    <button type="button" id="addMorePortfolio" class="btn bts btn-grey"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add More Projects</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 mt20">
                                <div class="shead"><span><i class="fa fa-cog" aria-hidden="true"></i> Services Offered  </span></div>
                                <div>
								<select id="roles_of_company" name="roles_of_company[]" multiple>
							<option value="">Select Skill</option>
						  <?php		
						$user_skill = array_column($skills, 'roles_of_company');
						$no_of_projects = array_column($skills, 'no_of_projects');
						$rates_to_role = array_column($skills, 'rates_to_role');
						$role_ids = array_column($skills, 'id');
						$rates_to_role_combine = array_combine($user_skill,$rates_to_role);
						$no_of_projects_combine = array_combine($user_skill,$no_of_projects);
						  foreach($skillsets as $skill){ ?>
							<option value="<?php echo $skill->id; ?>" <?php if(is_array($user_skill) && in_array($skill->id,$user_skill)){ echo "selected";}?>><?php echo $skill->skill; ?></option>
						  <?php } ?>
						</select>
                                </div>
                            </div>
                            <div class="col s6 mt20">                               
								<div class="shead"><span><i class="fa fa-globe" aria-hidden="true"></i> Service Proficiency </span>	
                                <div class="website-pro2">
                                    <table class="responsive-table" id="skill_table">
                                        <thead>
                                          <tr>
                                              <th width="44%">Select Languages</th>
                                              <th width="28%">Competency Level Out of 10</th>
                                              <th width="28%">Number of Projects Executed</th>
                                          </tr>
                                        </thead>                            
		<tbody>
		<?php 
		if(isset($role_ids) && !empty($role_ids)){
		foreach($role_ids as $role_id){ ?>
			  <input type="hidden" value="<?php echo $role_id;?>" name="role_id[]">
		<?php } } ?>
		<?php 
		if(isset($skillsets) && count($skillsets)>0){
		for($i=0; $i< count($skillsets);$i++){ ?>
		  <tr class="skill_row" id="skill_row_<?php echo ($i+1); ?>">
			<td>
			  <input type="checkbox" name="rating_chk[]" class="filled-in rating_chk" id="rating_chk_<?php echo $skillsets[$i]->id; ?>" value="<?php echo $skillsets[$i]->id; ?>"  onclick="return false;" <?php if( is_array($user_skill) && in_array($skillsets[$i]->id,$user_skill)){ echo "checked";}?> />			  
			  <label for="rating_chk_<?php echo $skillsets[$i]->id; ?>"><?php echo $skillsets[$i]->skill; ?></label>
			</td>
			<td>
				<div class="input-field s-">
					<select name="rates_to_role_<?php echo $skillsets[$i]->id; ?>" id="rates_to_role_<?php echo $skillsets[$i]->id; ?>" <?php if(!in_array($skillsets[$i]->id,$user_skill)){ ?> disabled <?php } ?>>		  
					  <option value="">Select</option>
					  <?php 					  
					  for($k=1;$k<=10;$k++){ ?>
					  <?php if(in_array($skillsets[$i]->id,$user_skill)){ ?>
					  <option value="<?php echo $k; ?>" <?php if($k==$rates_to_role_combine[$skillsets[$i]->id]){ echo "selected";}?>><?php echo $k; ?></option>
					  <?php }else{ ?>
					  <option value="<?php echo $k; ?>"><?php echo $k; ?></option>
					  <?php } ?>
					  
					  <?php } ?>
					</select>
				</div>
			</td>
			<td>
				<div class="input-field s-">
					<select name="no_of_projects_<?php echo $skillsets[$i]->id; ?>" id="no_of_projects_<?php echo $skillsets[$i]->id; ?>"  <?php if(!in_array($skillsets[$i]->id,$user_skill)){ ?> disabled <?php } ?>>		  
					  <option value="">Select</option>
					  <?php 
					  for($k=1;$k<=10;$k++){ ?>
					  <?php if(in_array($skillsets[$i]->id,$user_skill)){ ?>
					  <option value="<?php echo $k; ?>" <?php if($k==$no_of_projects_combine[$skillsets[$i]->id]){ echo "selected";}?>><?php echo $k; ?></option>	
					  <?php }else{ ?>
					  <option value="<?php echo $k; ?>"><?php echo $k; ?></option>	
					  <?php } ?>
					  <?php } ?>									  
					  <option value="11" <?php if(isset($no_of_projects_combine[$skillsets[$i]->id]) && '11'==$no_of_projects_combine[$skillsets[$i]->id]){ echo "selected";}?>>More than 10</option>
					</select>
				</div>
			</td>
		  </tr>
		<?php }} ?>	
		</tbody>
									</table>			  
                                </div>
                            </div>
                        </div>
                        <div class="save-button center-align"><button type="submit" class="btn btn-large">Save all Changes</button></div>
                    </div>
                </div>
           	</div>
      	</div>
		</div>
		</form>			
	<?php } 
	}
	?> 	
<?php
$this->load->view('vwFooter');
?>
<script>
		function get_states(select_id,country_id){
			var div_id = select_id.split("_");
			$.ajax({				
				url:"<?php echo base_url('states/get_countrywise_states');?>",
				type:"post",
				data:{
					country_id:country_id,
					div_id:div_id[2]
				},
				success:function(data){
					$("#state_"+div_id[2]).html('');
					$("#state_"+div_id[2]).html(data);					
					$('#state_name_'+div_id[2]).material_select();			
				}
			});
		}
		function get_cities(select_id,state_id){
			var div_id = select_id.split("_");
			$.ajax({				
				url:"<?php echo base_url('cities/get_statewise_cities');?>",
				type:"post",
				data:{
					state_id:state_id,
					div_id:div_id[2]
				},
				success:function(data){
					$("#city_"+div_id[2]).html('');
					$("#city_"+div_id[2]).html(data);					
					$('#city_name_'+div_id[2]).material_select();			
				}
			});
		}
	</script>
	<script type="text/javascript">
		$('#roles_of_company').select2({
		  placeholder: 'Select an option',
		  width: '325px' // need to override the changed default
		});
		var valArr = $("#hidden_roles").val();
			
		$(document).ready(function() {
			var previous;		
			$("#roles_of_company").change(function () {
				$(".rating_chk").prop('checked', false);
				  
				for(var k=0;k<$(this).val().length;k++){
					$("#rating_chk_"+$(this).val()[k]).prop("checked",true);
					$("#rates_to_role_"+$(this).val()[k]).prop('disabled', false);
					$("#no_of_projects_"+$(this).val()[k]).prop('disabled', false);
					$("#rates_to_role_"+$(this).val()[k]).prop('required',true);
					$("#no_of_projects_"+$(this).val()[k]).prop('required',true);
					$("#rates_to_role_"+$(this).val()[k]).material_select();
					$("#no_of_projects_"+$(this).val()[k]).material_select();
				}
			});
			
			$('#roles_of_company').on('select2:select', function (e) {
				var data = e.params.data;
				console.log(data);
			});
			$('#roles_of_company').on('select2:unselect', function (e) {
				var data = e.params.data;
				role_id=data.id;
				$.ajax({				
					url:"<?php echo base_url('users/delete_roles_of_company');?>",
					type:"post",
					data:{
						role_id:role_id
					},
					success:function(data){
					$("#rates_to_role_"+role_id+" option:selected").prop("selected", false);
					$("#no_of_projects_"+role_id+" option:selected").prop("selected", false);
					$("#rates_to_role_"+role_id).prop('required',false);
					$("#no_of_projects_"+role_id).prop('required',false);
					$("#rates_to_role_"+role_id).material_select();
					$("#no_of_projects_"+role_id).material_select();
					}
				});
			});
		});
	</script>
	<script>
		var location_template = $('#locationRow_1').clone();
		$('#addMore').click(function () {
			
			var rowId = $('.locationRow').length + 1;
			if(rowId<=5){
			var klon = location_template.clone();          
			klon.attr('id', 'locationRow_' + rowId)
				.insertAfter($('.locationRow').last());
			
			$('#locationRow_'+rowId+' #country_name_1').attr('id','country_name_'+rowId);
			$('#locationRow_'+rowId+' #state_name_1').attr('id','state_name_'+rowId);
			$('#locationRow_'+rowId+' #city_name_1').attr('id','city_name_'+rowId);
			$('#locationRow_'+rowId+' #address_1').attr('id','address_'+rowId);		
			$('#locationRow_'+rowId+' #landmark_1').attr('id','landmark_'+rowId);
			$('#locationRow_'+rowId+' #extra_emailid_1').attr('id','extra_emailid_'+rowId);
			$('#locationRow_'+rowId+' #extra_phone_1').attr('id','extra_phone_'+rowId);
			$('#locationRow_'+rowId+' #as_head_office_1').attr('id','as_head_office_'+rowId);
			$('#locationRow_'+rowId+' #lbl_as_head_office_1').attr('id','lbl_as_head_office_'+rowId);
			
			$('#locationRow_'+rowId+' #address_id_1').attr('id','address_id_'+rowId);			
			
			
			$('#locationRow_'+rowId+' #state_1').attr('id','state_'+rowId);
			$('#locationRow_'+rowId+' #city_1').attr('id','city_'+rowId);
			
			$("#country_name_"+rowId+" option:selected").removeAttr("selected");
			$("#country_name_"+rowId).material_select();
			$('#state_name_'+rowId).empty();
			$('#state_name_'+rowId).append(new Option("Select State", ""));
			$("#state_name_"+rowId).material_select();
			$('#city_name_'+rowId).empty();
			$('#city_name_'+rowId).append(new Option("Select City", ""));
			$("#city_name_"+rowId).material_select();
			$("#landmark_"+rowId).val("");
			$("#address_"+rowId).val("");
			$("#extra_emailid_"+rowId).val("");
			$("#extra_phone_"+rowId).val("");
			$("#address_id_"+rowId).val("");
			$("#lbl_as_head_office_"+rowId).attr('for','as_head_office_'+rowId);
			$("#as_head_office_"+rowId).attr('value',rowId);
			$("#as_head_office_"+rowId).attr('checked', false);
			
			//var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Remove</button></div></div><div id="field">';
			}else{
				alert("Oops...Only 5 Address can added!!!!");
			}
		});
	</script>
	<script>
		var email_template = $('#emailRow_1').clone();
		$('#addMoreEmail').click(function () {
			var rowId = $('.emailRow').length + 1;
			var klon = email_template.clone();          
			klon.attr('id', 'emailRow_' + rowId)
				.insertAfter($('.emailRow').last())
				.find('input,select,textarea,div')
				.each(function () {
					$(this).attr('id', $(this).attr('id').replace(/_(\d*)$/, "_"+rowId));
				});  
			$("#email_"+rowId).val("");
			$("#recipient_of_mail_"+rowId).val("");			
		});
	</script>
	<script>
		var phone_template = $('#phoneRow_1').clone();
		$('#addMorePhone').click(function () {
			var rowId = $('.phoneRow').length + 1;
			var klon = phone_template.clone();          
			klon.attr('id', 'phoneRow_' + rowId)
				.insertAfter($('.phoneRow').last())
				.find('input,select,textarea,div')
				.each(function () {
					$(this).attr('id', $(this).attr('id').replace(/_(\d*)$/, "_"+rowId));
				});  
			$("#phone_"+rowId).val("");
			$("#recipient_of_phone_"+rowId).val("");			
		});
	</script>
	<script>
		var member_template = $('#memberRow_1').clone();
		$('#addMoreMember').click(function () {
			
			var rowId = $('.memberRow').length + 1;
			if(rowId>3){
				alert("Oops...Only 3 members can added!!!!");
			}else{
				var klon = member_template.clone();  
				klon.attr('id', 'memberRow_' + rowId)
					.insertAfter($('.memberRow').last())
					.find('input,select,textarea,div');
					  
				$('#memberRow_'+rowId+' #member_image_1').attr('id','member_image_'+rowId);
				$('#memberRow_'+rowId+' #member_description_1').attr('id','member_description_'+rowId);
				$('#memberRow_'+rowId+' #member_name_1').attr('id','member_name_'+rowId);
				$('#memberRow_'+rowId+' #member_designation_1').attr('id','member_designation_'+rowId);
				$('#memberRow_'+rowId+' #member_id_1').attr('id','member_id_'+rowId);
				$('#memberRow_'+rowId+' #logo-box_1').attr('id','logo-box_'+rowId);
				$("#member_image_"+rowId).val("");
				$("#member_description_"+rowId).val("");
				$("#member_name_"+rowId).val("");				
				$("#member_designation_"+rowId).val("");				
				$("#member_id_"+rowId).val("");
				$("#logo-box_"+rowId).html('<img src="<?php echo base_url('images/members/default-member.jpg');?>" alt="">');
			}
		});
	</script>
	<script>
		function readURL(input) {
			var id = input.id.replace('member_image_',''); 
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#member_photo_'+id).attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		$(".member_photo").change(function(){				
			readURL(this);
		});
		
		$("#userfile").change(function(){
			var input = this;
			if (input.files && input.files[0]) {				
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#company_logo').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		});
	</script>
	<script>
		var portfolio_template = $('#portfolioRow_1').clone();
		$('#addMorePortfolio').click(function () {
			var rowId = $('.portfolioRow').length + 1;
			if(rowId>3){
				alert("Oops...Only 3 Portfolio can added!!!!");
			}else{
			var klon = portfolio_template.clone();          
			klon.attr('id', 'portfolioRow_' + rowId)
				.insertAfter($('.portfolioRow').last())
				.find('input,select,textarea,div');
			$('#portfolioRow_'+rowId+' #portfolio_id_1').attr('id','portfolio_id_'+rowId);
			$('#portfolioRow_'+rowId+' #portfolio_url_1').attr('id','portfolio_url_'+rowId);
			$('#portfolioRow_'+rowId+' #portfolio_description_1').attr('id','portfolio_description_'+rowId);
			$('#portfolioRow_'+rowId+' #portfolio_features_').attr('id','portfolio_features_'+rowId);
			$("#portfolio_id_"+rowId).val("");
			$("#portfolio_url_"+rowId).val("");
			$("#portfolio_description_"+rowId).val("");
			$("#portfolio_features_"+rowId).val("");
			}
		});
	</script>
