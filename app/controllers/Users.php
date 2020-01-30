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
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
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

            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter a email';
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['email_err'] = 'Please enter a valid email';
            }

            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter a password';
            } else if (strlen($data['password']) < PASSWORD_LEN) {
                $data['password_err'] = 'Password must contain '.PASSWORD_LEN.' characters';
            }

            if(empty($data['confirm_password'])) {
                $data['password_confirm_err'] = 'Please enter password correctly';
            } else if ($data['confirm_password'] !== $data['password']) {
                $data['password_confirm_err'] = 'Passwords must match';
            }

            if(empty($data['name_err']) AND empty($data['email_err']) AND empty($data['password_err']) AND empty($data['password_confirm_err'])) {

            }

        }

        print_r($data);
        // Kutsun vaate viimase asjana, enne tegelen infoga
        $this->view('users/register', $data);
        }

}