<?php


class Pages extends Controller
{
    public function __construct()
    {
    }


    public function index(){
        $data = array('title' => 'Hi! Welcome to the main page (brought to you by Pages controller!)');
        $this->view('pages/index',$data);
    }
}