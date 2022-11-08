<?php
class adminController {

    public $admin;

    public function __construct($settings)
    {
        $this->admin = model('Admin', $settings);
    }

    public function index(){
        view("Admin/admin", 'asas');
    }
}