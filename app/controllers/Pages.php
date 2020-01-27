<?php


class Pages extends Controller
{
    public function __construct()
    {
    }


    public function index(){
        $data = array('title' => 'Welcome - Pages controller is loaded');
        $this->view('pages/index',$data);
    }


}