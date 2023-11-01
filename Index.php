<?php

require_once ('controller/homepageController.php');

require_once ('controller/session/connection.php');
require_once ('controller/session/password_forgotten.php');
require_once ('controller/session/password_change.php');
require_once ('controller/session/registration.php');
require_once ('controller/session/performance.php');

require_once ('controller/game/guess_country_flag.php');
require_once ('controller/game/guess_country_money.php');
require_once ('controller/game/guess_country_capital.php');
require_once ('controller/game/guess_country_language.php');
require_once ('controller/game/guess_country_region.php');
require_once ('controller/game/guess_country_localisation.php');
require_once ('controller/levelController.php');


if (isset($_GET['action']) && $_GET['action'] != '') {
    switch ($_GET['action']) {
        case 'connection':
            connection();
            break;
        case 'password_forgotten':
            password_forgotten();
            break;
        case 'password_change':
            password_change();
            break;
        case 'registration':
            registration();
            break;
        case 'client_performance':
            client_performance();
            break;
        case 'setting':
            setting();
            break;
        case 'country_flag': 
            country_flag();
            break;
        case 'country_money': 
            country_money();
            break;
        case 'country_capital': 
            country_capital();
            break;
        case 'country_language': 
            country_language();
            break;
        case 'country_region': 
            country_region();
            break;
        case 'country_localisation': 
            country_localisation();
            break;
        case 'level': 
            level();
            break;
        default:
            guess_country_flag();
            break;
    }
} else {
    guess_country_flag();
}

?>