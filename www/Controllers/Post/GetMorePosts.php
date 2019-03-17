<?php

include_once '../../Database/DB.php';
include_once '../../Functions/Post.php';

$db = new DB();
$pdo = $db->newConnection();

Post::dbConnection($pdo);

$results = Post::getMorePosts();

echo json_encode($results);