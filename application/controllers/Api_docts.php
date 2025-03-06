<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api_docts extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('Model_api', 'api');
  }

  // Website api connection

  //testing
  // public function login($cid){ 
  //       $username = $cid;
  //       $password = md5($this->uri->segment(4));
  //       $user = $this->api->login_web($username,$password);
  //       header('Content-Type: application/json;charset=utf-8'); 
  //       $data = json_encode($user, JSON_PRETTY_PRINT);

  //       if($user != false){
  //           $output = $data;
  //         }else{
  //           $response = html_entity_decode($data);
  //           $output = $response;
  //         }
  //         echo  $output;
  // }

  // Website api connection

  public function login($username, $password)
  {
    $user = $this->api->login_web($username, $password);
    header('Content-Type: application/json;charset=utf-8');
    $data = json_encode($user, JSON_PRETTY_PRINT);

    if ($user != false) {
      $output = $data;
    } else {
      $response = html_entity_decode($data);
      $output = $response;
    }
    echo  $output;
  }

  public function staff()
  {
    $user = $this->api->get_staff_details();
    header('Content-Type: application/json;charset=utf-8');
    $data = json_encode($user, JSON_PRETTY_PRINT);
    $response = html_entity_decode($data);
    $output = $response;
    echo  $output;
  }

  public function routed_details($myid)
  {
    $user = $this->api->routed_details($myid);
    header('Content-Type: application/json;charset=utf-8');
    $data = json_encode($user, JSON_PRETTY_PRINT);
    $response = html_entity_decode($data);
    $output = $response;
    echo  $output;
  }

  public function profile_update()
  {
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json;charset=utf-8');
    $staff = $this->input->post('staff');
    $p_fname = $this->input->post('p_fname');
    $p_mname = $this->input->post('p_mname');
    $p_lname = $this->input->post('p_lname');
    $p_div = $this->input->post('p_div');
    $p_email = $this->input->post('p_email');
    $p_position = $this->input->post('p_position');
    $p_position_title = $this->input->post('p_position_title');

    $this->api->profile_updates($staff, $p_fname, $p_mname, $p_lname, $p_div, $p_email, $p_position, $p_position_title);

    $this->session->unset_userdata('staff_fname');
    $this->session->unset_userdata('staff_mname');
    $this->session->unset_userdata('staff_lname');
    $this->session->unset_userdata('staff_division');
    $this->session->unset_userdata('staff_official_email');
    $this->session->unset_userdata('staff_position');
    $this->session->unset_userdata('staff_position_title');

    $up_data = array(
      'staff_fname'     =>   $p_fname,
      'staff_mname'     =>   $p_mname,
      'staff_lname'     =>   $p_lname,
      'staff_division'     =>   $p_div,
      'staff_official_email'     =>  $p_email,
      'staff_position'     =>   $p_position,
      'staff_position_title'     =>   $p_position_title
    );

    $this->session->set_userdata($up_data);

    $user = 'Profile Information Updated Successfully';
    $data = json_encode($user, JSON_PRETTY_PRINT);
    $response = html_entity_decode($data);
    $output = $response;
    echo  $output;
  }

  public function change_pass()
  {
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json;charset=utf-8');
    $staff = $this->input->post('staff');
    $text_pass = $this->input->post('password');
    $new_pass = md5($this->input->post('password'));

    $this->api->change_password($staff, $new_pass, $text_pass);


    $this->session->unset_userdata('password');

    $up_data = array(
      'password'     =>   md5($new_pass)
    );

    $this->session->set_userdata($up_data);

    $user = 'Profile Information Updated Successfully';
    $data = json_encode($user, JSON_PRETTY_PRINT);
    $response = html_entity_decode($data);
    $output = $response;
    echo  $output;
  }

  // mobile api connection

  public function loginPost()
  {
    $username = $this->input->post('user');
    $password = md5($this->input->post('pass'));
    $user = $this->api->account($username, $password);
    header('Content-Type: application/json;charset=utf-8');
    $data = json_encode($user, JSON_PRETTY_PRINT);
    $response = html_entity_decode($data);
    if (empty($response)) {
      echo 'false';
    } else {
      echo $data;
    }
  }
}
