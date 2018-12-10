<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Authors extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Authors_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'authors/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'authors/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'authors/index.html';
            $config['first_url'] = base_url() . 'authors/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Authors_model->total_rows($q);
        $authors = $this->Authors_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'authors_data' => $authors,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('authors/authors_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Authors_model->get_by_id($id);
        if ($row) {
            $data = array(
		'authors_id' => $row->authors_id,
		'authors_name' => $row->authors_name,
		'telp_number' => $row->telp_number,
		'email' => $row->email,
	    );
            $this->load->view('authors/authors_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('authors'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('authors/create_action'),
	    'authors_id' => set_value('authors_id'),
	    'authors_name' => set_value('authors_name'),
	    'telp_number' => set_value('telp_number'),
	    'email' => set_value('email'),
	);
        $this->load->view('authors/authors_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'authors_name' => $this->input->post('authors_name',TRUE),
		'telp_number' => $this->input->post('telp_number',TRUE),
		'email' => $this->input->post('email',TRUE),
	    );

            $this->Authors_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('authors'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Authors_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('authors/update_action'),
		'authors_id' => set_value('authors_id', $row->authors_id),
		'authors_name' => set_value('authors_name', $row->authors_name),
		'telp_number' => set_value('telp_number', $row->telp_number),
		'email' => set_value('email', $row->email),
	    );
            $this->load->view('authors/authors_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('authors'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('authors_id', TRUE));
        } else {
            $data = array(
		'authors_name' => $this->input->post('authors_name',TRUE),
		'telp_number' => $this->input->post('telp_number',TRUE),
		'email' => $this->input->post('email',TRUE),
	    );

            $this->Authors_model->update($this->input->post('authors_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('authors'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Authors_model->get_by_id($id);

        if ($row) {
            $this->Authors_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('authors'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('authors'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('authors_name', 'authors name', 'trim|required');
	$this->form_validation->set_rules('telp_number', 'telp number', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');

	$this->form_validation->set_rules('authors_id', 'authors_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Authors.php */
/* Location: ./application/controllers/Authors.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-12-10 16:37:34 */
/* http://harviacode.com */