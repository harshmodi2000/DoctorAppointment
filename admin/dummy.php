<?php
include_once "../includes/autoloader.include.php";
$ap=new Appointment();
$array=$ap->getBookedSlot('1',date('Y-m-d'));
print_r($array);