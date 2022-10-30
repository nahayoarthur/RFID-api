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
  echo  $card." card is received"; 

define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME','rfid_card');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
  $insertQuery = mysqli_query($con,"INSERT INTO `card_tbl`(`card_number`) 
                         VALUES ('$card')");
                        if ($insertQuery) {
                            echo " inserted";
                        } else {
                            echo "failed to insert";
                        }
}


}

function showProcess()
{  
  echo "done";
}
?>
 
