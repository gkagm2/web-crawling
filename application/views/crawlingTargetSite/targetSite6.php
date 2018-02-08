<?php

$fileName = "1.jpeg";
$path = FCPATH . "application\\views\\Python\\$fileName";
//$path = ".\\" . $fileName;
//$path = realpath(__FILE__);
//$path = __DIR__ ."\\" .$fileName;

echo $path;
echo "<br>";
?>

<img src="<?=$path?>" width="300" height="400" alt="<?=$fileName?>">
