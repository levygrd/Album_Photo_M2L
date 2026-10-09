<?php
require 'includes/connexion.php';
session_destroy();
header('Location: index.php');
exit;
