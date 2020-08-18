<?php
include '../../core/db_connect.php';

$content=null;
$stmt = $pdo->query("SELECT * FROM posts");

while ($row = $stmt->fetch())
{

    $content .= "<a href=\"post?slug={$row['slug']}\">{$row['title']}</a>";
}

echo $content;
include '../core/layout.php';