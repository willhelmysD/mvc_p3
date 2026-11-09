<?php

class IndexController{

    public function inicio(){

        require_once "View/index.php";

    }

    public function about(){
        require_once "View/index/aboutView.php";

    }

}