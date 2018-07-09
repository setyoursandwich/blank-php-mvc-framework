<?php

    /**
     * This is the AppController
     * Every controller should inherit from this class
     * Notice the 'set', '__construct' and '__destruct' methods are final and shouldn't be overwritten by controllers
     */
    
    class AppController{
        private $variables = [];
        private $methodname = [];
        
        /**
         * Adds a variable to the variable list that will be passed through the view
         * @param {array} $arr The array keys will be the array name and the value its value
         */
        public final function set($arr){
            foreach($arr as $name => $value){
                $this->variables[$name] = $value;
            }
        }
        
        /**
         * The controller's constructor
         * Here we set the corresponding view element that belongs to the controller's method
         * @param {string} $methodName The name of the controller's method
         */
        public final function __construct($methodName){
            $this->set(['viewElement' => $methodName]);
        }
        
        
        /**
         * The controller's destructor
         * Here we create the variables that have been set in the 'set' method that should be accessible in the view
         * Afterwards we include the correct template
         */
        public final function __destruct() {
            //create variables
            foreach($this->variables as $name => $value ){
                ${$name} = $value;
            }
            //create variable to include correct element in template
            $element = str_replace("Controller", "", get_called_class());

            //no template nessecary for printing api json results
            if($element !== 'apihandler2'){
                $controller  = strtolower($element);
                //require the template
                require_once  __DIR__ . '/../view/template.php';
            }
            
        }
        
    }
