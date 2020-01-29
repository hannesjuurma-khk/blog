<?php

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = array();

    public function __construct()
    {
        $url = $this->getUrl();
        // Controlleri kontrollimine ja saamine
        if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
            $this ->currentController = ucwords($url[0]);
            //See kustutab $url array-st ära antud numbri
            unset($url[0]);
        }
        require_once '../app/controllers/'.$this ->currentController.'.php';
        $this->currentController = new $this->currentController;

        // Meetodi saamine URL-ist ning seejärel kontroll, kas aktiivses controlleris on antud meetod
        if(method_exists($this -> currentController, $url[1])) {
            $this -> currentMethod = $url[1];
            unset($url[1]);
        }
        // Parameetrid
        // Veider if lause :)
        $this->params = $url ? array_values($url) : array();

        // call a callback function with url parameters - controllers, methods, parameters
        call_user_func_array(array($this->currentController, $this->currentMethod), $this->params);
    }




    // Sellega muudan url-i eraldi osadeks ning teen nendest array.
    public function getUrl(){
        if(isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }


    }
}