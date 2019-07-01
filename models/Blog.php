<?php

    class Blog
    {
        const TABLE_NAME = 'messages';

        public static function getMessageList()
        {
            $link = Db::getConnection();

            $sql = "SELECT author, date, message, path_to_file FROM ".self::TABLE_NAME;
            $result = $link->query($sql);

            $i=0;
            $messageList = [];

            while ($row = $result->fetch()) {
                $messageList[$i]['author'] = $row['author'];
                $messageList[$i]['date'] = $row['date'];
                $messageList[$i]['message'] = $row['message'];
                $messageList[$i]['path_to_file'] = ltrim($row['path_to_file'], ".");
                $i++;
            }

            return $messageList;
        }

        public static function saveMessage($message)
        {
            $link = Db::getConnection();

            $sql = "INSERT INTO ".self::TABLE_NAME." (author, date, message, path_to_file) VALUES (:author, :date, :message, :path_to_file)";

            $result = $link->prepare($sql);

            $result->bindParam(':author',$message['author'], PDO::PARAM_STR);
            $result->bindParam(':date',$message['date'], PDO::PARAM_INT);
            $result->bindParam(':message', $message['message'], PDO::PARAM_STR);
            $result->bindParam(':path_to_file', $message['path_to_file'], PDO::PARAM_STR);

            $result->execute();

        }

        public static function checkAuthor($author)
        {
            return strlen($author) > 2;
        }

        public static function checkMessage($message)
        {
            return strlen($message) > 2;
        }
    }