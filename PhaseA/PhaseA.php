<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Phase A</title>
	</head>
	<body>
		<p></p>
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
        

        /* Query for users table */
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

        /* query for product table */
        $sql = "SELECT `id`, `name`, `cost` FROM product";
    
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
    
        /* query for product user junction table */
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

        echo "<center><h3>Insertion Example</h3></center>";
        /* Insertion Query */
        $sql = "INSERT INTO users (`role`, `username`, `password`) VALUES (1, \"unknownuser\", \"foqjweorjads\");";
        echo "<center>"."<i>Running Insertion Query: </i>".$sql."</center><br>";
        $result = $conn->query($sql);

        /* Query for the inserted 'unknownuser' */
        $sql = "SELECT `id`, `role`, `username` FROM users WHERE username = \"unknownuser\"";
        echo "<center>"."Selection Query for User with username \"unknownuser\": </center>";
        $result = $conn->query($sql);

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

        echo "<center><h3>Update Example</h3></center>";
        /* Query for Update */
        $sql = "UPDATE users SET username = \"user4\" WHERE username = \"unknownuser\";";
        echo "<center><i>Running Update Query: </i>".$sql."</center><br>";
        $result = $conn->query($sql);


        /* Query for the updated unknownuser */
        $sql = "SELECT `id`, `role`, `username` FROM users WHERE username = \"unknownuser\"";
        echo "<center>"."Selection Query for User with username \"unknownuser\": </center>";
        $result = $conn->query($sql);

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
            echo "<center>0 results</center><br>";
        }
        $sql = "SELECT `id`, `role`, `username` FROM users WHERE username = \"user4\"";
        echo "<center>"."Selection Query for User with updated username set to \"user4\": </center>";
        $result = $conn->query($sql);

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
            echo "<center>0 results</center><br>";
        }

        echo "<center>User table after insertion and update queries</center><br>";
        $sql = "SELECT `id`, `role`, `username` FROM users";        
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

        echo "<center><b>Running Initial DDL and DML</b></center><br>";                
        /* Dropping database and recreating with base data */
        $sql = "DROP TABLE IF EXISTS product_orders, users, product;\n";
        $result = $conn->query($sql);
        echo "<center>".$sql."</center><br>";
        $sql = "CREATE TABLE users ( `id` int NOT NULL auto_increment, `role` tinyint NOT NULL default 1, `username` varchar(200), `password` varchar(250), PRIMARY KEY (`id`) ) AUTO_INCREMENT=1;\n";
        $result = $conn->query($sql);
        echo "<center>".$sql."</center><br>";
        $sql = "CREATE TABLE product ( `id` int NOT NULL auto_increment, `name` varchar(200), `cost` decimal(7,2), PRIMARY KEY (`id`) ) AUTO_INCREMENT=1;\n";
        $result = $conn->query($sql);
        echo "<center>".$sql."</center><br>";
        $sql = "CREATE TABLE product_orders ( `id` int NOT NULL auto_increment, `user_id` int NOT NULL, `product_id` int NOT NULL, PRIMARY KEY(`id`), FOREIGN KEY(user_id) REFERENCES users(`id`), FOREIGN KEY(product_id) REFERENCES product(`id`) ) AUTO_INCREMENT=1;\n";
        $result = $conn->query($sql);
        echo "<center>".$sql."</center><br>";
        $sql = "INSERT INTO product (`name`,`cost`) VALUES (\"Fishing Rod\", 12.99),(\"Cell Phone\", 999.99),(\"Luxury Car\", 87829.82);\n";
        $result = $conn->query($sql);
        echo "<center>".$sql."</center><br>";
        $sql = "INSERT INTO users (`role`, `username`, `password`) VALUES (null, \"user1\", \"password1\"), (3,\"user2\",\"password2\"), (2, \"user3\", \"password3\");\n";
        $result = $conn->query($sql);
        echo "<center>".$sql."</center><br>";
        $sql = "INSERT INTO product_orders (`user_id`, `product_id`) VALUES (1,2),(1,3),(2,3),(3,1)";
        $result = $conn->query($sql);
        echo "<center>".$sql."</center><br>";


        echo "<br><center><b><i>Initial Data Tables</i></b></center><br>";
        /* Query for users table */
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

        /* query for product table */
        $sql = "SELECT `id`, `name`, `cost` FROM product";

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

        /* query for product user junction table */
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
		?>
	</body>
</html>
