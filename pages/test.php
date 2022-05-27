<?php 
echo getcwd() . "<br>";
echo dirname(__FILE__) . "<br>";
echo basename(__FILE__) . "<br>";
$page = "/pa";
if (strpos(getcwd(), "dasboard") == true ) {
	echo "yes";
} else {
	echo "no";
}

echo time();