<?php
class Chips_model extends MY_Model
{

    public function AllChipsList_old()
    {
        $this->db->select('tbl_coin_plan.*');
        $this->db->from('tbl_coin_plan');
        $this->db->where('tbl_coin_plan.isDeleted', false);
        $this->db->order_by('tbl_coin_plan.id', 'desc');
        $Query = $this->db->get();
        return $Query->result();
    }

    public function AllChipsList()
    {
        // Step 1: Fetch all gateways and index by ID
        $gateways = $this->db->get_where('tbl_gateway', ['isDeleted' => 0])->result();
        $gatewayMap = [];
        foreach ($gateways as $gateway) {
            $gatewayMap[$gateway->id] = $gateway->name;
        }
    
        // Step 2: Fetch coin plans
        $this->db->select('*');
        $this->db->from('tbl_coin_plan');
        $this->db->where('isDeleted', false);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        $coinPlans = $query->result();
    
        // Step 3: Map gateway names
        foreach ($coinPlans as &$plan) {
            $ids = explode(',', $plan->payment_method_id);
            $names = [];
            foreach ($ids as $id) {
                $id = trim($id);
                if (isset($gatewayMap[$id])) {
                    $names[] = $gatewayMap[$id];
                }
            }
            $plan->gateway_names = implode(', ', $names);
        }
    
        return $coinPlans;
    }
    

    public function ViewChips($id)
    {
        $Query = $this->db->where('isDeleted', False)
            ->where('id', $id)
            ->get('tbl_coin_plan');
        return $Query->row();
    }
    
    public function AddChips($data)
    {
        $this->db->insert('tbl_coin_plan', $data);
        return $this->db->insert_id();
    }

    public function Delete($id)
    {
        $data = [
            'isDeleted' => TRUE,
            'updated_date' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_coin_plan', $data);
        return $this->db->last_query();
    }

    public function UpdateChips($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_coin_plan', $data);
        return $this->db->last_query();
    }
}
