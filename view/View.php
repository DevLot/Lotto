<?php

/**
 * abstract class for all views 
 *
 * @author Fabingo Team
 */
abstract class View {

    protected $vars = array();

    public function assign($key, $value) {
        $this->vars[$key] = $value;
    }
    
    abstract function display();
}

