<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Phase A</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.button').click(function(){
                    var clickBtnValue = $(this).val();
                    var ajaxurl = 'phasea.php',
                    data =  {'action': clickBtnValue};
                    $.post(ajaxurl, data, function (response) {
                        // Response div goes here.
                        alert("action performed successfully");
                    });
                });
            });
        </script>
	</head>
	<body>
		<p></p>
        <center>
        <form>
            <input type="submit" class="btn btn-primary" name="insert" value="insert" />
            <input type="submit" class="btn btn-primary" name="select" value="select" />
        </form>
        </center>
		<br>

		<?php

		/* php file to establish mysql connection and query database */

		/* servername name should remain static,
		replace username, password, and dbname with proper parameters */
		$servername = "localhost";
		$username = "admin";
		$password = "password";
		$dbname = "phasea";

		/* create connection,
		note this connection is using a mysqli connection,
		this connection is ONLY intended for MySQL databases,
		for other database connections use PDO */
		$conn = new mysqli($servername, $username, $password, $dbname);

		/* verify a unsuccessful connection */
		if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error);
        

        /* build database query,
        everything between SELECT and FROM are your table columns,
        to the right of FROM is your table */
        $sql = "SELECT `id`, `role`, `username` FROM users";

        /* query database */
        $result = $conn->query($sql);

        echo "<center>Users</center>";                
        /* more than zero results */
        if ($result->num_rows > 0) {
            /* fetch results */
            while($row = $result->fetch_assoc()) {
                    if (($row["id"] - 1) % 10 == 0) echo "<br>";
                echo "<center>id: " . $row["id"].
                        " - Name: " . $row["username"].
                        " - Role:  ".$row["role"]. "</center>";
            }
            echo "<br><br>";
        } else {
            echo "0 results";
        }

        $sql = "SELECT `id`, `name`, `cost` FROM product";
    
            /* query database */
        $result = $conn->query($sql);

        echo "<center>Products</center>";        
        /* more than zero results */
        if ($result->num_rows > 0) {
            /* fetch results */
            while($row = $result->fetch_assoc()) {
                    if (($row["id"] - 1) % 10 == 0) echo "<br>";
                echo "<center>id: " . $row["id"].
                        " - Name: " . $row["name"].
                        " - Cost:  ".$row["cost"]."</center>";
            }
            echo "<br><br>";
        } else {
            echo "0 results";
        }

        $sql = "SELECT `id`, `user_id`, `product_id` FROM product_orders";
    
        /* query database */
        $result = $conn->query($sql);

        echo "<center>Product User Junction</center>";
        /* more than zero results */
        if ($result->num_rows > 0) {
            /* fetch results */
            while($row = $result->fetch_assoc()) {
                    if (($row["id"] - 1) % 10 == 0) echo "<br>";
                echo "<center>id: " . $row["id"].
                        " - Order ID: " . $row["id"].
                        " - Product ID:  ".$row["product_id"]."</center>";
            }
            echo "<br><br>";
        } else {
            echo "0 results";
        }
        $conn->close();

        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'insert':
                    insert();
                    break;
                case 'select':
                    select();
                    break;
            }
        }
        
        function select(){
            echo "The select function is called.";
            exit;
         }
         function insert(){
            echo "The insert function is called.";
            exit;
         }
		?>
	</body>
</html>
