<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
	echo "Connected successfully";
}

// Create database
$sql = "CREATE DATABASE rest";

//executeQuery($sql, 'create db rest', $conn);

$sql = "CREATE TABLE posts (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
title VARCHAR(30) NOT NULL,
body VARCHAR(300) NOT NULL,
date TIMESTAMP
)";

//executeQuery($sql, 'create table posts', $conn);

$sql = "INSERT INTO posts (title, body)
VALUES ('Первая статья', 'Статья самая первая в таблице posts и в базе данных rest')";

//executeQuery($sql, 'insert table posts', $conn);

$sql = "SELECT id, title, body, date FROM posts";
$result = $conn->query($sql);
//executeSelect($result);

$sql = "DELETE FROM posts WHERE id=3";
//executeQuery($sql, 'delete posts', $conn);

$sql = "UPDATE posts SET title='Вторая статья', body='Вторая статья тут' WHERE id=2";
executeQuery($sql, 'update posts', $conn);

function executeSelect($result) {
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "id: " . $row["id"]. " - title: " . 
			$row["title"] . " - body: " . 
			$row["body"] . " - date: " . 
			$row["date"] . "<br>";
		}
	}
}

function executeQuery($sql, $name, $conn) {
    if ($conn->query($sql) === TRUE) {
		echo $name . " successfully";
	} else {
		echo $name . " error " . $conn->error;
	}
}

$conn->close();

?>