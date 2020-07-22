<?php
$date1=date_create("2013-01-01 06:45:40");
$date2=date_create("2013-02-10 06:45:40");
$now=date_create(date("Y-m-d H:i:s"));
$diff=date_diff($date1,$now);
//date_default_timezone_set("America/New_York");
echo "The time is " . date("Y-m-d H:i:s");// %a outputs the total number of days
echo $diff->format("Total number of days: %a.");
$os = array("Mac", "NT", "Irix", "Linux");
if (in_array("Irix", $os)) {
    echo "Got Irix";
}
if (in_array("mac", $os)) {
    echo "Got mac";
}

?>