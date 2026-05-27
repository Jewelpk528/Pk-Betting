<?php

class GameReport_model extends MY_Model
{
    public function get_aviator_report()
    {
        $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(p.total_deposit, 0) AS total_deposit,
            IFNULL(w.total_withdrawal, 0) AS total_withdrawal
        ");

        $this->db->from('tbl_aviator_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_aviator a', 'a.id = b.aviator_id');

        // Join with total deposit
        $this->db->join('(
            SELECT user_id, SUM(price) AS total_deposit
            FROM tbl_purchase
            WHERE status = 1 AND isDeleted = 0
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join with total withdrawal
        $this->db->join('(
            SELECT user_id, SUM(price) AS total_withdrawal
            FROM tbl_withdrawal_log
            WHERE status = 1 AND isDeleted = 0
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_ander_baher_report()
    {
        $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(p.total_deposit, 0) AS total_deposit,
            IFNULL(w.total_withdrawal, 0) AS total_withdrawal
        ");

        $this->db->from('tbl_ander_baher_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_ander_baher a', 'a.id = b.ander_baher_id');

        // Join with total deposit (purchase)
        $this->db->join('(
            SELECT user_id, SUM(price) AS total_deposit
            FROM tbl_purchase
            WHERE status = 1 AND isDeleted = 0
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join with total withdrawal
        $this->db->join('(
            SELECT user_id, SUM(price) AS total_withdrawal
            FROM tbl_withdrawal_log
            WHERE status = 1 AND isDeleted = 0
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_animal_roulette_report()
    {
        $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(p.total_deposit, 0) AS total_deposit,
            IFNULL(w.total_withdrawal, 0) AS total_withdrawal
        ");

        $this->db->from('tbl_animal_roulette_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_animal_roulette a', 'a.id = b.animal_roulette_id');

        // Join with total deposit (purchase)
        $this->db->join('(
            SELECT user_id, SUM(price) AS total_deposit
            FROM tbl_purchase
            WHERE status = 1 AND isDeleted = 0
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join with total withdrawal
        $this->db->join('(
            SELECT user_id, SUM(price) AS total_withdrawal
            FROM tbl_withdrawal_log
            WHERE status = 1 AND isDeleted = 0
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_icon_roulette_report()
    {
        $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(p.total_deposit, 0) AS total_deposit,
            IFNULL(w.total_withdrawal, 0) AS total_withdrawal
        ");
        
        $this->db->from('tbl_icon_roulette_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_icon_roulette a', 'a.id = b.icon_roulette_id');

        // Join deposit (purchase) data
        $this->db->join('(
            SELECT user_id, SUM(price) AS total_deposit
            FROM tbl_purchase
            WHERE status = 1 AND isDeleted = 0
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal data
        $this->db->join('(
            SELECT user_id, SUM(price) AS total_withdrawal
            FROM tbl_withdrawal_log
            WHERE status = 1 AND isDeleted = 0
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_baccarat_report()
    {
        $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(p.total_deposit, 0) AS total_deposit,
            IFNULL(w.total_withdrawal, 0) AS total_withdrawal
        ");
        
        $this->db->from('tbl_baccarat_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_baccarat a', 'a.id = b.baccarat_id');

        // Join deposit (purchase) data
        $this->db->join('(
            SELECT user_id, SUM(price) AS total_deposit
            FROM tbl_purchase
            WHERE status = 1 AND isDeleted = 0
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal data
        $this->db->join('(
            SELECT user_id, SUM(price) AS total_withdrawal
            FROM tbl_withdrawal_log
            WHERE status = 1 AND isDeleted = 0
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_car_roulette_report()
    {
        $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_car_roulette_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_car_roulette a', 'a.id = b.car_roulette_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_color_prediction_report()
    {
        $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_color_prediction_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_color_prediction a', 'a.id = b.color_prediction_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_color_prediction_1min_report()
    {
        $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_color_prediction_1_min_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_color_prediction_1_min a', 'a.id = b.color_prediction_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_color_prediction_3min_report()
    {
        $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_color_prediction_3_min_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_color_prediction_3_min a', 'a.id = b.color_prediction_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_color_prediction_5min_report()
    {
        $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_color_prediction_5_min_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_color_prediction_5_min a', 'a.id = b.color_prediction_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_dragon_tiger_bet()
    {
        $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_dragon_tiger_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_dragon_tiger a', 'a.id = b.dragon_tiger_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_head_tails_bet()
    {
        $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_head_tail_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_head_tail a', 'a.id = b.head_tail_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_jackpot_teenpatti_bet()
    {
        $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_jackpot_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_jackpot a', 'a.id = b.jackpot_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_jhandi_munda_bet()
    {
         $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_jhandi_munda_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_jhandi_munda a', 'a.id = b.jhandi_munda_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }   

    public function get_poker_bet()
    {
         $this->db->select("
            u.name,
            b.winner_id,
            SUM(b.amount) AS total_bet,
            SUM(b.user_winning_amt) AS total_winning,
            SUM(b.user_winning_amt - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_poker b');
        $this->db->join('tbl_users u', 'u.id = b.winner_id');
        $this->db->join('tbl_poker_table a', 'a.id = b.poker_table_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.winner_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.winner_id', 'left');

        $this->db->group_by('b.winner_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_red_black_bet()
    {
         $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_red_black_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_red_black a', 'a.id = b.red_black_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_roulette_bet()
    {
         $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_roulette_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_roulette a', 'a.id = b.roulette_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_rummy_point_bet()
    {
         $this->db->select("
            u.name,
            b.winner_id,
            SUM(b.amount) AS total_bet,
            SUM(b.user_winning_amt) AS total_winning,
            SUM(b.user_winning_amt - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_rummy b');
        $this->db->join('tbl_users u', 'u.id = b.winner_id');
        // $this->db->join('tbl_game_log a', 'a.id = b.table_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.winner_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.winner_id', 'left');

        $this->db->group_by('b.winner_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_rummy_pool_bet()
    {
         $this->db->select("
            u.name,
            b.winner_id,
            SUM(b.amount) AS total_bet,
            SUM(b.user_winning_amt) AS total_winning,
            SUM(b.user_winning_amt - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_rummy_pool b');
        $this->db->join('tbl_users u', 'u.id = b.winner_id');
        // $this->db->join('tbl_game_log a', 'a.id = b.table_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.winner_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.winner_id', 'left');

        $this->db->group_by('b.winner_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_rummy_deal_bet()
    {
         $this->db->select("
            u.name,
            b.winner_id,
            SUM(b.amount) AS total_bet,
            SUM(b.user_winning_amt) AS total_winning,
            SUM(b.user_winning_amt - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_rummy_deal b');
        $this->db->join('tbl_users u', 'u.id = b.winner_id');
        // $this->db->join('tbl_game_log a', 'a.id = b.table_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.winner_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.winner_id', 'left');

        $this->db->group_by('b.winner_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_seven_up_bet()
    {
         $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_seven_up_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_seven_up a', 'a.id = b.seven_up_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_slot_game_bet()
    {
         $this->db->select("
            u.name,
            b.user_id,
            SUM(b.amount) AS total_bet,
            SUM(b.winning_amount) AS total_winning,
            SUM(b.winning_amount - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_slot_game_bet b');
        $this->db->join('tbl_users u', 'u.id = b.user_id');
        $this->db->join('tbl_slot_game a', 'a.id = b.slot_game_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.user_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.user_id', 'left');

        $this->db->group_by('b.user_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
    
    public function get_teenpatti_bet()
    {
         $this->db->select("
            u.name,
            b.winner_id,
            SUM(b.amount) AS total_bet,
            SUM(b.user_winning_amt) AS total_winning,
            SUM(b.user_winning_amt - b.amount) AS net_result,
            IFNULL(SUM(p.price), 0) AS total_deposit,
            IFNULL(SUM(w.price), 0) AS total_withdrawal
        ");
        $this->db->from('tbl_game b');
        $this->db->join('tbl_users u', 'u.id = b.winner_id');
        $this->db->join('tbl_game_log a', 'a.id = b.table_id');

        // Join deposit table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_purchase 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) p', 'p.user_id = b.winner_id', 'left');

        // Join withdrawal table using `price`
        $this->db->join('(
            SELECT user_id, SUM(price) AS price 
            FROM tbl_withdrawal_log 
            WHERE status = 1 AND isDeleted = 0 
            GROUP BY user_id
        ) w', 'w.user_id = b.winner_id', 'left');

        $this->db->group_by('b.winner_id');
        $this->db->order_by('net_result', 'DESC');

        return $this->db->get()->result();
    }
}