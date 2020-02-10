<?php

//Kõik vajalikud parameetrid süsteemi töötamiseks

    // Laeme vajalikud konstandid
    require_once 'config/constants.php';

    // Session
    session_start();

    // Call for helper
    require_once 'helpers/url_helper.php';

    // Laeme vajalikud raamatukogud - automaatselt
    spl_autoload_register(function ($className) {
        include 'libraries/' . $className . '.php';
    });
    /*
     * Sama asi mis üleval
    require_once 'libraries/Core.php';
    require_once 'libraries/Controller.php';
     */

