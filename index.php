<?php

    /**
     * load AppController to be able to extend it at all times
     */
    require_once 'src/controller/AppController.php';
    
    /**
     * get the uri segments
     * We use these uri segments to get and load the correct controller and method
     * the remainder of the uri segments are given to the controller's method as arguments
     */
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);

    if( empty($uri_segments[2]) ){
        /**
        * set the default controller
        */
       $controllerName = 'main';
    } else {
        $controllerName = $uri_segments[2];
    }
    
    /**
     * Set the standard method for each controller
     * the standard method is the method called when no explicit method is given
     * the given value of 'default' is which method is called when no explicit method is given
     */
    $arrDefaultMethods = [
        'default' => 'norm'
    ];
    
    /**
     * make the controller string match the controller object: take out unwanted Characters and ad the word 'Controller' to the end
     */
    $controllerName = preg_replace("/[^A-Za-z0-9?!]/", '', $controllerName).'Controller'; 
    require_once 'src/controller/'.$controllerName.'.php';

    
    //create new object of the controller and give the method name so it can be loaded in the view
    /**
     * get the correct method name
     * if an explicit method name is given in the url use that on
     * else if we declared a standard method name in $arrDefaultMethods use that one
     * else use the default method name
     */
    if( !empty($uri_segments[3]) ){
        $method = preg_replace("/[^A-Za-z0-9?!]/", '', $uri_segments[3]);
    } else if( !empty($arrDefaultMethods[$controllerName]) ){
        $method = $arrDefaultMethods[$controllerName];
    } else{
        $method = 'norm';
    }
    
    /**
     * Load the controller
     * Create a new object of the controller and give the method as a parameter (needed to load in the correct view element)
     * Call the method
     */
    $controllerName .= 'Controller';
    require_once 'src/controller/'.$controllerName.'.php';
    
    $controller = new $controllerName($method);
    $controller->$method();