<html>
<head>
    <title>PHP Test</title>
</head>
    <body>
    <?php echo '<p>Welcome to the Site!</p>';

    // When running this script on a local database, the servername must be 'localhost'. Use the name and password of the web user account created earlier. Do not use the root password.
    $servername = "localhost";
    $username = "atr0x";
    $password = "@Trompoukis1!";

    // Create MySQL connection
    $conn = mysqli_connect($servername, $username, $password);

    // If the conn variable is empty, the connection has failed. The output for the failure case includes the error message
    if (!$conn) {
        die('<p>Connection failed: </p>' . mysqli_connect_error());
    }
    echo '<p>Connected successfully to the database! :) </p>';
    ?>
</body>
</html>
