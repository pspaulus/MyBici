<?php

class Escritorio extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $data['helpers'] = base_url() . 'js/helpers/escritorio.js';

//       $sql = \App\Persona::create([
//            'nombres' => 'admin',
//            'apellidos' => 'admin',
//            'edad' => '23',
//            'genero' => 'm',
//        ]);
        $all = \App\Persona::all();
        dd($all->first());

        $this->load->view('header');
        $this->load->view('escritorio', $data);
        $this->load->view('footer');
    }
}
