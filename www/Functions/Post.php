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
        $statement = self::$db->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT 1");
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

}
