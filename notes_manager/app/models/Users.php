<?php

class Users {
    
    public function login() {
         
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST ,$_POST);

            $info = [
                'login_username' => $_POST['login_username'],
                'password' => $_POST['password'],
                'login_username_err' => '',
                'password_err' => ''
            ];
            // searches provided login in DB
                $db = new Database();
                $login_user = $db->connect()->prepare("SELECT login, password, id FROM users WHERE login = :login LIMIT 1");
                $login_user->bindParam(":login", $info['login_username']);
                $login_user->execute();
                $result = $login_user->fetch();
                $user_in_db = isset($result['login']) ? $result['login'] : '';
                
            if(empty($info['login_username']))
                $info['login_username_err'] = 'Please type in your login';
            if(empty($info['password']))
                $info['password_err'] = 'Please type in your password';
            
            // checks whether provided password is correct / whether provided login exists in DB
            if((empty($user_in_db) || password_verify($info['password'], $result['password']) != true) && empty($info['password_err'])) 
               $info['password_err'] = 'Wrong username and password combination';
               
            if(!empty($info['login_username_err']) || !empty($info['password_err'])) 
                return $info;
            else {
                $session = new Sessions();
                $session->assing_session_credentials($info['login_username'], $result['id']);
                header("location:" . URLROOT . "/Pages/home/read");
            }
        } else 
            header("location:" . URLROOT . "/index");   
    }
    
    public function register() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST ,$_POST);

            $info = [
                'register_username' => $_POST['register_username'],
                'password1' => $_POST['password1'],
                'password2' => $_POST['password2'],
                'register_username_err' => '',
                'password1_err' => '',
                'password2_err' => '',
                'register_success' => ''
            ];
            
            // checks login corectness and whether provided login already exists in DB
            $db = new Database();
            $users = $db->connect()->prepare("SELECT login FROM users WHERE login = :login LIMIT 1");
            $users->bindParam(":login", $info['register_username']);
            $users->execute();
            $result = $users->fetch();
            $user_in_db = isset($result['login']) ? $result['login'] : '';
            
            if(empty($info['register_username']))
                $info['register_username_err'] = 'Please type in your login';
            else if(strlen($info['register_username']) < 6)
                $info['register_username_err'] = 'Your login must be at least 6 characters';
            else if(!empty($user_in_db))
                $info['register_username_err'] = 'Such user already exists';
            
            //checks passwords corectness
            if(empty($info['password1']))
                $info['password1_err'] = 'Please type in your password';
            if(empty($info['password2']))
                $info['password2_err'] = 'Please confirm your password';
            elseif($info['password1'] != $info['password2'])
                $info['password2_err'] = 'Passwords do not match';
            
            if(!empty($info['register_username_err']) || !empty($info['password1_err']) || !empty($info['password2_err'])) 
                return $info;
            else {
                // adds user to DB
                $password = password_hash($info['password1'], PASSWORD_DEFAULT);
                $register = $db->connect()->prepare("INSERT INTO users(login, password)
                                                                values(:login, :password)");
                $register->bindParam(':login', $info['register_username']);
                $register->bindParam(':password', $password);
                $register->execute();
                $info['register_username'] = '';
                $info['register_success'] = 'Registration process is finished successfully';
                return $info;
            }
        } else 
            header("location:" . URLROOT . "/index");
    }
    
    public function logout() {
        $session = new Sessions();
        $session->stop_session();
        header("location:" . URLROOT . "/index");
    }
}