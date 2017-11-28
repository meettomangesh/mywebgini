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
  <h1><small>Countries</small></h1>
</div>
    <div class="container">
 
 <div class="panel panel-default" >
        <!-- Default panel contents -->
        <div class="panel-heading">Countries List <span style='float:right; margin-top: -7px;'></span></div>
		<?php //echo "<pre>";print_r($users);?>
        <!-- Table -->
        <table  id="example"  class="order-column table table-striped table-hover" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
			  <th>Sortname</th>
              <th>PhoneCode</th>
              <!--<th>Action</th>-->
            </tr>
          </thead>
          <tbody>
			<?php 
			if(isset($countries) && !empty($countries)){
				$i=1;
			foreach($countries as $country){ ?>
            <tr>
              <td><?php echo $i++;?></td>
              <td><?php echo $country->name; ?></td>
			  <td><?php echo $country->sortname; ?></td>
              <td><?php echo $country->phonecode; ?></td>
              <!--<td>
                  <a href='<?php echo base_url('admin/Countries/view_Countries/'.$country->id);?>' title='View'> <i class="fam-zoom"></i></a>
                 <a href='#' title='Edit'><i class="fam-user-edit"></i></a>
                 <a href='#' title='Block'><i class="fam-user-gray"></i></a>
                 <a href='#' title='Delete'><i class="fam-user-delete"></i></a>
              </td>-->
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