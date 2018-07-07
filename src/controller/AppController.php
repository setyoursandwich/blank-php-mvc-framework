<?php

    class AppController{
        private $variables = [];
        private $methodname = [];
        
        //pass a variable to the view
        public final function set($arr){
            foreach($arr as $name => $value){
                $this->variables[$name] = $value;
            }
        }
        
        public final function __construct($methodName){
            $this->set(['viewElement' => $methodName]);
        }
        
        //create the variables for the view and than include the template
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
