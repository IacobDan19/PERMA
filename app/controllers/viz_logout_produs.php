<?php  
require_once "../app/models/viz_logout_produs.php";
require_once "../app/views/viz_logout_produs/viz_logout_produs_layout.php";
class viz_logout_produs extends Controller {
    //declaram variabile....aici
    public function index($name = '')
    {
        $user = $this->model('viz_logout_produs');
        $user->name = $name;
        $this->view('viz_logout_produs/viz_logout_produs_layout', ['name' => $user->name]);
    }
}