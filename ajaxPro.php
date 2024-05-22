<?php 
$position = $_POST['position'];
print_r($position);
$sql="";
foreach($position as $pos)
{
    $sql    .= "Update admin set sortid=".$pos['sort']." WHERE id=".$pos['id'].";";
}  
try {
    // First of all, let's begin a transaction
    $con->beginTransaction();
    // A set of queries; if one fails, an exception should be thrown
    $con->query($sql);
    // If we arrive here, it means that no exception was thrown
    // i.e. no query has failed, and we can commit the transaction
    $conn->commit();
    } catch (Exception $e) {
    // An exception has been thrown
    // We must rollback the transaction
    $conn->rollback();
}
?>