<?php
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "company";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM Admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Successful login
        $_SESSION["admin_username"] = $username;
        header("Location: admin_dashboard.php");
    } else {
        // Failed login
        echo '<script>alert("Invalid username or password");
                window.location.href="adminLogin.php";
                </script>';
    }
}
?>