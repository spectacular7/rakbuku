<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Book_categories extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Book_categories_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'book_categories/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'book_categories/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'book_categories/index.html';
            $config['first_url'] = base_url() . 'book_categories/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Book_categories_model->total_rows($q);
        $book_categories = $this->Book_categories_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'book_categories_data' => $book_categories,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('book_categories/book_categories_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Book_categories_model->get_by_id($id);
        if ($row) {
            $data = array(
		'book_categories_id' => $row->book_categories_id,
		'books_id' => $row->books_id,
		'categories_id' => $row->categories_id,
	    );
            $this->load->view('book_categories/book_categories_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('book_categories'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('book_categories/create_action'),
	    'book_categories_id' => set_value('book_categories_id'),
	    'books_id' => set_value('books_id'),
	    'categories_id' => set_value('categories_id'),
	);
        $this->load->view('book_categories/book_categories_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'books_id' => $this->input->post('books_id',TRUE),
		'categories_id' => $this->input->post('categories_id',TRUE),
	    );

            $this->Book_categories_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('book_categories'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Book_categories_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('book_categories/update_action'),
		'book_categories_id' => set_value('book_categories_id', $row->book_categories_id),
		'books_id' => set_value('books_id', $row->books_id),
		'categories_id' => set_value('categories_id', $row->categories_id),
	    );
            $this->load->view('book_categories/book_categories_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('book_categories'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('book_categories_id', TRUE));
        } else {
            $data = array(
		'books_id' => $this->input->post('books_id',TRUE),
		'categories_id' => $this->input->post('categories_id',TRUE),
	    );

            $this->Book_categories_model->update($this->input->post('book_categories_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('book_categories'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Book_categories_model->get_by_id($id);

        if ($row) {
            $this->Book_categories_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('book_categories'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('book_categories'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('books_id', 'books id', 'trim|required');
	$this->form_validation->set_rules('categories_id', 'categories id', 'trim|required');

	$this->form_validation->set_rules('book_categories_id', 'book_categories_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Book_categories.php */
/* Location: ./application/controllers/Book_categories.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-12-10 16:37:34 */
/* http://harviacode.com */