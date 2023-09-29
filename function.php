<?php 

define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','Wedding');

class DB_con
{

  function __construct(){
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    $conn -> set_charset("utf8");
    $this->dbcon = $conn;

  } // endfunctoin connert

  public function usernamevailable($username){
    $checkuser = mysqli_query($this->dbcon,"SELECT Username FROM User WHERE Username = '$username' ");
    return $checkuser;

  } //end fn usernamevailable
   
}

?>