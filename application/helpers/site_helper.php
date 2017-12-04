<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
if(!function_exists('pre'))
{
  function pre($value)
  {
    echo '<pre>';  
   print_r($value);
   echo '</pre>';
   die;
  }
}

?>
