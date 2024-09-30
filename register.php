<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Klinik Ajwa</title>
</head>

<body>
<?php
// call file to connect to server
include ("header.php");?>

<?php
// This query inserts a record in the clinic table
// has form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array(); //initialize an error array

    // Check for a Firstname
    if (empty($_POST['FirstName_P'])) {
        $error[] = 'You forgot to enter your first name.';
    } else {
        $fn = mysqli_real_escape_string($connect, trim($_POST['FirstName_P']));
    }

    // Check for a lastName
    if (empty($_POST['LastName_P'])) {
        $error[] = 'You forgot to enter your last name.';
    } else {
        $ln = mysqli_real_escape_string($connect, trim($_POST['LastName_P']));
    }

    // Check for an insurance number
    if (empty($_POST['InsuranceNumber'])) {
        $error[] = 'You forgot to enter your Insurance Number.';
    } else {
        $in = mysqli_real_escape_string($connect, trim($_POST['InsuranceNumber']));
    }

    // Check for a diagnose
    if (empty($_POST['Diagnose'])) {
        $error[] = 'You forgot to enter your diagnose.';
    } else {
        $d = mysqli_real_escape_string($connect, trim($_POST['Diagnose']));
    }

    // Register the user in the database
    // Make the query:
    $q = "INSERT INTO pesakit (ID_P, FirstName_P, LastName_P, InsuranceNumber, Diagnose) 
          VALUES ('', '$fn', '$ln', '$in', '$d')";
    $result = @mysqli_query($connect, $q); // Run the query

    if ($result) { // If it runs
        echo '<h1>Thank you!</h1>';
        exit();
    } else { // If it did not run
        echo '<h1>System error</h1>';
        // Debugging message
        echo '<p>' . mysqli_error($connect) . '<br>Query: ' . $q . '</p>';
    }

    mysqli_close($connect); // Close the database connection.
    exit();
}
?>

<h2>Register</h2>
<h4>* required field</h4>
<form action="register.php" method="post">
    <p><label class="label" for="FirstName_P">First Name: *</label>
    <input id="FirstName_P" type="text" name="FirstName_P" size="30" maxlength="150" 
           value="<?php if (isset($_POST['FirstName_P'])) echo $_POST['FirstName_P']; ?>" /></p>

           <p><label class="label" for="LastName_P">Last Name: *</label>
<input id="LastName_P" type="text" name="LastName_P" size="30" maxlength="60" 
       value="<?php if (isset($_POST['LastName_P'])) echo $_POST['LastName_P']; ?>" /></p>

<p><label class="label" for="InsuranceNumber">Insurance Number: *</label>
<input id="InsuranceNumber" type="text" name="InsuranceNumber" size="12" maxlength="12" 
       value="<?php if (isset($_POST['InsuranceNumber'])) echo $_POST['InsuranceNumber']; ?>" /></p>

<p><label class="label" for="Diagnose">Diagnose: </label>
<textarea name="Diagnose" rows="5" cols="40"><?php if (isset($_POST['Diagnose'])) echo $_POST['Diagnose']; ?></textarea></p>

<p align="left"><input id="submit" type="submit" name="submit" value="Register" /> &nbsp;&nbsp;
<input id="reset" type="reset" name="reset" value="Clear All" /></p>
</form>
</body>
</html>
