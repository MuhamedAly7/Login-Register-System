<?php

session_start();
require_once '../Inc/connection.php';

$stat = $pdo->prepare('SELECT * FROM posts');
$stat->execute();

$_SESSION['posts'] = $stat->fetchAll();
header('refresh:0;url=../Views/index.php');