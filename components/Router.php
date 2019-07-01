<?php
    class Router
    {
        private $routes;

        public function __construct()
        {
            $routesPath = ROOT.'/config/routes.php';

            $this->routes = include($routesPath);
        }

        private function getURI()
        {
            if (!empty($_SERVER['REQUEST_URI'])){
                return trim($_SERVER['REQUEST_URI'], '/');
            }
        }

        public function run()
        {
            $uri = $this->getURI();

            foreach ($this->routes as $uriPattern => $path){
                if (preg_match("#$uriPattern#", $uri)) {
                    $internalRoute = preg_replace("#$uriPattern#", $path, $uri);

                    $segments = explode('/', $internalRoute);

                    $controllerName = array_shift($segments).'Controller';
                    $controllerName = ucfirst($controllerName);

                    $actionName = 'action'.ucfirst(array_shift($segments));

                    $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                    if (file_exists($controllerFile)) {
                        include_once($controllerFile);
                    } else {
                        $this->ErrorPage404();
                    }

                    $controllerObject = new $controllerName;
                    if (method_exists($controllerObject, $actionName)) {
                        $controllerObject->$actionName();
                        return;
                    } else {
                        $this->ErrorPage404();
                    }
                }
            }
        }

        private function ErrorPage404()
        {
            header("HTTP/1.1 404 Not Found");
            header("Status: 404 Not Found");
            header("Location: /404");
        }
    }