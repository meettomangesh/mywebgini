<?php
$this->load->view('vwHeader');
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container" style="margin-top: 50px;">
        <form class="form-inline" method="post" action="<?php echo base_url('search/skill_search');?>">
		  <div class="form-group">
			<label class="sr-only" for="skills">Search Keyword</label>
			<input type="input" class="form-control" name="skills" id="skills" placeholder="Skill" style="width:500px;">
		  </div>
		  <div class="form-group">
			<label class="sr-only" for="country">Country</label>
			<select name="country_name" id="country_name" class="form-control">
					<option value="">Select Country</option>
					<?php foreach($countries as $country){ ?>
						<option value="<?php echo $country->id;?>" ><?php echo $country->name; ?></option>
					<?php } ?>
				</select>
		  </div>
		  <button type="submit" class="btn btn-default">Search</button>
		</form>

      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
       </div>
        <div class="col-lg-4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div>
      </div>

      <hr>
<?php
$this->load->view('vwFooter');
?>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>
$(function() {
    function split( val ) {
        return val.split( /,\s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
    }
    
    $( "#skills" ).bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
            event.preventDefault();
        }
    })
    .autocomplete({
        minLength: 1,
        source: function( request, response ) {
            // delegate back to autocomplete, but extract the last term
            $.getJSON("<?php echo base_url('search/search_by_keyword');?>", { term : extractLast( request.term )},response);
        },
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
        select: function( event, ui ) {
            var terms = split( this.value );
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push( ui.item.value );
            // add placeholder to get the comma-and-space at the end
            terms.push( "" );
            this.value = terms.join( ", " );
            return false;
        }
    });
});
</script>