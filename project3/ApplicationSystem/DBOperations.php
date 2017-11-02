<!-- Database Operations Class -->
<!-- by Anna Blendermann-->

<?php
// DATABASE OPERATIONS*********************************************
class DBOperations
{
    private $table;
    private $db;

    // CONSTRUCTOR*************************************************
    public function __construct()
    {
        /* connect to the applicationdb database */
        $host = "localhost";
        $user = "dbuser";
        $password = "goodbyeWorld";
        $database = "applicationdb";

        $this->table = "applicants";
        $this->db = $this->connectToDB($host, $user, $password, $database);
    }

    // CONNECT TO DATABASE*****************************************
    public function connectToDB($host, $user, $password, $database)
    {
        $db = mysqli_connect($host, $user, $password, $database);
        if (mysqli_connect_errno()) {
            echo "Connect failed.\n" . mysqli_connect_error();
            exit();
        }
        return $db;
    }

    // VERIFY PASSWORD**********************************************
    public function verifyPassword($email, $password)
    {
        /* query password using the email */
        $query = sprintf("select password from %s where email=\"$email\"", $this->table);
        $result = mysqli_query($this->db, $query);

        /* check return value of the query */
        if ($result) {
            $userpassword = $password;
            $dbpassword = mysqli_fetch_array($result)[0];

            /* verify password against the database */
            if (password_verify($userpassword, $dbpassword)) {
                return true;
            } else return false;
        }
    }

    // SUBMIT APPLICATION********************************************
    public function submitApp($name, $email, $gpa, $year, $gender, $password)
    {
        /* insert entry into the applicants table */
        $query = sprintf("insert into $this->table(name, email, gpa, year, gender, password) values ('%s', '%s', %s, %s, '%s', '%s')",
            $name, $email, $gpa, $year, $gender, $password);

        /* store result of the query */
        $result = mysqli_query($this->db, $query);

        /* check return value of the query */
        if ($result) {
            echo "<h2>The following entry has been added to the database</h2>";
        } else {
            echo "Inserting record failed." . mysqli_error($this->db);
        }
    }

    // UPDATE APPLICATION*********************************************
    public function updateApp($name, $email, $gpa, $year, $gender, $password)
    {
        /* update entry in the applicants table */
        $query = sprintf("update $this->table set name='%s', gpa=%s, year=%s, gender='%s', password='%s' where email=\"$email\"",
            $name, $gpa, $year, $gender, $password);
        $result = mysqli_query($this->db, $query);

        /* check return value of the query */
        if ($result) {
            echo "<h2>The entry has been updated in the database and the new values are:</h2>";
        } else {
            echo "Updating record failed." . mysqli_error($this->db);
        }
    }

    // GET ENTRY*******************************************************
    public function getEntry($email) {

        // query the database using the email param
        $query = sprintf("select * from %s where email=\"$email\"", $this->table);
        $result = mysqli_query($this->db, $query);

        // check return value from the query
        if ($result) {
            $dbarr = mysqli_fetch_array($result);
            $array = array("name" => $dbarr[0], "email" => $dbarr[1], "gpa" => $dbarr[2], "year" => $dbarr[3], "gender" => $dbarr[4]);
            return $array;
        }
        else return array();
    }

    // ADMINISTRATIVE QUERY********************************************
    public function adminQuery($array, $sort, $filter)
    {

        // parse the array of selected fields
        $fields = $array[0];
        for ($x = 1; $x < count($array); $x++) {
            $fields .= "," . $array[$x];
        }

        // query the database using the filters
        $query = sprintf("select $fields from %s where $filter", $this->table);
        $result = mysqli_query($this->db, $query);

        /* check return value of the query */
        if ($result) {
            return $result;
        } else {
            echo "Querying record failed." . mysqli_error($this->db);
        }
    }

    // DISCONNECT FROM DATABASE*****************************************
    public function disconnectFromDB() {

        /* close database connection */
        mysqli_close($this->db);
    }
}
