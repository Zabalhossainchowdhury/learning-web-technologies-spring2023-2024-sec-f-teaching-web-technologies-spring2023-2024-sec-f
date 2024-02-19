<?php
function arraysearch($arra1, $search)
{
reset($arra1);
while (list ($key, $val) = each ($arra1)) 
{
if (preg_match ("/$search/i", $val)) 
{
   echo $search." has found in ".$key."\n";
} 
else 
{
    echo $search." has not found in ".$key."\n";
}
}
}
$exercises = array("part1"=>"Social Science", "part2"=>"Science ", "part3"=>" Math");
arraysearch($exercises, "Math");
?>