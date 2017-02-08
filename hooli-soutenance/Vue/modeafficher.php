<?php
session_start();
$q = $_GET["q"];
$id=$_SESSION['id'];

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "hooli";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";


$sql = "SELECT * FROM modes WHERE id = '" . $q . "'";

$result = mysqli_query($conn, $sql);

$sql1 = "SELECT nom, temperature, lumiere FROM modes WHERE id_utilisateurs=$id";
$result = $conn->query($sql1);



echo "<table border='1'>
<tr>
<th>nom</th>
<th>temperature</th>
<th>lumiere</th>
</tr>";

$rowcount=mysqli_num_rows($result);
echo $rowcount;

if ($result->num_rows > 0) {
    // 输出每行数据
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nom'] . "</td>";
        echo "<td>" . $row['temperature'] . "</td>";
        echo "<td>" . $row['lumiere'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
