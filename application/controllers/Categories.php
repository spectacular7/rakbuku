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

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'categories/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'categories/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'categories/index.html';
            $config['first_url'] = base_url() . 'categories/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Categories_model->total_rows($q);
        $categories = $this->Categories_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'categories_data' => $categories,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('categories/categories_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Categories_model->get_by_id($id);
        if ($row) {
            $data = array(
		'categories_id' => $row->categories_id,
		'categories_name' => $row->categories_name,
	    );
            $this->load->view('categories/categories_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categories'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('categories/create_action'),
	    'categories_id' => set_value('categories_id'),
	    'categories_name' => set_value('categories_name'),
	);
        $this->load->view('categories/categories_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'categories_name' => $this->input->post('categories_name',TRUE),
	    );

            $this->Categories_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('categories'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Categories_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('categories/update_action'),
		'categories_id' => set_value('categories_id', $row->categories_id),
		'categories_name' => set_value('categories_name', $row->categories_name),
	    );
            $this->load->view('categories/categories_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categories'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('categories_id', TRUE));
        } else {
            $data = array(
		'categories_name' => $this->input->post('categories_name',TRUE),
	    );

            $this->Categories_model->update($this->input->post('categories_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('categories'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Categories_model->get_by_id($id);

        if ($row) {
            $this->Categories_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
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