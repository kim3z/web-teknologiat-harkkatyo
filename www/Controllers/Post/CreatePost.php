<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

include_once '../../Database/DB.php';
include_once '../../Database/Models/Post.php';

if (
    !isset($_POST['title']) || 
    !isset($_POST['content']) || 
    !isset($_POST['user_id']) || 
    !isset($_POST['post-category']) || 
    !isset($_POST['create-post-img'])
) {
    echo 'false';
    return;
}

$db = new DB();
$dbConn = $db->newConnection();

$post = new Post($dbConn);

$post->title = $_POST['title'];
$post->content = $_POST['content'];
$post->user_id = $_POST['user_id'];
$post->category_id = (int)$_POST['post-category'];
$post->img = $_POST['create-post-img'];

// If we want image upload
/*$img = $_FILES['create-post-img'];
$file_name = $post->uploadImage($img, $post->user_id);
if ($file_name) {
    $post->img = $file_name;
} else {
    echo 'upload-false';
    return;
}*/

if ($post->create()) {
    echo 'true';
    //header('Location: page_login.php?register_success=true');
} else {
    echo 'false';
    //header('Location: page_register.php?register_success=false');
}

?>
