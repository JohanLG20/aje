<?php

namespace AJE\Config;

require(CONFIG . '/routes.php');

//TODO :Comment class
class Router
{
    private $routes;
    private $availablePaths;
    private $requestedPath;

    public function __construct()
    {
        $this->routes = ROUTES;
        $this->availablePaths = array_keys($this->routes);
        $this->requestedPath = $_GET['path'] ?? '/';
        $this->parseRoutes();
    }

    private function parseRoutes(): void
    {
        $explodedRequestedPath = $this->explodePath($this->requestedPath);
        $params = [];

        foreach ($this->availablePaths as $candidatePath) {
            $foundMatch = true;
            $explodedCandidatePath = $this->explodePath($candidatePath);
            if (count($explodedCandidatePath) == count($explodedRequestedPath)) {
                foreach ($explodedRequestedPath as $key => $requestedPathPart) {
                    $candidatePathPart = $explodedCandidatePath[$key];
                    if ($this->isParam($candidatePathPart)) {
                        $params[substr($candidatePathPart, 1, -1)] = $requestedPathPart;
                    } else if ($candidatePathPart !== $requestedPathPart) {
                        $foundMatch = false;
                        break;
                    }
                }
                if ($foundMatch) {
                    $route = $this->routes[$candidatePath];
                    break;
                }
            }
        }

        if (isset($route)) {
            $controller = new $route['controller'];
            $controller->{$route['method']}(...$params);
        }
    }

private function explodePath(string $path): array {
		return explode('/', rtrim(ltrim($path, '/'), '/'));
	}

    private function isParam(string $candidatePathPart): bool
    {
        return str_contains($candidatePathPart, '{') && str_contains($candidatePathPart, '}');
    }
}

/*

abstract class Router


{
    public static function redirect(string $action = "default", string $params = "default", bool $isConnected = false) : void
    {

        $ctlToCall = null;

        switch ($action) {
            case 'login':
                require(CONTROLLER . '/login_ctl.php');
                break;

            case 'signup':
                $ctlToCall = new UserManagementController();
                $ctlToCall->prepareAndDisplayView('create');
                break;

            case 'logout':
                require(CONTROLLER . '/logout.php');
                break;

            case 'productmanagement':
                $ctlToCall = new ProductManagementController();
                $ctlToCall->prepareAndDisplayView($params);
                break;

            case 'ajax':
                AJAXRouter::redirect();
                break;

            default:
                require(VIEW . '/firstview_view.php');
        }
    }

}*/
