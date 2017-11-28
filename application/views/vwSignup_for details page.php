<?php
$this->load->view('vwHeader');
?>
<div class="title-banner">
        	<div class="container">
            	<h3>What are you!</h3>
                <ul class="tabs">
                    <li class="tab"><a class="active" href="#signup-company">Company</a></li>
                    <li class="tab"><a href="#test2">Individual</a></li>
                  </ul>
            </div>
        </div>
        <div class="signup-box">
        	<div class="container">
               	<div id="signup-company">
                    <div class="top-head">
                        <h3><i class="fa fa-briefcase" aria-hidden="true"></i> Add Company Profile</h3>
                        <p>Hey, it's easier than it looks. Take a deeep breath and complete the fields below. You'll have a beautiful page!</p>
                    </div>
                    <div class="sign-form">
                        <div class="row">
                            <div class="col s6">
                                <div class="row">
                                    <div class="input-field col s12">
                                      <input id="company_name" name="company_name" type="text" class="winp nr">
                                      <label for="company_name">Name of the Company</label>
                                    </div>
                                    <div class="input-field col s12">
                                      <input id="website" name="website" type="text" class="winp nr">
                                      <label for="website">Website</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="no_of_employee" name="no_of_employee" type="text" class="winp nr">
										<label for="no_of_employee">No of employee</label>
                                    </div>
                                    <div class="input-field s-winp col s6">
                                        <input id="years_of_experience" name="years_of_experience" type="text" class="winp nr">
										<label for="years_of_experience">Year Established</label>
									</div>
                                    <div class="col s4">
                                        <div class="up-logo">
                                            <label>Company Logo</label>
                                            <div class="logo-box"></div>
                                            <a href="" class="blue-link"><i class="fa fa-upload" aria-hidden="true"></i> Upload Company Logo</a>
                                        </div>
                                    </div>
                                    <div class="col s8">
                                        <div class="input-field ab-comp">
                                            <textarea id="about_company" name="about_company" class="materialize-textarea winp" data-length="250"></textarea>
                                            <label for="textarea1">Write about your company</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s6">
                                <div class="add-box">
                                    <div class="row">
                                        <div class="input-field col s12">
                                          <input id="first_name2" type="text" class="winp nr">
                                          <label for="first_name2">Address</label>
                                        </div>
                                        <div class="input-field s-winp col s6">
                                            <select>
                                              <option value="" disabled selected>Country</option>
                                              <option value="1">India</option>
                                              <option value="2">India</option>
                                              <option value="3">India</option>
                                            </select>
                                        </div>
                                        <div class="input-field s-winp col s6">
                                            <select>
                                              <option value="" disabled selected>City</option>
                                              <option value="1">Mumbai</option>
                                              <option value="2">Mumbai</option>
                                              <option value="3">Mumbai</option>
                                            </select>
                                        </div>
                                        <div class="input-field col s12">
                                            <input id="first_name2" type="text" class="winp nr">
                                            <label for="first_name2">Landmark</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="first_name2" type="text" class="winp nr">
                                            <label for="first_name2">Email</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="first_name2" type="text" class="winp nr">
                                            <label for="first_name2">Phone</label>
                                        </div>
                                    </div>
                                    <div class="mt10">
                                        <div class="right">
                                          <input type="checkbox" class="filled-in" id="filled-in-box" />
                                          <label for="filled-in-box">Mark as Headoffice</label>
                                        </div>
                                        <div class="edit-del"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a><a href="#"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</a><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></div>
                                    </div>
                                </div>
                                <div class="add-moread right-align mt15">
                                    <button type="button" class="btn bts btn-grey"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add More Address</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 mt20">
                                <div class="shead mb5"><span><i class="fa fa-user" aria-hidden="true"></i> Key Members </span></div>
                                <div class="row key-mem">
                                    <div class="col s4">
                                        <div class="up-logo">
                                            <label>Photo</label>
                                            <div class="logo-box"></div>
                                            <a href="" class="blue-link"><i class="fa fa-upload" aria-hidden="true"></i> Upload Photo</a>
                                        </div>
                                    </div>
                                    <div class="col s8">
                                        <div class="input-field">
                                          <input id="first_name2" type="text" class="winp nr">
                                          <label for="first_name2">Name</label>
                                        </div>
                                        <div class="input-field">
                                          <input id="first_name2" type="text" class="winp nr">
                                          <label for="first_name2">Designation</label>
                                        </div>
                                        <div class="input-field ab-brif">
                                            <textarea id="textarea1" class="materialize-textarea winp" data-length="100"></textarea>
                                            <label for="textarea1">Write about your company</label>
                                        </div>
                                        <div class="add-moread right-align mt15">
                                            <button type="button" class="btn bts btn-grey"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add More Member</button>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <div class="col s6 mt20">
                                <div class="shead mb5"><span><i class="fa fa-file-image-o" aria-hidden="true"></i> Portfolio</span></div>
                                <div class="row key-portfolio">
                                    <div class="col s12">
                                        <div class="input-field">
                                          <input id="first_name2" type="text" class="winp nr">
                                          <label for="first_name2">Project URL</label>
                                        </div>
                                        <div class="input-field">
                                          <input id="first_name2" type="text" class="winp nr">
                                          <label for="first_name2">Features / Functions You Deployed  </label>
                                        </div>
                                        <div class="input-field ab-brif">
                                            <textarea id="textarea1" class="materialize-textarea winp" data-length="100"></textarea>
                                            <label for="textarea1">Project description</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-moread right-align mt15">
                                    <button type="button" class="btn bts btn-grey"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add More Projects</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 mt20">
                                <div class="shead"><span><i class="fa fa-cog" aria-hidden="true"></i> Services Offered  </span></div>
                                <div class="service-list">
                                    <ul class="row">
                                        <li class="col s6"><a href="javascript:void(0)" class="active">Website Development</a></li>
                                        <li class="col s6"><a href="javascript:void(0)">Website Marketing</a></li>
                                        <li class="col s6"><a href="javascript:void(0)">Website Funding / Investors</a></li>
                                        <li class="col s6"><a href="javascript:void(0)">Website Development</a></li>
                                        <li class="col s6"><a href="javascript:void(0)">Website Marketing</a></li>
                                        <li class="col s6"><a href="javascript:void(0)" class="active">Website Funding / Investors</a></li>
                                        <li class="col s6"><a href="javascript:void(0)">Website Development</a></li>
                                        <li class="col s6"><a href="javascript:void(0)">Website Marketing</a></li>
                                        <li class="col s6"><a href="javascript:void(0)">Website Funding / Investors</a></li>
                                        <li class="col s6"><a href="javascript:void(0)">Website Development</a></li>
                                        <li class="col s6"><a href="javascript:void(0)">Website Marketing</a></li>
                                        <li class="col s6"><a href="javascript:void(0)">Website Funding / Investors</a></li>
                                        <li class="col s6"><a href="javascript:void(0)" class="active">Website Development</a></li>
                                        <li class="col s6"><a href="javascript:void(0)">Website Marketing</a></li>
                                        <li class="col s6"><a href="javascript:void(0)">Website Funding / Investors</a></li>
                                        <li class="col s6"><a href="javascript:void(0)">Website Development</a></li>
                                        <li class="col s6"><a href="javascript:void(0)">Website Marketing</a></li>
                                        <li class="col s6"><a href="javascript:void(0)" class="active">Website Funding / Investors</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col s6 mt20">
                                <div class="shead"><span><i class="fa fa-globe" aria-hidden="true"></i> Website Development </span></div>
                                <div class="website-pro1">
                                    <div class="row">
                                        <div class="col s6">
                                            <div class="checkbox">
                                              <input type="checkbox" class="filled-in" id="w1" />
                                              <label for="w1">Static Website Developers</label>
                                            </div>
                                        </div>
                                        <div class="col s6">
                                            <div class="checkbox">
                                              <input type="checkbox" class="filled-in" id="w2" />
                                              <label for="w2">Dynamic Website Developers</label>
                                            </div>
                                        </div>
                                        <div class="col s6">
                                            <div class="checkbox">
                                              <input type="checkbox" class="filled-in" id="w3" />
                                              <label for="w3">Portal Developers</label>
                                            </div>
                                        </div>
                                        <div class="col s6">
                                            <div class="checkbox">
                                              <input type="checkbox" class="filled-in" id="w4" />
                                              <label for="w4">Static Website Developers</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="website-pro2">
                                    <table class="responsive-table">
                                        <thead>
                                          <tr>
                                              <th width="44%">Select Languages</th>
                                              <th width="28%">Competency Level Out of 10</th>
                                              <th width="28%">Number of Projects Executed</th>
                                          </tr>
                                        </thead>                            
                                        <tbody>
                                          <tr>
                                            <td>
                                              <input type="checkbox" class="filled-in" id="l1" />
                                              <label for="l1">PHP developer</label>
                                            </td>
                                            <td>
                                                <div class="input-field s-winp">
                                                    <select>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-field s-winp">
                                                    <select>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <input type="checkbox" class="filled-in" id="l1" />
                                              <label for="l1">PHP developer</label>
                                            </td>
                                            <td>
                                                <div class="input-field s-winp">
                                                    <select>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-field s-winp">
                                                    <select>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <input type="checkbox" class="filled-in" id="l1" />
                                              <label for="l1">PHP developer</label>
                                            </td>
                                            <td>
                                                <div class="input-field s-winp">
                                                    <select>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-field s-winp">
                                                    <select>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <input type="checkbox" class="filled-in" id="l1" />
                                              <label for="l1">PHP developer</label>
                                            </td>
                                            <td>
                                                <div class="input-field s-winp">
                                                    <select>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-field s-winp">
                                                    <select>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <input type="checkbox" class="filled-in" id="l1" />
                                              <label for="l1">PHP developer</label>
                                            </td>
                                            <td>
                                                <div class="input-field s-winp">
                                                    <select>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-field s-winp">
                                                    <select>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <input type="checkbox" class="filled-in" id="l1" />
                                              <label for="l1">PHP developer</label>
                                            </td>
                                            <td>
                                                <div class="input-field s-winp">
                                                    <select>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-field s-winp">
                                                    <select>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <input type="checkbox" class="filled-in" id="l1" />
                                              <label for="l1">PHP developer</label>
                                            </td>
                                            <td>
                                                <div class="input-field s-winp">
                                                    <select>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-field s-winp">
                                                    <select>
                                                      <option value="1">1</option>
                                                      <option value="2">2</option>
                                                      <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
                                
                            </div>
                        </div>
                        <div class="save-button center-align"><button type="button" class="btn btn-large">Save all Changes</button></div>
                    </div>
                </div>
				<div id="test2">In Individual </div>
           	</div>
      	</div>
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