<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

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

	protected $model = "category_model";
	protected $appName = "category";

	public function __construct() {
        parent::__construct();
        $this->load->model($this->model,'mdl');
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
		$this->load->view($this->appName.'/create');
	}

	public function save()
	{
		$this->mdl->insert($_POST);
		$this->session->set_flashdata('message', 'Your item has been saved.');
		redirect($this->appName);
	}

	public function show($id)
	{
		$this->load->view($this->appName.'/show',["data"=>$this->mdl->find($id)]);
	}

	public function edit($id)
	{
		$this->load->view($this->appName.'/edit',["data"=>$this->mdl->find($id)]);
	}

	public function update()
	{
		$this->mdl->update($_POST,$this->input->post('id'));
		$this->session->set_flashdata('message', 'Your item has been updated.');
		redirect($this->appName);
	}

	public function delete($id)
	{
		$this->mdl->delete($id);
		$this->session->set_flashdata('message', 'Your item has been deleted.');
		redirect($this->appName);
	}
}
