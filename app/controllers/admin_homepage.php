<?php  
require_once "../app/models/admin_homepage.php";
require_once "../app/views/admin_homepage/admin_homepage_layout.php";
class admin_homepage extends Controller {
    //declaram variabile....aici
    public function index($name = '')
    {
        $user = $this->model('admin_homepage');
        $user->name = $name;
        $this->view('admin_homepage/admin_homepage_layout', ['name' => $user->name]);
    }
}