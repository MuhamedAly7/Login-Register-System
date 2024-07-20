<?php

session_start();

session_unset();
session_destroy();

header('refresh:0.5; url=login.php');