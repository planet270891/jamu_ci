<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class category_model extends CI_Model {

	protected $table = "categories";

	public function __construct() {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function getAll($search = null,$limit = 10,$offset = 0,$isCount = FALSE){
        $this->db->select("*");
        $this->db->from($this->table);
        if ($search) {
            $this->db->like('name', $search);
            $this->db->or_like('description',$search);
        }
        if($isCount){
            $result = $this->db->get();
            return $result->num_rows();
        }else{
            $this->db->limit($limit, $offset);
            $this->db->order_by($this->table.'.id','desc');
            return $this->db->get();
        }
    }

    public function insert($data){
        $data["created_at"] = date("Y-m-d H:i:s");
    	$this->db->insert($this->table, $data);
    	return $this->db->insert_id();
    }

    public function find($id){
    	$this->db->where('id', $id);
        $this->db->limit(1);
        return $this->db->get($this->table)->row();
    }

    public function update($data,$id){
    	$this->db->where('id', $id);
    	$data["updated_at"] = date("Y-m-d H:i:s");
    	return $this->db->update($this->table, $data);
    }

    public function delete($id){
    	$this->db->where('id', $id);
    	return $this->db->delete($this->table);
    }

    public function all(){
        return $this->db->get($this->table)->result();
    }

}
