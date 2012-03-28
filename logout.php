<?php
session_start();
require_once 'lib/authentication.php';

unset($_SESSION["userData"]);
setcookie('fbs_'.$facebook->getAppId(), '', time()-100, '/', 'http://sketchv.com');
session_destroy();

header('Location: /');

?>
