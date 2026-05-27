<?php

class Threedice extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Threedice_model', 'Users_model']);
    }

    public function index()
    {
        $AllGames = $this->Threedice_model->AllGames();
        foreach ($AllGames as $key => $game) {
            $AllGames[$key]->details = $this->Threedice_model->ViewBet($game->id);
        }

        $data = [
            'title' => 'Three Dice History',
            'AllGames' => $AllGames
        ];
        template('three_dice/index', $data);
    }

    public function bet_details($id)
    {
        $AllUsers = $this->Threedice_model->ViewBet($id);
        foreach ($AllUsers as $key => $value) {
            $AllUsers[$key]->user_name = $this->Threedice_model->getUserName($value->user_id);
        }
        $data = [
            'title' => 'Game Bet Details',
            'AllUsers' => $AllUsers
        ];
        template('three_dice/show_details', $data);
    }
}
