<?php
$this->load->view('vwHeader');
?>
<?php include('vwHomeSearchBox.php'); ?>
        <div class="map ">
            <div id="map" style="width: 100%;height: 220px;"></div>
        </div>
<?php include('vwSkilledDedicated.php'); ?>
<?php include('vwHireExpert.php'); ?>


  
<?php include('vwTopCompanies.php'); ?>
<?php
$this->load->view('vwFooter');
?>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>front-end/home.js"></script>

<script>
    
    $(document).ready(function () {
        //Autocomplete for country
        $(function () {
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url('search/country_name') ?>',
                success: function (response) {
                    response = JSON.parse(response);
                    var countryArray = response;
                    var dataCountry = {};
                    for (var i = 0; i < countryArray.length; i++) {
                        dataCountry[countryArray[i].name] = countryArray[i].flag; //countryArray[i].flag or null
                    }
                    $('#country').autocomplete({
                        data: dataCountry,
                        limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
                    });
                }
            });
        });
    });

</script>
<script>
    $(document).ready(function () {
        //Autocomplete for skillset
        $(function () {



        });
    });

</script>
<script>

    Object.size = function (obj) {
        var size = 0, key;
        for (key in obj) {
            if (obj.hasOwnProperty(key))
                size++;
        }
        return size;
    };


</script>
<script>
    $(function () {
        siteObjJs.frontend.homeJs.init();
    });
</script>
<script>
  
    provider_utilizer_list = <?php echo $provider_utilizer_list; ?>
</script>