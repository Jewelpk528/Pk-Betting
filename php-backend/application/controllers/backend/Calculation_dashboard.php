<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calculation_dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Calculation_dashboard_model');
    }

        public function index()
    {
        $start = $this->input->get('start_date');
        $end = $this->input->get('end_date');

        $data = [
            'title' => 'Calculation Dashboard',
            'user_add_amount' => $this->Calculation_dashboard_model->get_user_add_amount($start,$end),
            'user_sub_amount' => $this->Calculation_dashboard_model->get_user_sub_amount($start,$end),
            'total_game_amount' => $this->Calculation_dashboard_model->get_total_game_amount($start,$end),
            'admin_profit' => $this->Calculation_dashboard_model->get_admin_profit($start,$end),
        ];

        template('calculation_dashboard/dashboard', $data);
    }
}