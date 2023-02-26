<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product_model extends CI_Model {

	protected $table = "product";

	public function __construct() {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    public function getAll($search = null,$limit = 10,$offset = 0,$isCount = FALSE){
        $this->db->select("
            product.id,
            product.created_at,
            product.code,
            product.name,
            product.price,
            product.images,
            brand.name as brand_name
        ");
        $this->db->from($this->table);
        $this->db->join('brand','brand.id = product.brand_id');
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
    	$this->db->insert($this->table, [
            "code"=>$data["code"],
            "name"=>$data["name"],
            "price"=>$data["price"],
            "expired"=>$data["expired"],
            "brand_id"=>$data["brand_id"],
            "created_at"=>date("Y-m-d H:i:s")
        ]);
        $product_id = $this->db->insert_id();
        if($data["category"]){
            foreach($data["category"] as $cat){
                $this->db->insert("product_category",[
                    "product_id"=>$product_id,
                    "category_id"=>$cat
                ]);
            }
        }
    	return $product_id;
    }

    public function find($id){
    	$this->db->where('id', $id);
        $this->db->limit(1);
        return $this->db->get($this->table)->row();
    }

    public function update($data,$id){
    	$this->db->where('id', $id);
    	$this->db->update($this->table,[
            "code"=>$data["code"],
            "name"=>$data["name"],
            "price"=>$data["price"],
            "expired"=>$data["expired"],
            "brand_id"=>$data["brand_id"],
            "updated_at"=>date("Y-m-d H:i:s")
        ]);

        if($data["category"]){
            $this->db->where('product_id', $id);
            $this->db->delete('product_category');
            foreach($data["category"] as $cat){
                $this->db->insert("product_category",[
                    "product_id"=>$id,
                    "category_id"=>$cat
                ]);
            }
        }

        return $id;
    }

    public function delete($id){
    	$this->db->where('id', $id);
    	return $this->db->delete($this->table);
    }

    public function updateImage($path,$id){
        $this->db->where('id', $id);
        $this->db->update($this->table,["images"=>$path]);
    }

    public function getCategory($id){
        $result = array();
        $this->db->select("category_id");
        $this->db->where('product_id', $id);
        $data = $this->db->get("product_category")->result();
        foreach($data as $row){
            $result[] = $row->category_id;
        }
        return $result;
    }

}
