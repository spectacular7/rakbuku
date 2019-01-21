<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Booklist extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Booklist_model');
        $this->load->library('form_validation');
    }
    
    public function delete($id) 
    {
        $row = $this->Booklist_model->get_by_id($id);

        if ($row) {
            $this->Booklist_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('booklist'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('booklist'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('stores_id', 'stores id', 'trim|required');
	$this->form_validation->set_rules('books_id', 'books id', 'trim|required');
	$this->form_validation->set_rules('book_stock', 'book stock', 'trim|required');
	$this->form_validation->set_rules('price', 'price', 'trim|required');

	$this->form_validation->set_rules('booklist_id', 'booklist_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Booklist.php */
/* Location: ./application/controllers/Booklist.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-12-10 16:37:35 */
/* http://harviacode.com */