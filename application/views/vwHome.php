<?php
$this->load->view('vwHeader');
?>
<?php include('vwHomeSearchBox.php'); ?>
<?php include('vwSkilledDedicated.php'); ?>
<?php include('vwHireExpert.php'); ?>
<?php include('vwTopCompanies.php'); ?>
<?php
$this->load->view('vwFooter');
?>

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
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('search/getSkills') ?>',
                success: function (response) {
                    response = JSON.parse(response);
                    var skillArray = response;
                    var dataSkill = [{}];
                    var dataMain = [{}];
                    /*for (var i = 0; i < skillArray.length; i++) {
                        dataSkill[skillArray[i].skill] = skillArray[i].flag; //skillArray[i].flag or null
                    }*/
                    response.forEach(function(element,index) {
                    dataSkill[element.skill] = ''; //skillArray[i].flag or null
               
                    });
               
                    $('.chips-autocomplete').material_chip({
                        autocompleteOptions: {
                            data: dataSkill,
                            limit: Infinity,
                            minLength: 1
                        }
                    });
                }
            });

             
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
    function Show() {
        var data = $('.chips-autocomplete').material_chip('data');
        var str = '';
        for (var i = 0; i < Object.size(data); i++) {
            if (i == 0) {
                str += data[i].tag;
            } else {
                str += "," + data[i].tag;
            }
        }
        $("#skills").val(str);
        $("#search_form").submit();
    }

</script>
