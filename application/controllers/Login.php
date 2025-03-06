<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function index()
    {
        $session = $this->session->userdata('isLogin');

        if ($session == FALSE) {
            $this->load->view('login_page');
        } else {
            if (!isset($_SESSION)) {
                session_start();
            }
            // session_start();
            redirect('admin/Dashboard');
        }
    }

    public function checklogin()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_verifylogin');

        if ($this->form_validation->run() == FALSE) {
            echo '<script> console.log("sss") </script>';
            $data['error'] = '2';
            $this->load->view('login_page', $data);
            $this->session->sess_destroy();
        } else {
            redirect('admin/Dashboard');
        }
    }

    public function verifylogin()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        //Load the Login model for database check
        $this->load->model('Model_login', 'login');
        $result = $this->login->login($username, $password);

        if ($result != false) {
            foreach ($result as $user) {
                $s['id'] = $user->id;
                $s['su'] = $user->su;
                $s['password'] = $user->password;
                $s['staff_fname'] = $user->fname;
                $s['staff_mname'] = $user->mname;
                $s['staff_lname'] = $user->lname;
                $s['staff_gender'] = $user->gender;
                $s['account_type'] = $user->account_type_id;
                $s['staff_official_email'] = $user->email;
                $s['staff_position_title'] = $user->position_title;
                $s['staff_position'] = $user->position;
                $s['staff_division'] = $user->division;
                $s['staff_id'] = $user->staff_id_account;
                $s['last_login'] = $user->last_login;
                $s['isLogin'] = 'true';

                $this->session->set_userdata($s);
                $su = $this->session->userdata('su');


                $message = '1';
                $this->session->set_flashdata('message', $message);
            }

            if ($su == 1) {
                $this->session->set_flashdata('email_notif', 'Account has been Deactivated!');
                return false;
            } else {
                return true;
            }
        } else {

            $this->session->set_flashdata('email_notif', 'Incorrect Username or Password! Please try again.');
            return false;
        }
    }

    // public function verifylogin(){
    //     $username = $this->input->post('username');
    //     $password = md5($this->input->post('password'));

    //     $api = $this->config->config["cwc_main_mis"]."api_docts/login/" .$username. '/' . $password;
    //     //$api = base_url()."Api_docts/login/" .$username. '/' . $password;
    //     $json = file_get_contents($api);

    //     if(isset($json)){

    //         $result = json_decode($json, true);

    //         if ($result != false) {

    //             foreach ($result as $data){
    //                 // for account table
    //                 $s['a_user'] = $data["a_user"];
    //                 $s['a_password'] = $data["a_password"];
    //                 $s['a_staff_id'] = $data["a_staff_id"];
    //                 $s['a_last_login'] = $data["a_last_login"];

    //                 // for staff details table
    //                 $s['staff_id'] = $data["staff_id"];
    //                 $s['staff_fname'] = $data["staff_fname"];
    //                 $s['staff_mname'] = $data["staff_mname"];
    //                 $s['staff_lname'] = $data["staff_lname"];
    //                 $s['staff_division'] = $data["staff_division"];
    //                 $s['staff_official_email'] = $data["staff_official_email"];
    //                 $s['staff_position'] = $data["staff_position"];
    //                 $s['staff_position_title'] = $data["staff_position_title"];

    //                 $s['isLogin'] = true;

    //                 $this->session->set_userdata($s);

    //                 $message = '1'; 
    //                 $this->session->set_flashdata('message', $message);

    //                 return true;  
    //             }

    //         }else{
    //             $this->session->set_flashdata('error', 'Incorrect Username or Password! Please try again...');
    //             return false;
    //         }

    //     }else{
    //         // add error messages
    //         echo '404';
    //     }
    //  }
}
