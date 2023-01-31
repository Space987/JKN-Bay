<?php

$q = $_REQUEST["q"];


$out = substr(strstr($q, 'J'), strlen('J'));;

$test = strstr($q, ' J', true);

$out++;

echo "

<a id ='myRatingSeller $test'> $out </a>
";

?>