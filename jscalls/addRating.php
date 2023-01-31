<?php

$q = $_REQUEST["q"];


$out = substr(strstr($q, 'R'), strlen('R'));;

$test = strstr($q, ' R', true);

$out++;

echo "

<a id ='myRating $test'> $out </a>
";

?>