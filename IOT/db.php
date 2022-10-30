<?php 
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){
  switch ($_POST['action']) {
    case 'insertdata':
    insertRecord();
    break;
    case 'showProcess':
    showProcess();
    default:
    break;
  }
}

function insertRecord() {
        $card = $_POST['card_id'];
        $username= $_POST['usern'];
  // echo  $card." card is received "; 
   //echo  $username." username is received"; 
    try{

      define('DB_SERVER','localhost');
      define('DB_USER','root');
      define('DB_PASS' ,'');
      define('DB_NAME','iot_check');
      $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    
      if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      else
      {
    $insertQuery = mysqli_query($con,"INSERT INTO `iot_users`(`usercard`,`username`) 
                          VALUES ('$card','$username')");
                          if ($insertQuery) {
                           echo $card." ".$username." "." is inserted";
                          }else{
                            echo "already exists";
                          }
                    }
                  }
              catch (mysqli_sql_exception $e) {
                // other mysql exception (not duplicate key entry)
                echo $e;
              }
              
  }
function showProcess()
{  
  echo "done";
}
?>
 
