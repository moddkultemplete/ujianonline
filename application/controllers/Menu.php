<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('mst_user', ['vc_email' =>
        $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('mst_user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/user_footer');
        } else {
            $this->db->insert('mst_user_menu', ['vc_menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">New Menu Added</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {

        $data['title'] = 'SubMenu Management';
        $data['user'] = $this->db->get_where('mst_user', ['vc_email' =>
        $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('mst_user_menu')->result_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('mst_user_menu')->result_array();


        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/user_footer');
        } else {
            $data = [
                'vc_title' => $this->input->post('title'),
                'nu_id_user_menu' => $this->input->post('menu_id'),
                'vc_url' => $this->input->post('url'),
                'vc_icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')

            ];
            $this->db->insert('mst_user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">New Sub Menu Added</div>');
            redirect('menu/submenu');
        }
    }
}
