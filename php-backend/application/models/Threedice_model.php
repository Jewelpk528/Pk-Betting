<?php

class Threedice_model extends MY_Model
{
    public function getRoom($RoomId = '', $user_id = '')
    {
        $this->db->from('tbl_three_dice_room');
        $this->db->where('isDeleted', false);
        if (!empty($RoomId)) {
            $this->db->where('id', $RoomId);
        }
        $this->db->order_by('id', 'asc');
        $Query = $this->db->get();

        $this->db->set('three_dice_room_id', $RoomId);
        $this->db->where('id', $user_id);
        $this->db->update('tbl_users');

        return $Query->result();
    }

    public function leave_room($user_id = '')
    {
        $this->db->set('three_dice_room_id', '');
        $this->db->where('id', $user_id);
        $this->db->update('tbl_users');

        return $this->db->last_query();
    }

    public function getRoomOnline($RoomId)
    {
        $Query = $this->db->query('SELECT COUNT(`id`) as online FROM `tbl_three_dice_bet` WHERE `three_dice_id` = (SELECT `id` FROM `tbl_three_dice` WHERE `room_id`=' . $RoomId . ' ORDER BY `id` DESC LIMIT 1)');
        return $Query->row()->online;
    }

    public function getRoomOnlineUser($RoomId)
    {
        $Query = $this->db->query('SELECT * FROM `tbl_users` WHERE three_dice_room_id = ' . $RoomId);
        return $Query->result();
    }

    public function getActiveGameOnTable($RoomId = '')
    {
        $this->db->from('tbl_three_dice');
        if (!empty($RoomId)) {
            $this->db->where('room_id', $RoomId);
        }
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        return $this->db->get()->result();
    }

    public function ViewBet($user_id = '', $three_dice_id = '', $bet = '', $bet_id = '', $limit = '')
    {
        $this->db->from('tbl_three_dice_bet');

        if (!empty($user_id)) {
            $this->db->where('user_id', $user_id);
        }

        if (!empty($three_dice_id)) {
            $this->db->where('three_dice_id', $three_dice_id);
        }

        if ($bet !== '') {
            if (is_array($bet)) {
                $this->db->where_in('bet', $bet);
            } elseif (is_numeric($bet)) {
                $this->db->where('bet', $bet);
            }
        }

        if (!empty($bet_id)) {
            $this->db->where('id', $bet_id);
        }

        if (!empty($limit)) {
            $this->db->limit($limit);
        }

        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }

    public function AllGames()
    {
        $this->db->from('tbl_three_dice');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(10);
        return $this->db->get()->result();
    }

    public function getRandomFlag($column)
    {
        $this->db->select($column);
        $this->db->from('tbl_setting');
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->row();
    }

    public function ChangeStatus()
    {
        $this->db->set('three_dice_random', $this->input->post('type'));
        return $this->db->update('tbl_setting');
    }

    public function getUserName($user_id)
    {
        $this->db->select('name');
        $this->db->from('tbl_users');
        $this->db->where('id', $user_id);
        $user = $this->db->get()->row();
        return $user ? $user->name : '';
    }
}
