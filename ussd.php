<?php

include 'includes/config.php';

// Reads the variables sent via POST from our gateway
$sessionId = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];
if ($text == "") {
    // This is the first request. Note how we start the response with CON
    $response = "CON Set the purpose for your contribution \n";
    $response .= "1. Tithing \n";
    $response .= "2. Church Contribution \n";
    $response .= "3. Bursary \n";
    $response .= "4. Church Construction \n";
    $response .= "5. Women Empowerment Group \n";
} else if ($text == "1") {
    // Business logic for first level response

    $conn = db_operations::getDBCONN();

    $sql = "UPDATE mpesa SET purpose= 'TITHING' WHERE phone_number=? ";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(1, $phoneNumber);

    if ($stmt->execute())
        $response = "END You've successfully set TITHING for your contribution '.$phoneNumber.'\n";

    else {
        $response = "END Error while updating your purpose. \n Try again";
        // code...
    }
//   $response .= "1. Account number \n";
//   $response .= "2. Account balance";

}
//  else if($text == "2") {
//   // Business logic for first level response
//   // This is a terminal request. Note how we start the response with END
//   $response = "END Your phone number is $phoneNumber";
//  }
//  else if($text == "1*1") {
//   // This is a second level response where the user selected 1 in the first instance
//   $accountNumber  = "ACC1001";
//   // This is a terminal request. Note how we start the response with END
//   $response = "END Your account number is $accountNumber";
//  }

//  else if ( $text == "1*2" ) {

//      // This is a second level response where the user selected 1 in the first instance
//      $balance  = "KES 10,000";
//      // This is a terminal request. Note how we start the response with END
//      $response = "END Your balance is $balance";
// }
// Print the response onto the page so that our gateway can read it
header('Content-type: text/plain');
echo $response;
