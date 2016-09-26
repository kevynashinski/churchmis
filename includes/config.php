<?php
    /**
     * Created by PhpStorm.
     * User: lennik
     * Date: 1/25/2016
     * Time: 3:03 PM
     */

    include_once 'db_operations.php';

    define('HOST', "localhost");
define('USER', 'kevynashinski');
    define('PASS', 'elegant');
    define('DATABASE', "report");

    define('ID', 'id');
    define('FULL_NAME', 'full_name');
    define('PHONE_NUMBER', 'phone_number');
    define('GENDER', 'gender');

    define('PURPOSE', 'purpose');
    define('CASH', 'cash');
    define('CHEQUE', 'cheque');
    define('FOREX', 'forex');
    define('RECEIPT_STATUS', 'receipt_status');
    define('PAYMENT_DATE', 'payment_date');

    define('USERNAME', 'username');
define('REGISTERED_DATE', 'registered_date');
    define('PURPOSE_NUMBER', 'purposesNumber');
    define('SURNAME','surname');
    define('OTHER_NAME','other_name');
    define('ID_NUMBER','id_number');
    define('EMAIL','email');
    define('PASSWORD','password');
    define('ROLE','role');

define("MPESA_CODE", "mpesa_code");
define("DATE", "date");
define("TIME", "time");
define("AMOUNT", "amount");

define('EVENT_NAME', 'event_name');
define('VENUE', 'venue');
define('NEWS_DETAILS', 'news_details');
define('EVENT_START_DATE', 'start_date');
define('EVENT_END_DATE', 'end_date');

    try {
        $DB_CONN = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE, USER, PASS);
    } catch (PDOException $e) {
        echo 'Error Occurred during connection ' . $e->getMessage();
    }

$connection = new db_operations($DB_CONN);
