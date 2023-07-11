<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname ="discount";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])){
    $name = $_POST['name_user'];
    $tel = $_POST['tel_user'];
    $email = $_POST['email_user'];
    $location = $_POST['lacation_user'];

}

$sql = "INSERT INTO users_discount (name_user, tel_user, email_user, location_user)
VALUES ('John', 'Doe', 'john@example.com')";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>




<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    
    // Validate the form data (you can add more validation as needed)
    if (empty($username) || empty($password) || empty($email)) {
        echo "Please fill in all the fields.";
    } else {
        // Connect to the database (replace 'hostname', 'username', 'password', and 'database' with your own details)
        $conn = new mysqli("hostname", "username", "password", "database");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Check if the username or email already exists
        $checkQuery = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $checkResult = $conn->query($checkQuery);
        
        if ($checkResult->num_rows > 0) {
            echo "Username or email already exists. Please choose a different one.";
        } else {
            // Insert the user into the database
            $insertQuery = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
            if ($conn->query($insertQuery) === TRUE) {
                echo "Signup successful!";
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        }
        
        // Close the database connection
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Signup</title>
</head>
<body>
    <h1>User Signup</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br>
        
        <label>Email:</label>
        <input type="email" name="email" required><br>
        
        <input type="submit" value="Sign Up">
    </form>
</body>
</html>
