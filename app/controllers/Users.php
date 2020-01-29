<?php


class Users extends Controller
{
    public function __construct()
    {
        $usersModel = $this->model('User');
    }

    public function register(){
        // Registreerimise vormi kontroll
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Eemaldab kahtlased märgid. Nt. HTML tag-id ja tundmatud tähed.
            print_r($_POST);
            $data = array(
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'password_confirm_err' => ''
            );

            if(empty($data['name'])) {
                $data['name_err'] = 'Please enter a name';
            }
        }

        print_r($data);
        // Kutsun vaate viimase asjana, enne tegelen infoga
        $this->view('users/register', $data);
        }

}