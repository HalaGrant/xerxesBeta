<?php 
require_once 'reviews.php';

$title= str_replace(" ", "%20", $_GET["t"]);

echo getReview($title);

?>