<?php
require '../core/bootstrap.php';

//Write an empty array to the session
$_SESSION=[];

//Destroy the session file for this session
session_destroy();

header('LOCATION: ../public');