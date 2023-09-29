<?php

$servername = "localhost"; // Replace with your database server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "Wedding"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<script>
        function sendData(Url,Data) {
          
            $.ajax({
            type: "POST",
            url: Url,
            data: Data,
            success: function(response) {
                 return  response ;
            },
            error: function() {
                return "Error"
            }
           });

    }
</script>
