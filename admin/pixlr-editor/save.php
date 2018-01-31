<?php
//get's and saves the image
$url = $_GET['image'];
$img = 'img/'.time().'.png';  ;
file_put_contents($img, file_get_contents($url));