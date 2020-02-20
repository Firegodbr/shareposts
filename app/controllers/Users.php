<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {

        $data = [
            'title' => 'SharePosts',
            'description' => 'Simple social network built on TraversyMVC'
        ];

        $this->view('pages/index', $data);
    }

    public function register()
    {
        //Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # Process Form

            //Sanitanize string

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''

            ];
            //Validate inputs
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter a name';
            }

            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter a email';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email already taken';
                }
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter a password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Please enter a password of more then 6 characters';
            }

            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please enter a confirm the password';
            } else {
                if ($data['confirm_password'] != $data['password']) {
                    $data['confirm_password_err'] = 'Passwords don\'t match';
                }
            }

            if (empty($data['confirm_password_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['name_err'])) {

                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are now register');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('users/register', $data);
            }
        } else {
            //Load Form
            //Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' =>   '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''

            ];

            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        //Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # Process Form
            //Sanitanize string

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter a email';
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter a password';
            }

            if ($this->userModel->findUserByEmail($data['email'])) {
            } else {
                $data['email_err'] = 'Email not register';
            }
            if (empty($data['email_err']) && empty($data['password_err'])) {
                $loggedUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedUser) {
                    $this->createUserSession($loggedUser);
                    redirect('posts');
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                $this->view('users/login', $data);
            }
        } else {
            //Load Form
            //Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
        redirect('pages/index');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('users/login');
    }

    public function isLogged()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}
