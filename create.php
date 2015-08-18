<?php
if($_POST){
 
    // include database connection
    include 'config/database.php';
 
    try{
     
        // insert query
        $query = "INSERT INTO potluck SET name=:name, food=:food, confirmed=:confirmed";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
 
        // bind the parameters
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':food', $_POST['food]);
        $stmt->bindParam(':confirmed', $_POST['confirmed']);
                
        // Execute the query
        if($stmt->execute()){
            echo "<div>Record was saved.</div>";
        }else{
            die('Unable to save record.');
        }
         
    }
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>