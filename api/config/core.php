<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$home_url="http://217.71.129.139:4565/";

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$records_per_pare = 5;

$from_record_num = ($records_per_page * $page) - $records_per_page;
?>
