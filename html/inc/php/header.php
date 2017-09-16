<?php 
    session_start();
    require_once("/var/www/html/inc/config/config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="/inc/js/siteNavigation.js"></script>
        <link rel="stylesheet" type="text/css" href="/inc/css/styleServiceSimple.css">
    </head>
    <body>
        <button type="button" onclick="goTo('index.php');">Sākums</button>
        <button type="button" onclick="goTo('app/main/rma/service.php');">Serviss</button>
        <button type="button" onclick="goTo('app/main/manage/main.php');">Pārvaldīt DB</button><br>
        <br>