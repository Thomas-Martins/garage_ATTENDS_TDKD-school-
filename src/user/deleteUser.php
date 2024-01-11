<?php 

// SESSION LOGIN
/* session_start();
if(empty($_SESSION['is_loggedin'])){
    header('Location:/login.php');
}
*/
require_once("../connexion.php");


$id=$_GET['id'];
if (isset($_GET['id']) && intval($_GET['id']) != 0) {
    

    $id = intval(trim($_GET['id']));
  

    $sqlDelete = "DELETE FROM user WHERE user.id = :id";
    $queryDelete = $db->prepare($sqlDelete);
    $queryDelete->execute(["id"=> $id ]);
    header('Location: index.php');
   
    
}


?>
