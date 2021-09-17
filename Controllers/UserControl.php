<?php

class UserControl
{
    public function index()
    {
        require "Views/index.php";

    }
    public function param($id)
    {
        require "Views/param.php";

    }

}