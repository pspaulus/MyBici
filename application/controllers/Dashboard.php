<?php

class Dashboard extends CI_Controller
{
	public function index()
    {
		$data['helpers']['dashboard'] = base_url() . 'js/helpers/dashboard.js';
        $this->load->view('header', $data);
        $this->load->view('dashboard/dashboard');        
        $this->load->view('footer');
    }
}