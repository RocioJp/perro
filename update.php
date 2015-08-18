<!DOCTYPE HTML>
<html>
    <head>
        <title>Update A Record</title>
  
    </head>
<body>

<!-- just a header label -->
<h1>PDO: Update a Record</h1>
 
<?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
//include database connection
include 'config/database.php';
 
// check if form was submitted
if($_POST){
     
    try{
     
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE potluck
                    SET name=:name, food=:food, confirmed=:confirmed 
                    WHERE id = :id";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // bind the parameters
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':food', $_POST['food']);
        $stmt->bindParam(':confirmed', $_POST['confirmed']);
        $stmt->bindParam(':id', $id);
         
        // Execute the query
        if($stmt->execute()){
            echo "Record was updated.";
        }else{
            echo 'Unable to update record. Please try again.';
        }
         
    }
     
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
 
<!-- just a header label -->
<h1>PDO: Update a Record</h1>
 
<?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
// read current record's data
try {
    // prepare select query
    $query = "SELECT id, name, food, confirmed FROM potluck WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
     
    // this is the first question mark
    $stmt->bindParam(1, $id);
     
    // execute our query
    $stmt->execute();
     
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // values to fill up our form
    $name = $row['name'];
    $food = $row['food'];
    $confirmed = $row['confirmed'];
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
<!--we have our html form here where new user information will be entered-->
<form action='update.php?id=<?php echo htmlspecialchars($id); ?>' method='post' border='0'>
    <table>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" /></td>
        </tr>
        <tr>
            <td>Food</td>
            <td><input type='food' name='food' value="<?php echo htmlspecialchars($food, ENT_QUOTES);  ?>" /></td>
        </tr>
        <tr>
            <td>Confirmed</td>
            <td><input type='text' name='confirmed'  value="<?php echo htmlspecialchars($confirmed, ENT_QUOTES);  ?>" /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' />
        <a href='read.php'>Back to read records</a>
            </td>
        </tr>
    </table>
</form>

</body>
</html>