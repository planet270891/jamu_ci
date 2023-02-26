<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	protected $model = "product_model";
	protected $appName = "product";

	public function __construct() {
        parent::__construct();
        $this->load->model($this->model,'mdl');
        $this->load->model('category_model','category');
        $this->load->model('brand_model','brand');
        if(!$this->session->userdata('logged')){
            redirect('auth/login');
        }
    }

	public function index()
	{
		$config["base_url"] = null;
		$searchterm = ''; 
		if ($this->input->post('search')){
		    $searchterm = $this->input->post('default');
		    $this->session->set_userdata('searchterm', $searchterm);
		}
		else if ($this->session->userdata('searchterm')){
		    $searchterm = $this->session->userdata('searchterm');
		}
		else{
			$this->session->set_userdata('searchterm', null);
		}

		$offset = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$limit  = 10;
		$totalFiltered = $this->mdl->getAll($searchterm,$limit,$offset,TRUE);
		$getData = $this->mdl->getAll($searchterm,$limit,$offset,FALSE);
		$config["base_url"] = base_url($this->appName.'/index');
		$config["total_rows"] = $totalFiltered;
        $config["per_page"] = $limit;
        $config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);
        $str_links = $this->pagination->create_links();
        $links = explode('&nbsp;', $str_links);
        $data = array(
            'results' =>$getData->result(),
            'links' => $links
        );

		$this->load->view($this->appName.'/index',$data);
	}

	public function create()
	{
		$data  = array(
			"category"=>$this->category->all(),
			"brand"=>$this->brand->all()
		);
		$this->load->view($this->appName.'/create',$data);
	}

	public function save()
	{
		$insert_id = $this->mdl->insert($_POST);
		$this->session->set_flashdata('message', 'Your item has been saved.');
		$this->updatePhoto($insert_id);
		redirect($this->appName);
	}

	public function show($id)
	{
		$product = $this->mdl->find($id);
		$data  = array(
			"data"=>$product,
			"category"=>$this->category->all(),
			"brand"=>$this->brand->find($product->brand_id),
			"categorySelected"=>$this->mdl->getCategory($id)
		);
		$this->load->view($this->appName.'/show',$data);
	}

	public function edit($id)
	{
		$data  = array(
			"category"=>$this->category->all(),
			"brand"=>$this->brand->all(),
			"data"=>$this->mdl->find($id),
			"categorySelected"=>$this->mdl->getCategory($id)
		);
		$this->load->view($this->appName.'/edit',$data);
	}

	public function update()
	{
		$id = $this->input->post('id');
		$this->mdl->update($_POST,$id);
		$this->session->set_flashdata('message', 'Your item has been updated.');
		$this->updatePhoto($id);
		redirect($this->appName);
	}

	public function delete($id)
	{
		$this->mdl->delete($id);
		$this->session->set_flashdata('message', 'Your item has been deleted.');
		redirect($this->appName);
	}

	private function updatePhoto($id) {
        if ($_FILES["file"]) {
            if (!is_dir(FCPATH . "/uploads/product/")) {
                mkdir(FCPATH . "/uploads/product/");
            }
            $this->load->library('upload');
            $config['upload_path'] = FCPATH . "/uploads/product/";
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['overwrite'] = true;
            $config['file_name'] = md5(time());
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file')) {
                $saved_file_name = $this->upload->data('file_name');
                $path = "uploads/product/" . $saved_file_name;
                $this->mdl->updateImage($path, $id);
            }
        }
    }
}
