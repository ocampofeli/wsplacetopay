<?php

/*
 * @utor Brayan Felipe Ocampo Galeano
 * ocampofeli@gmail.com
 * movil: 301 393 8052
 */

class authenticationPSE {

    public $login;
    public $tranKey;
    public $seed;
    
    public function __construct() {
        
        $config = parse_ini_file("config.ini");
        
        $this->login = $config['identificador'];
        $this->seed = date('c');
        $this->tranKey = sha1($this->seed . $config['tranKey'], false);
        
    }
    

}
