<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */

session_start();
session_destroy();
header("location:login.php");

?>