<?php
class Chips extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Chips_model','Gateway_model']);
    }

    public function index()
    {
        $data = [
            'title' => 'Deposit Chips Management',
            'AllChips' => $this->Chips_model->AllChipsList(),
        ];
    //     echo '<pre>';
    //    print_r($data);
    //    exit();
        if ($_ENV['ENVIRONMENT'] != 'demo') {
            $data['SideBarbutton'] = ['backend/Chips/add', 'Add Chips'];
        }
        template('chips/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Chips',
            'ManualGateways' => $this->Gateway_model->ManualGatway()
        ];
    //     echo '<pre>';
    //    print_r($data);
    //    exit();
        template('chips/add', $data);
    }

    public function edit($id)
    {
        $Chips = $this->Chips_model->ViewChips($id);
        $data = [
            'title' => 'Edit Chips',
            'Chips' => $Chips,
            'ManualGateways' => $this->Gateway_model->ManualGatway()
        ];
    //     echo '<pre>';
    //    print_r($data);
    //    exit();

        template('chips/edit', $data);
    }

    public function delete($id)
    {
        if ($this->Chips_model->Delete($id)) {
            $this->session->set_flashdata('msg', array('message' => 'Chips Removed Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/Chips');
    }

    public function insert()
    {
        
        $data = [
            'coin' => $this->input->post('coin'),
            'price' => $this->input->post('price'),
            'title' => $this->input->post('title'),
            'added_date' => date('Y-m-d H:i:s')
        ];
        // Retrieve selected subadmins as an array
        $subadmins = $this->input->post('payment_method_id');
        // Check if $subadmins is an array before using it
        if (is_array($subadmins)) {
            // Convert array of subadmins into comma-separated string
            $subadminString = implode(',', $subadmins);
            // Add subadmins to the data array
            $data['payment_method_id'] = $subadminString;
        }
        $Chips = $this->Chips_model->AddChips($data);
        if ($Chips) {
            $this->session->set_flashdata('msg', array('message' => 'Chips Added Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/Chips');
    }

    public function update()
    {
        $data = [
            'coin' => $this->input->post('coin'),
            'price' => $this->input->post('price'),
            'title' => $this->input->post('title'),
            'updated_date' => date('Y-m-d H:i:s')
        ];
        // Retrieve selected subadmins as an array
        $subadmins = $this->input->post('payment_method_id');
        // Check if $subadmins is an array before using it
        if (is_array($subadmins)) {
            // Convert array of subadmins into comma-separated string
            $subadminString = implode(',', $subadmins);
            // Add subadmins to the data array
            $data['payment_method_id'] = $subadminString;
        }
    //             echo '<pre>';
    //    print_r($data);
    //    exit();
        $Chips = $this->Chips_model->UpdateChips($data, $this->input->post('id'));
        if ($Chips) {
            $this->session->set_flashdata('msg', array('message' => 'Chips Wallet Updated Successfully', 'class' => 'success', 'position' => 'top-right'));
        } else {
            $this->session->set_flashdata('msg', array('message' => 'Somthing Went Wrong', 'class' => 'error', 'position' => 'top-right'));
        }
        redirect('backend/Chips');
    }
}
