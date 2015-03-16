<?php
require_once 'vendor/autoload.php';
use jDateTime\jDateTime;

$date = new jDateTime('-3 days');

echo $date;