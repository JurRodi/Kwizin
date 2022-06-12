<?php 

    include_once(__DIR__. "/bootstrap.php");
    // Security::onlyLoggedInUsers();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwizin</title>
    <link rel="stylesheet" href="styling/style.css">
</head>
<body>

    <div class="welcome itsMe">
        <div class="IM-header">
            <img class="welcome-logo" src="images/Kwizin_logo.png" alt="Kwizin-logo">

            <p id="IM1" class="IM-text">Om gebruik te maken van KWIZIN zal u zich moeten aanmelden met Itsme.</p>
            <p id="IM2" class="IM-text">Verificatie gelukt!</p>
        </div>

        <img id="IM-img1" class="IM-img" src="images/itsMe.svg" alt="itsMe-logo">
        <img id="IM-img2" class="IM-img" src="images/verified.svg" alt="itsMe-logo">

        <input type="submit" value="Aanmelden Itsme" id="IM-btn1" class="button form-button">
        <a href="preferences.php" id="IM-btn2"><input type="submit" value="Volgende" class="button form-button"></a>
    </div>

    <script src="scripts/itsMe.js"></script>
</body>
</html>
