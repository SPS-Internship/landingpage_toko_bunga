<?php
require '../../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM categories WHERE id=?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
