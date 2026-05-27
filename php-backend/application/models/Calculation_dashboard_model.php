<?php
class Calculation_dashboard_model extends CI_Model
{

    // User Add Amount (wallet total)
   // User Add Amount (wallet total add)
    public function get_user_add_amount($start, $end)
    {
        $this->db->select_sum('coin');
        if(!empty($start)) {
            $this->db->where('added_date >=', $start . ' 00:00:00');
        }
        if(!empty($end)) {
            $this->db->where('added_date <=', $end . ' 23:59:59');
        }
        $query = $this->db->get('tbl_wallet_log');
        $row = $query->row();

        return $row ? $row->coin : 0;
    }


    // User Subtract Amount (same wallet log for now)
    public function get_user_sub_amount($start, $end)
    {
       $this->db->select_sum('coin');
        $this->db->where('coin <', 0);
        if(!empty($start)) {
            $this->db->where('added_date >=', $start . ' 00:00:00');
        }
        if(!empty($end)) {
            $this->db->where('added_date <=', $end . ' 23:59:59');
        }
        $query = $this->db->get('tbl_wallet_log');

        $row = $query->row();
        return $row ? $row->coin : 0;
    }

    // Total Game Play Amount
   public function get_total_game_amount($start, $end)
    {
        $total = 0;

        $tables = [
            'tbl_ander_baher_bet',
            'tbl_dragon_tiger_bet',
            'tbl_aviator_bet',
            'tbl_animal_roulette_bet',
            'tbl_baccarat_bet',
            'tbl_car_roulette_bet',
            'tbl_color_prediction_1_min_bet',
            'tbl_color_prediction_3_min_bet',
            'tbl_color_prediction_5_min_bet',
            'tbl_color_prediction_bet',
            'tbl_dragon_tiger_bet',
            'tbl_golden_wheel_bet',
            'tbl_head_tail_bet',
            'tbl_icon_roulette_bet',
            'tbl_jackpot_bet',
            'tbl_jhandi_munda_bet',
            'tbl_lottery_bet',
            'bl_red_black_bet',
            'tbl_roulette_bet',
            'tbl_roulette_temp_bet',
            'tbl_seven_up_bet',
            'tbl_slot_game_bet',
            'tbl_target_bet',
            'tbl_three_dice_bet',
            'tbl_tripple_fun_bet'
            
        ];

        foreach ($tables as $table) {

            if ($this->db->table_exists($table)) {

                $this->db->select_sum('amount');
                if(!empty($start)) {
                    $this->db->where('added_date >=', $start . ' 00:00:00');
                }
                if(!empty($end)) {
                    $this->db->where('added_date <=', $end . ' 23:59:59');
                }
                $query = $this->db->get($table);
                $row = $query->row();

                if ($row && $row->amount) {
                    $total += $row->amount;
                }
            }
        }

        return $total;
    }

    // Admin Profit
    public function get_admin_profit($start, $end)
    {
        $this->db->select_sum('admin_commission');
        if(!empty($start)) {
            $this->db->where('added_date >=', $start . ' 00:00:00');
        }
        if(!empty($end)) {
            $this->db->where('added_date <=', $end . ' 23:59:59');
        }
        $query = $this->db->get('tbl_admin_profit_statement');

        $row = $query->row();
        $total = $row ? ($row->admin_commission ?? 0) : 0;
        return round($total, 2);
    }

}