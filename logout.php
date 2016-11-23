<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 17/10/2016
 * Time: 21:10
 */
session_start();
session_destroy();
header("Location: index.php");