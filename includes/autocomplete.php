<?php
/**
 * Created by PhpStorm.
 * User: lenik
 * Date: 2/18/2016
 * Time: 11:07 AM
 */

include_once 'config.php';

//get the input
$searchKeyWord = $_GET[FIRSTNAME];

$result = db_operations::getSearchedData($searchKeyWord);

if ($result) {
    while ($row =$result->fetch()){
        echo "<option value='".$row[FIRSTNAME]."'>";
    }
}
