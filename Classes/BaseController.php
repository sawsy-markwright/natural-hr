<?php

class BaseController
{
    public $helper;
    public $db;

    public function __construct()
    {

        $this->helper = new HelperController();
        $this->db = new DbController();

    }

}