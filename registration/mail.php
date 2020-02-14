<?php
$to = "harshal5618@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: encore@ietlucknow.ac.in" . "\r\n";

mail($to,$subject,$txt,$headers);
?>