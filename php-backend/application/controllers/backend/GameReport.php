<?php
class GameReport extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['GameReport_model']);
    }
    
    // WIN/LOSE report for tbl_aviator_bet
    public function aviator_bet()
    {
        $data['title'] = 'Aviator Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_aviator_report();

        template('game_report/aviator_report', $data);
    }
    
    // WIN/LOSE report for ander baher bet
    public function ander_baher_bet()
    {
        $data['title'] = 'Ander Baher Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_ander_baher_report();
        
        template('game_report/ander_baher_report', $data);
    }
    
    // WIN/LOSE report for animal roulette bet
    public function animal_roulette_bet()
    {
        $data['title'] = 'Animal Roulette Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_animal_roulette_report();

        template('game_report/animal_roulette_report', $data);
    }
    
    // WIN/LOSE report for icon roulette bet
    public function icon_roulette_bet()
    {
        $data['title'] = 'Icon Roulette Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_icon_roulette_report();
        
        template('game_report/icon_roulette_report', $data);
    }
    
    // WIN/LOSE report for baccarat bet
    public function baccarat_bet()
    {
        $data['title'] = 'Baccarat Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_baccarat_report();

        template('game_report/baccarat_report', $data);
    }
    
    // WIN/LOSE report for car roulette bet
    public function car_roulette_bet()
    {
        $data['title'] = 'Car Roulette Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_car_roulette_report();
        
        template('game_report/car_roulette_report', $data);
    }
    
    // WIN/LOSE report for color prediction bet
    public function color_prediction_bet()
    {
        $data['title'] = 'Color Prediction Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_color_prediction_report();
        
        template('game_report/color_prediction_report', $data);
    }
    
    // WIN/LOSE report for color prediction 1 min bet
    public function color_prediction_1min_bet()
    {
        $data['title'] = 'Color Prediction 1 Min Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_color_prediction_1min_report();
        
        template('game_report/color_prediction_1min_report', $data);
    }
    
    // WIN/LOSE report for color prediction 3 min bet
    public function color_prediction_3min_bet()
    {
        $data['title'] = 'Color Prediction 3 Min Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_color_prediction_3min_report();
        
        template('game_report/color_prediction_3min_report', $data);
    }
    
    // WIN/LOSE report for color prediction 3 min bet
    public function color_prediction_5min_bet()
    {
        $data['title'] = 'Color Prediction 5 Min Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_color_prediction_5min_report();
        
        template('game_report/color_prediction_5min_report', $data);
    }
    
    // WIN/LOSE report for dragon tiger bet
    public function dragon_tiger_bet()
    {
        $data['title'] = 'Dragon Tiger Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_dragon_tiger_bet();
        
        template('game_report/draon_tiger_report', $data);
    }
    
    // WIN/LOSE report for head_tails_bet
    public function head_tails_bet()
    {
        $data['title'] = 'Head Tails Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_head_tails_bet();
        
        template('game_report/head_tails_report', $data);
    }
    
    // WIN/LOSE reprt for jackpot_teenpatti_bet
    public function jackpot_teenpatti_bet()
    {
        $data['title'] = 'Jackport Teenpatti Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_jackpot_teenpatti_bet();
        
        template('game_report/jackpot_teenpatti_report', $data);
    }
    
    // WIN/LOSE report for jhandi munda bet
    public function jhandi_munda_bet()
    {
        $data['title'] = 'Jhandi Munda Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_jhandi_munda_bet();
        
        template('game_report/jhandi_munda_report', $data);
    }
    
    // WIN/LOSE report for poker_bet
    public function poker_bet()
    {
        $data['title'] = 'Poker Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_poker_bet();
        
        template('game_report/poker_report', $data);
    }
    
    // WIN/LOSE report for red_vs_black_bet
    public function red_vs_black_bet()
    {
        $data['title'] = 'Red vs Black Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_red_black_bet();
        
        template('game_report/red_vs_black_report', $data);
    }
    
    // WIN/LOSE report for roulette_bet
    public function roulette_bet()
    {
        $data['title'] = 'Rollet Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_roulette_bet();
        
        template('game_report/roulette_report', $data);
    }
    
    // WIN/LOSE report for rummy_point_bet
    public function rummy_point_bet()
    {
        $data['title'] = 'Rummy Point Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_rummy_point_bet();
        
        template('game_report/rummy_point_report', $data);
    }
    
    // WIN/LOSE report for rummy_pool_bet
    public function rummy_pool_bet()
    {
        $data['title'] = 'Rummy Pool Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_rummy_pool_bet();
        
        template('game_report/rummy_pool_report', $data);
    }
    
    // WIN/LOSE report for rummy_deal_bet
    public function rummy_deal_bet()
    {
        $data['title'] = 'Rummy Deal Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_rummy_deal_bet();
        
        template('game_report/rummy_deal_report', $data);
    }
    
    // WIN/LOSS report for seven up
    public function seven_up_bet()
    {
        $data['title'] = 'Seven Up Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_seven_up_bet();
        
        template('game_report/seven_up_report', $data);
    }
    
    // WIN/LOSE report for slot game bet
    public function slot_game_bet()
    {
        $data['title'] = 'Slot Game Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_slot_game_bet();
        
        template('game_report/slot_game_report', $data);    
    }
    
    // WIN/LOSE report for teenpatti_bet
    public function teenpatti_bet()
    {
        $data['title'] = 'Teenpatti Win / Lose Report';
        $data['report'] = $this->GameReport_model->get_teenpatti_bet();

        template('game_report/teenpatti_report', $data);
    }
}