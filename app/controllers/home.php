<?php
class Home extends Controller {
    public function index($name = '')
    {
        /*echo $name . ' ' . $otherName;*/
        $user = $this->model('User');
        $user->name = $name;
        /*echo $user->name;*/

        $this->view('home/index', ['name' => $user->name]);
        /*incarc view-ul index.php din home*/
        

    }
   
} 