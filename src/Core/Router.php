<?php

namespace Wiloke\Core;

class Router
{
    protected $requestMethod;
    protected $aRouter;
    protected $aDynamicRouter;
    protected $currentRawController;
    protected $aParams = [];
    
    public static function load($config)
    {
        $oRoute = new static();
        include $config;
        
        return $oRoute;
    }
    
    public function get($route, $controller)
    {
        $this->aRouter['GET'][$route] = $controller;
        if (strpos($route, '{') !== false) {
            $this->aDynamicRouter['GET'][$route] = $controller;
        }
        
        return $this;
    }
    
    public function post($route, $controller)
    {
        $this->aRouter['POST'][$route] = $controller;
        
        return $this;
    }
    
    protected function generateRegex($dynamicRoute)
    {
        return preg_replace_callback('/{[a-zA-z0-9]+}/', function ($aMatches) {
            return '([a-zA-z0-9]+)';
        }, $dynamicRoute);
    }
    
    /**
     * @param $route
     *
     * @return bool
     */
    protected function isRouteExists($route): bool
    {
        if (isset($this->aRouter[$this->requestMethod][$route])) {
            $this->currentRawController = $this->aRouter[$this->requestMethod][$route];
            
            return true;
        }
        
        foreach ($this->aDynamicRouter[$this->requestMethod] as $dynamicRoute => $rawController) {
            $regex = $this->generateRegex($dynamicRoute);
            if (preg_match('#^'.$regex.'#', $route, $aMatches)) {
                $this->currentRawController = $rawController;
                unset($aMatches[0]);
                $this->aParams = array_values($aMatches);
                
                return true;
            }
        }
        
        return false;
    }
    
    protected function getController()
    {
        return $this->currentRawController;
    }
    
    protected function callAction($controller, $method)
    {
        if (!App::get($controller)) {
            $oInstance = new $controller;
            App::bind($controller, $oInstance);
        }
        
        return call_user_func_array([App::get($controller), $method], $this->aParams);
    }
    
    private function reset()
    {
        $this->aParams = [];
    }
    
    public function direct($route, $requestMethod)
    {
        $this->reset();
        $this->requestMethod = $requestMethod;
        if ($this->isRouteExists($route)) {
            $aParseRoute = explode('@', $this->currentRawController);
            try {
                // nhan vao 3 tham so: 'Wiloke\Controllers\LoginController', 'loadIndex', ['xxx']
                return $this->callAction(...$aParseRoute);
            } catch (\Exception $e) {
            }
        }
    }
}
