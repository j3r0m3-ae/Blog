<?php

    class SiteController
    {
        public static function actionIndex()
        {
            $messages = Blog::getMessageList();

            require_once(ROOT.'/views/index.php');
        }

        public static function actionAdd()
        {
            if (isset($_POST['submit'])) {
                $message['author'] = $_POST['author'];
                $message['date'] = time();
                $message['message'] = $_POST['message'];

                if (isset($_FILES['file'])) {
                    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                        $path = "uploads/" . $message['date'] . "_" . $_FILES['file']['name'];
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
                            $message['path_to_file'] = $path;
                        }
                    }
                }
            }

            $errors = false;

            if (!Blog::checkAuthor($message['author'])) {
                $errors[] = "Имя не должно быть меньше 2-х символов";
            }
            if (!Blog::checkMessage($message['message'])) {
                $errors[] = "Сообщение не должно быть меньше 2-х символов";
            }

            if (!$errors) {
                Blog::saveMessage($message);
            }

            $_SESSION['errors'] = $errors;
            header("Location: /");
        }

        public static function actionError()
        {
            require_once(ROOT.'/views/404.php');
        }
    }