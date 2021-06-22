<?php
$cookie_name = "cookie";
setcookie($cookie_name, $cookie_value, time() - (3600));
echo "You have been logged out.<br>";
echo "<a href='test_post2.html'>Return to main page</a>";

?>