<?php


class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
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
            } else if ($this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = "Email is already taken";
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
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                echo "Andmed on õigesti sisestatud";

                // Andmete lisamine andmebaasi
                if($this->userModel->register($data)){
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
            }


        } else {
            $data = array(
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'password_confirm_err' => ''
            );
        }

        // Kutsun vaate viimase asjana, enne tegelen infoga
        $this->view('users/register', $data);
        }

    public function login(){

        // Log In vormi kontroll
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Eemaldab kahtlased märgid. Nt. HTML tag-id ja tundmatud tähed.
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = array(
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            );

            // Emaili kontroll
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter a email';
            }

            // Passwordi kontroll
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter a password';
            }

            if (!$this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = "Email does not exist";
            }

            if(empty($data['email_err']) AND empty($data['password_err'])) {
                // Sisse logimine
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if($loggedInUser) {
                    // Kasutaja session
                    $this->createUserSession($loggedInUser);
//                    echo "Oled sees";
                } else{
                    $data["password_err"] = "Your password is incorrect!";
                }

            } else {
                echo ("Something is wrong");
            }

        }

        $this->view('users/login', $data);
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_name'] = $user->user_name;
        $_SESSION['user_email'] = $user->user_email;
        header('Location: '.URLROOT.'/pages/index');
        redirect('pages/index');

    }

    public function logout() {
        session_unset();
        session_destroy();
        redirect('users/login');
    }
}