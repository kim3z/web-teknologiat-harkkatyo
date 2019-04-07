<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

include_once '../../Database/DB.php';
include_once '../../Database/Models/Post.php';

$db = new DB();
$dbConn = $db->newConnection();

$post = new Post($dbConn);

$post->title = $_POST['title'];
$post->content = $_POST['content'];
$post->user_id = $_POST['user_id'];
$post->category_id = (int)$_POST['post-category'];

$img = $_FILES['create-post-img'];
$file_name = $post->uploadImage($img, $post->user_id);
if ($file_name) {
    $post->img = $file_name;
} else {
    echo 'false';
    return;
}

if ($post->create()) {
    echo 'true';
    //header('Location: page_login.php?register_success=true');
} else {
    echo 'false';
    //header('Location: page_register.php?register_success=false');
}

?>
