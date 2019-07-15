<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {


        $data['user'] = $this->db->get_where('mst_user', ['vc_email' =>
        $this->session->userdata('email')])->row_array();

        $data['title'] = 'Dashboard';
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/user_footer');
    }
}
