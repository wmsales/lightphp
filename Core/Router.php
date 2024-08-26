<?php

namespace Core;

class Router
{
    private $urlController = null;
    private $urlAction     = null;
    private $urlParams     = [];

    public function __construct()
    {
        $this->splitUrl();
        $this->routeRequest();
    }

    private function splitUrl()
    {
        if (isset($_GET['url'])) {
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->urlController = isset($url[0]) ? ucfirst($url[0]) : null;
            $this->urlAction     = isset($url[1]) ? $url[1] : null;

            unset($url[0], $url[1]);

            $this->urlParams = array_values($url);
        }
    }

    private function routeRequest()
    {
        if (!$this->urlController) {
            $this->loadDefaultController();
        } else {
            $this->loadControllerAndAction();
        }
    }

    private function loadDefaultController()
    {
        $page = new \App\Controllers\Home();
        $page->index();
    }

    private function loadControllerAndAction()
    {
        $controllerPath = APP . 'Controllers/' . $this->urlController . '.php';
        
        if (file_exists($controllerPath)) {
            $controller = '\\App\\Controllers\\' . $this->urlController;
            if (class_exists($controller)) {
                $this->urlController = new $controller();
                $this->callAction();
            } else {
                $this->loadErrorPage();
            }
        } else {
            $this->loadErrorPage();
        }
    }

    private function callAction()
    {
        if (method_exists($this->urlController, $this->urlAction) && is_callable([$this->urlController, $this->urlAction])) {
            if (!empty($this->urlParams)) {
                call_user_func_array([$this->urlController, $this->urlAction], $this->urlParams);
            } else {
                $this->urlController->{$this->urlAction}();
            }
        } else {
            $this->loadErrorPage();
        }
    }

    private function loadErrorPage()
    {
        $page = new \App\Controllers\Error();
        $page->pageNotFound($this->urlController, $this->urlAction);
    }
}
