<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categories extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Categories_model');
        $this->load->library('form_validation');
    }
    
    public function delete($id) 
    {
        $row = $this->Categories_model->get_by_id($id);

        if ($row) {
            $this->Categories_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Hapus Data Berhasil.</div>');
            redirect(site_url('categories'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categories'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('categories_name', 'categories name', 'trim|required');

	$this->form_validation->set_rules('categories_id', 'categories_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Categories.php */
/* Location: ./application/controllers/Categories.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-12-10 16:37:35 */
/* http://harviacode.com */