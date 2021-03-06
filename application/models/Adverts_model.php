<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adverts_model extends CI_Model
{

    public $table = 'adverts';
    public $id = 'adverts_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_is_active_all()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('is_active', '1'); 
        return $this->db->get($this->table)->result();
    }

     function count_by_owners()
    {
        $this->db->join('stores', 'adverts.stores_id=stores.stores_id');
        $this->db->join('owners', 'owners.stores_id=stores.stores_id');
        $this->db->where('owners.owners_id', $this->session->userdata('id'));
        $this->db->where('adverts.is_active', '1');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_by_owners($limit)
    {
        $this->db->join('stores', 'adverts.stores_id=stores.stores_id');
        $this->db->join('owners', 'owners.stores_id=stores.stores_id');
        $this->db->where('owners.owners_id', $this->session->userdata('id'));
        $this->db->where('adverts.is_active', '1');
        $this->db->limit($limit, 0);
        return $this->db->get($this->table)->result();
    }

    function get_is_datecom_all()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('date_of_com < now()'); 
        return $this->db->get($this->table)->result();
    }

    public function get_store(){
        $this->db->order_by('stores_name', 'asc');
        $this->db->join('owners', 'owners.stores_id=stores.stores_id'); 
        $this->db->where('owners.is_verify', '1'); 
        return $this->db->get('stores')->result();
    }

    function get_kode(){
        $this->db->select('RIGHT(adverts.adverts_id,4) as kode', FALSE);
        $this->db->order_by('adverts_id','DESC');    
        $this->db->limit(1);
          $query = $this->db->get('adverts');      //cek dulu apakah ada sudah ada kode di tabel.    
          if($query->num_rows() <> 0){      
           //jika kode ternyata sudah ada.      
           $data = $query->row();      
           $kode = intval($data->kode) + 1;    
          }
          else {      
           //jika kode belum ada      
           $kode = 1;    
          }
          $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
          $d = date('Ymd');
          $kodejadi = "adv-".$d.'-'.$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi;  
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->join('stores', 'adverts.stores_id=stores.stores_id');
        $this->db->join('owners', 'owners.stores_id=stores.stores_id');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('adverts_id', $q);
	$this->db->or_like('stores_id', $q);
	$this->db->or_like('date_of_order', $q);
	$this->db->or_like('date_of_com', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('adverts_id', $q);
	$this->db->or_like('adverts_name', $q);
	$this->db->or_like('stores_id', $q);
	$this->db->or_like('date_of_order', $q);
	$this->db->or_like('date_of_com', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update('adverts', $data);
    }

    function update_b( $data, $id)
    {
        
        $this->db->update_batch($this->table, $data, $id);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Adverts_model.php */
/* Location: ./application/models/Adverts_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-02 16:21:36 */
/* http://harviacode.com */