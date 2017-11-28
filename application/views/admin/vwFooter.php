     <footer>
        <p>&copy; Company 2017. Mywebgini.com</p>
      </footer>
    </div> <!-- /container -->
  
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo HTTP_JS_PATH; ?>jquery.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>das.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>bootstrap.min.js"></script>
	<script src="<?php echo HTTP_JS_PATH; ?>jquery.dataTables.min.js"></script>
	
	<script>
		$(document).ready(function() {
			$('#example').DataTable( {
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
			} );
		} );
		$(document).ready(function() {
			$('#example1').dataTable( {
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "../../third_party/server_processing.php"
			} );
		} );
	</script>
	 
  </body>
</html>
