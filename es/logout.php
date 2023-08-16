<?php

// Include head
include 'includes/head.php';

// Have to do this first
session_start();

// End Session
session_destroy();

// Redirect to Campaigns
header('Location: login.php');
exit();

?>