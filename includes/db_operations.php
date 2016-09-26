<?php

    /**
     * Created by PhpStorm.
     * User: lenik
     * Date: 2/16/2016
     * Time: 3:50 PM
     */
    class db_operations {
        private static $DB_CONN;

        /**
         * db_operations constructor.
         * @param PDO $connection
         */
        public function __construct($connection) {
            include_once 'config.php';
            self::$DB_CONN = $connection;
        }

        /**
         * @return PDO
         */
        public static function getDBCONN()
        {
            return self::$DB_CONN;
        }

        public static function addUserRecord($fullName, $phoneNumber, $gender, $purposes, $cash, $cheque, $forex) {
            $status = false;
            try {
                $sql = "INSERT INTO details (full_name, phone_number, gender) VALUES (?,?,?)";

                $stmt = self::$DB_CONN->prepare($sql);
                $stmt->bindParam(1, $fullName);
                $stmt->bindParam(2, $phoneNumber);
                $stmt->bindParam(3, $gender);

                $result = $stmt->execute();

                if ($result) {
                    $id = self::$DB_CONN->lastInsertId();

                    //loop through the purposes and amount while adding to the db
                    foreach ($purposes as $item => $purpose) {
                        $purposed = $purposes[$item];
                        $cashs = $cash[$item];
                        $cheques = $cheque[$item];
                        $forexs = $forex[$item];

                        $sql_amount = "INSERT INTO payments(id,purpose,cash,cheque,forex,payment_date) VALUES(?,?,?,?,?,now())";

                        $stmt = self::$DB_CONN->prepare($sql_amount);
                        $stmt->bindParam(1, $id);
                        $stmt->bindParam(2, $purposed);
                        $stmt->bindParam(3, $cashs);
                        $stmt->bindParam(4, $cheques);
                        $stmt->bindParam(5, $forexs);

                        $result = $stmt->execute();

                        if ($result) {
                            $status = true;
                        }
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $status;
        }

        public static function registerUser($id_number, $surname, $other_name, $phone_number, $gender, $email, $password) {
            try {

                $newPassword = password_hash($password, PASSWORD_DEFAULT);

                $query = "INSERT INTO users(id_number, surname, other_name, phone_number, gender, username, password) VALUES (?,?,?,?,?,?,?)";

                $stmt = self::$DB_CONN->prepare($query);
                $stmt->bindParam(1, $id_number);
                $stmt->bindParam(2, $surname);
                $stmt->bindParam(3, $other_name);
                $stmt->bindParam(4, $phone_number);
                $stmt->bindParam(5, $gender);
                $stmt->bindParam(6, $email);
                $stmt->bindParam(7, $newPassword);

                if ($stmt->execute()) {
                    return true;
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            return false;
        }

        public static function updatePhoto($image, $imgtype, $username)
        {
            try {
                $sql_profile = "UPDATE users SET photo ='$image',phototype = '$imgtype' WHERE username = '$username'";

                $stmt = self::$DB_CONN->prepare($sql_profile);
                if ($stmt->execute()) {
                return true;
                }

            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            return false;
        }


        public static function updatePassword($username, $password)
        {
            try {
                $newPassword = password_hash($password, PASSWORD_DEFAULT);

                $sql_profile = "UPDATE users SET password ='$newPassword' WHERE username = '$username'";

                $stmt = self::$DB_CONN->prepare($sql_profile);
                if ($stmt->execute()) {
                    return true;
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            return false;
        }

        public static function addEvent($event_name, $venue, $start_date, $end_date)
        {
            try {
                $sql_profile = "INSERT INTO events(event_name, start_date, end_date, venue) VALUES (?,?,?,?)";

                $stmt = self::$DB_CONN->prepare($sql_profile);
                $stmt->bindParam(1, $event_name);
                $stmt->bindParam(2, $start_date);
                $stmt->bindParam(3, $end_date);
                $stmt->bindParam(4, $venue);

                if ($stmt->execute()) {
                    return true;
                }

            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            return false;
        }

        public static function saveMpesaTransaction($mpesaCode, $fullName, $phoneNumber, $amount, $date, $time)
        {
            try {
                $sql = "INSERT INTO mpesa(mpesa_code, full_name, date, time, amount,phone_number) VALUES (?,?,?,?,?,?)";

                $stmt = self::$DB_CONN->prepare($sql);
                $stmt->bindParam(1, $mpesaCode);
                $stmt->bindParam(2, $fullName);
                $stmt->bindParam(3, $date);
                $stmt->bindParam(4, $time);
                $stmt->bindParam(5, $amount);
                $stmt->bindParam(6, $phoneNumber);

                if ($stmt->execute()) {
                    return true;
            }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            return false;
        }

        public static function getUsers(){
            try{
                $query = "select id_number,surname,other_name,gender,username,registered_date,role from users";
                $stmt=self::$DB_CONN->query($query);
                $result=$stmt->fetch();


            }catch(PDOException $e){
                echo 'Error: ' . $e->getMessage();
            }
        }

        /**
         * @param $username
         * @return $result : User Details of the user
         */
        public static function getUserByUsername($username) {
            $stmt=null;
            try{
                $query = "SELECT * FROM users WHERE username=? LIMIT 1";

                $stmt = self::$DB_CONN->prepare($query);
                $stmt->bindParam(1, $username);

                if ($stmt->execute()) {
                    return $stmt->fetch();
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            return null;
        }

        public static function verifyPassword($username, $password)
        {
            $stmt = null;
            try {
                $query = "SELECT * FROM users WHERE username=? LIMIT 1";

                $stmt = self::$DB_CONN->prepare($query);
                $stmt->bindParam(1, $username);

                if ($stmt->execute()) {
                    $row = $stmt->fetch();
                    if (password_verify($password, $row[PASSWORD])) {
                        // CREATE session
                        return true;
                    }
                }
            }catch(PDOException $e){
                echo 'Error: '.$e->getMessage();
            }
            return null;
        }

        public static function login($username, $password) {
            try {
                $query = "SELECT * FROM users WHERE username=? LIMIT 1";

                $stmt = self::$DB_CONN->prepare($query);
                $stmt->bindParam(1, $username);
                $stmt->execute();

                $row = $stmt->fetch();
                //check if the result is there
                if ($stmt->rowCount() > 0) {
                    if (password_verify($password, $row[PASSWORD])) {
                        // CREATE session
                        $_SESSION[USERNAME] = $row[USERNAME];
                        $_SESSION[ROLE]=$row[ROLE];

                        return true;
                    }
                }

            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            return false;
        }

        public static function redirect($url){
            header("Location: $url");
        }

        /**
         * Returns the page with paginated data
         * @param $query
         * @param $records_per_page
         * @return string
         */
        public static function paging($query, $records_per_page) {
            $starting_position = 0;
            if (isset($_GET["page_no"])) {
                $starting_position = ($_GET["page_no"] - 1) * $records_per_page;
            }
            $query2 = $query . " limit $starting_position,$records_per_page";
            return $query2;
        }

        public static function paginglink($query, $records_per_page) {

            $self = $_SERVER['PHP_SELF'];

            $stmt = self::$DB_CONN->prepare($query);
            $stmt->execute();

            $total_no_of_records = $stmt->rowCount();

            if ($total_no_of_records > 0) {
                ?>
                <ul class="pagination"><?php
                $total_no_of_pages = ceil($total_no_of_records / $records_per_page);
                $current_page = 1;
                if (isset($_GET["page_no"])) {
                    $current_page = $_GET["page_no"];
                }
                if ($current_page != 1) {
                    $previous = $current_page - 1;
                    echo "<li><a href='" . $self . "?page_no=1'>First</a></li>";
                    echo "<li><a href='" . $self . "?page_no=" . $previous . "'>Previous</a></li>";
                }
                for ($i = 1; $i <= $total_no_of_pages; $i++) {
                    if ($i == $current_page) {
                        echo "<li><a href='" . $self . "?page_no=" . $i . "' style='color:red;'>" . $i . "</a></li>";
                    } else {
                        echo "<li><a href='" . $self . "?page_no=" . $i . "'>" . $i . "</a></li>";
                    }
                }
                if ($current_page != $total_no_of_pages) {
                    $next = $current_page + 1;
                    echo "<li><a href='" . $self . "?page_no=" . $next . "'>Next</a></li>";
                    echo "<li><a href='" . $self . "?page_no=" . $total_no_of_pages . "'>Last</a></li>";
                }
                ?></ul><?php
            }
        }

        public static function getPurposes() {
            try {
                $sql = "SELECT * FROM purposes ORDER BY purpose ASC ";

                $stmt = self::$DB_CONN->prepare($sql);

                $stmt->execute();

                return $stmt;

            } catch (PDOException $e) {
                return 'Error: ' . $e->getMessage();
            }
        }

        public static function getMpesaTransactions($query)
        {
            try {
                $no = 1;

                $result = self::$DB_CONN->query($query);

                foreach ($result as $item) {
                    echo ' 
 <tr>
                    <td>' . $no . '</td>
			<td>' . $item[MPESA_CODE] . '</td>
			<td>' . $item[FULL_NAME] . '</td>
			<td>' . number_format($item[AMOUNT]) . '</td>
			<td>' . $item[DATE] . '</td>
			<td>' . $item[TIME] . '</td>
                    </tr>
                    ';
                }

            } catch (PDOException $e) {
                echo "Error " . $e->getMessage();
            }
        }

        public static function getAllEvents($query)
        {
            try {
                $no = 1;

                $result = self::$DB_CONN->query($query);

                foreach ($result as $item) {
                    echo ' 
 <tr>
                    <td>' . $no . '</td>
			<td>' . $item[EVENT_NAME] . '</td>
			<td>' . $item[VENUE] . '</td>
			<td>' . $item[EVENT_START_DATE] . '</td>
			<td>' . $item[EVENT_END_DATE] . '</td>
                    </tr>
                    ';
                }

            } catch (PDOException $e) {
                echo "Error " . $e->getMessage();
            }
        }

        public static function getAllUserData($query) {
            try {
                $no = 1;
                $total_cash = 0;
                $total_cheque = 0;
                $total_forex = 0;

                $result = self::$DB_CONN->query($query);

                foreach ($result as $data) {
                    //validate if the data is 0
                    if ($data[CASH] == '0') {
                        $cash = '-';
                    } else {
                        $cash = number_format($data[CASH]);
                    }

                    if ($data[CHEQUE] == '0') {
                        $cheque = '-';
                    } else {
                        $cheque = number_format($data[CHEQUE]);
                    }

                    if ($data[FOREX] == '0') {
                        $forex = '-';
                    } else {
                        $forex = number_format($data[FOREX]);
                    }

                    echo '
		<tr>
			<td>' . $no . '</td>
			<td>' . $data[FULL_NAME] . '</td>
			<td>' . $data[PHONE_NUMBER] . '</td>
			<td>' . $data[PURPOSE] . '</td>

			<td>' . $cash . '</td>
			<td>' . $cheque . '</td>
			<td>' . $forex . '</td>
			<td>' . $data[PAYMENT_DATE] . '</td>
		</tr>
		';
                    $total_cash += $data[CASH];
                    $total_cheque += $data[CHEQUE];
                    $total_forex += $data[FOREX];
                    $no++;
                }

                if ($total_forex == '0') {
                    $total_forex = "-";
                } else {
                    $total_forex = number_format($total_forex);
                }

                echo '<tr>
			<td><b>Total:</b></td>
			<td></td>
			<td></td>
			<td></td>
			<td><b>' . number_format($total_cash) . '</b></td>
			<td><b>' . number_format($total_cheque) . '</b></td>
			<td><b>' . $total_forex . '</b></td>
			<td></td>
		</tr>';

            } catch (PDOException $e) {
                echo "Error " . $e->getMessage();
            }
        }

    }
