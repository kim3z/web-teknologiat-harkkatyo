<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

class Post {
    protected static $db;

    public static function dbConnection(PDO $pdo) {
        self::$db = $pdo;
    }
    
    public static function getPosts() {
        $statement = self::$db->prepare("SELECT * FROM posts ORDER BY id DESC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMorePosts($latestShowId) {
        $stmt = self::$db->prepare('SELECT * FROM posts WHERE id < :latest_shown_id ORDER BY id DESC LIMIT 1');

        $params = array(
            ':latest_shown_id' => $latestShowId,
        );

        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPost($post_id) {
        $statement = self::$db->prepare("SELECT * FROM posts WHERE id=:post_id");

        $params = array(
            ':post_id' => $post_id,
        );

        $statement->execute($params);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function getPostAuthor($user_id) {
        $statement = self::$db->prepare("SELECT * FROM users WHERE id=:user_id");

        $params = array(
            ':user_id' => $user_id,
        );

        $statement->execute($params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!isset($user)) {
            return null;
        }

        return $user['username'];
    }

}
