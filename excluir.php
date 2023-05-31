<?php
include 'config.php';
myserver::deletePizza($_POST['id']);
header('location: index.php');
