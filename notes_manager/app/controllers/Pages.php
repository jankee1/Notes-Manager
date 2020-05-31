<?php
class Pages extends Controller {
    
    public function __construct() {
        session_status() == PHP_SESSION_NONE ? session_start() : '';
    }
    
    public function index($parameters_taken = '') {

        if(!empty($parameters_taken)) {
            $users = $this->model('users');
            method_exists($users, $parameters_taken) ? $parameters_taken : header("location:" . URLROOT . "/main");
            $info = $users->$parameters_taken(); //executes method and returns $info array
        }
        
        $data = [
            'title' => 'This is title',
            'description' => 'this is description'
        ];
        
        $data = isset($info) ? $data + $info : $data;
        $this->view('main/index', $data);
    }
    
    public function home(...$parameters_taken) {
        if(isset($_SESSION['passcode'])) {
            
            if(count($parameters_taken) <= 2) {
                $method = empty($parameters_taken) ? 'read' : $parameters_taken[0];
                $param_to_pass = isset($parameters_taken[1]) ? $parameters_taken[1] : '';
            } else {
                $method = 'read';
                $param_to_pass = '';
            }

            $crud = $this->model('crud');
            method_exists($crud, $method);
            $data = $crud->$method( $param_to_pass ); // executes method and return $data array
    //        print_r($data);
            $this->view("home/$method", $data);

        }
        else 
            header("location:" . URLROOT . "/index");
    } 
    
}
