<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();
        $this->load->library('form_validation');
    }


    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'); {
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() == false) {

                $data['title'] = 'Login Page';
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/login');
                $this->load->view('templates/auth_footer');
            } else {
                //validasi berhasil
                $this->_login();
            }
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('mst_user', ['vc_email' => $email])->row_array();

        if ($user) {
            //user ada di DB
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['vc_password'])) {
                    $data = [
                        'email' => $user['vc_email'],
                        'role_id' => $user['nu_role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['nu_role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated !</div>');
                redirect('auth');
            }
        } else { //user tidak ada di DB
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered !</div>');
            redirect('auth');
        }
    }



    public function registration()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[mst_user.vc_email]', [
            'is_unique' => 'This email already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password1', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match !',
            'min_length' => 'password too short !'
        ]);
        $this->form_validation->set_rules('password2', 'Password2', 'required|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'vc_name' => htmlspecialchars($this->input->post('name', true)),
                'vc_email' => htmlspecialchars($this->input->post('email', true)),
                'img_image' => 'default.jpg',
                'vc_password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'nu_role_id' => 2,
                'is_active' => 1,
                'dt_created' => time()
            ];
            $this->db->insert('mst_user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please Login !</div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You Has Been Log Out !</div>');
        redirect('auth');
    }
}
