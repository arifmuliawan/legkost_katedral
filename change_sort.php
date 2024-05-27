<?php 
include("config.php");
$position = $_POST['position'];
print_r($position);
exit();
$sql="";  
try {
    // First of all, let's begin a transaction
    $con->begin_transaction();
    // A set of queries; if one fails, an exception should be thrown
    foreach($position as $pos)
    {
        //$sql = mysqli_query($con,"UPDATE `admin` SET sortid=$pos[sort] WHERE id=$pos[id]");
        $sql= $con->prepare("UPDATE `admin` SET sortid=? WHERE id=?");
        $sql->bind_param("ii",$pos['sort'],$pos['id']);
        $sql->execute();
    }
    // If we arrive here, it means that no exception was thrown
    // i.e. no query has failed, and we can commit the transaction
    $con->commit();
} 
catch (Exception $e) {
    // An exception has been thrown
    // We must rollback the transaction
    $con->rollback();
    throw $e;
}
?>