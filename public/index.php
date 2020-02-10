<?php
error_reporting(~E_NOTICE);
// Süsteemi jaoks vajalikud parameetrid
require_once '../app/bootstrap.php';

// Loome Core objekti raamatukogu kasutamiseks
$init = new Core();
//print_r($_SESSION);