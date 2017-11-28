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
        <div class="panel-heading">User Details <span style='float:right; margin-top: -7px;'><a class="btn btn-info" href="<?php echo base_url('admin/users/');?>">Back</a></span></div>
		<?php //echo "<pre>";print_r($users);?>
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
			  <td><?php echo $user->is_company_individual; ?></td>
            </tr>
            <tr>
              <td>Name of company/individual</td>
			  <td><?php echo $user->company_name; ?></td>
            </tr>
            <tr>
              <td>Country</td>
			  <td><?php echo $user->country_name; ?></td>
            </tr>
            <tr>
              <td>State</td>
			  <td><?php echo $user->state_name; ?></td>
            </tr>
            <tr>
              <td>City</td>
			  <td><?php echo $user->city_name; ?></td>
            </tr>
            <tr>
              <td>Landmark</td>
			  <td><?php echo $user->landmark; ?></td>
            </tr>
            <tr>
              <td>Address</td>
			  <td><?php echo $user->address; ?></td>
            </tr>
            <tr>
              <td>Email</td>
			  <td><?php echo $user->email; ?></td>
            </tr>
            <tr>
              <td>Phone</td>
			  <td><?php echo $user->phone; ?></td>
            </tr>
            <tr>
              <td>Years of experience</td>
			  <td><?php echo $user->years_of_experience; ?></td>
            </tr>
            <tr>
              <td>Turn Over</td>
			  <td><?php echo $user->turn_over; ?></td>
            </tr>
            <tr>
              <td>Website</td>
			  <td><?php echo $user->website; ?></td>
            </tr>
            <tr>
              <td>About company/individual</td>
			  <td><?php echo $user->about_company; ?></td>
            </tr>
            <tr>
              <td>No of employee</td>
			  <td><?php echo $user->no_of_employee; ?></td>
            </tr>
            <tr>
              <td>Portfolio</td>
			  <td><?php echo $user->portfolio; ?></td>
            </tr>
            <tr>
              <td>Roles of company/individual</td>
			  <td><?php echo $user->roles_of_company; ?></td>
            </tr>
            <tr>
              <td>Latitude</td>
			  <td><?php echo $user->latitude; ?></td>
            </tr>
            <tr>
              <td>Longitude</td>
			  <td><?php echo $user->longitude; ?></td>
            </tr>
            <tr>
              <td>Status</td>
			  <td><?php echo $user->status; ?></td>
            </tr>
            <tr>
              <td>Registration Date</td>
			  <td><?php echo date('d-m-Y h:i:sa', strtotime($user->registration_date)); ?></td>
            </tr>
			<?php } } ?>				
          </tbody>
        </table>
      </div>
 
    </div><!-- /.container -->
     <hr>
<?php
$this->load->view('admin/vwFooter');
?>