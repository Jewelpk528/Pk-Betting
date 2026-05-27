<?php

class Triplefun extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Triplefun_model', 'Users_model']);
    }

    public function index()
    {
        $AllGames = $this->Triplefun_model->AllGames();
        foreach ($AllGames as $key => $game) {
            $AllGames[$key]->details = $this->Triplefun_model->ViewBet($game->id);
        }

        $data = [
            'title' => 'Triple Fun History',
            'AllGames' => $AllGames
        ];
        template('triple_fun/index', $data);
    }

    public function triple_bet($id)
    {
        $AllUsers = $this->Triplefun_model->ViewBet($id);
        foreach ($AllUsers as $key => $value) {
            $AllUsers[$key]->user_name = $this->Triplefun_model->getUserName($value->user_id);
        }
        $data = [
            'title' => 'Game History',
            'AllUsers' => $AllUsers
        ];
        template('triple_fun/show_details', $data);
    }
}
