<?php
class App 
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];
    public function __construct()
    {
        //echo 'ok!';
        /*print_r($this->parseUrl());*/
        $url = $this->parseUrl();
        //print_r($url);
        /*verificare daca controller-ul exista*/
        if(file_exists('../app/controllers/' . $url[0] . '.php'))
        {
            $this->controller = $url[0];
            unset($url[0]);
        }
        require_once '../app/controllers/' . $this->controller . '.php';
        //echo $this->controller;
        $this->controller = new $this->controller;
       /*var_dump($this->controller);*/

       /*verif daca elementul 1 al url-ului e setat(daca metoda din URL
       este in acel controller exista)*/
       if(isset($url[1]))
       {
           if(method_exists($this->controller, $url[1]))
           {
               $this->method = $url[1];
               unset($url[1]);
            

           }
       }
       //print_r($url);
       $this->params = $url ? array_values($url) : [];
       call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if(isset($_GET['url']))
        {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));    
            //echo $_GET['url'];
        }

    }
}