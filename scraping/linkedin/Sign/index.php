<?php
/* echo mt_getrandmax(); */
/* error_reporting(E_ALL);
echo mt_rand(1000000000, 9999999999999999999); */
/* die(); */
require "init.php";
?>
<a href="<?php echo $linkedin->getAuthUrl() ?>" style="font-size: large;">Sign in with LinkedIn</a>