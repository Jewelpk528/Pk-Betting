<?php
    $actual_link = (($this->input->server('HTTPS') === 'on') ? "https" : "http") . "://" . $this->input->server('HTTP_HOST') . $this->input->server('REQUEST_URI');
    
    $final_url = str_replace(strtolower(base_url()), '', strtolower($actual_link));
    
    $permission = $this->session->userdata("subadmin") ? explode(",", $this->session->userdata("subadmin")) : [];
    // print_r($permission);
    
    $role = $this->session->userdata("role");
?>

<!-- ################### Agent login Sidebar ############# -->
<li class="<?= (array_filter([strpos($final_url, "backend/AgentUser")], 'is_numeric')) ? 'mm-active' : '' ?>">
    <a href="<?= base_url('backend/AgentUser') ?>" class="waves-effect">
        <i class="ion ion-md-contact"></i>
        <span>Users</span>
    </a>
</li>
<li class="<?= (array_filter([strpos($final_url, "backend/chats")], 'is_numeric')) ? 'mm-active' : '' ?>">
    <a href="<?= base_url('backend/Chats') ?>" class="waves-effect">
        <i class="ion ion-md-contact"></i>
        <span>Chats</span>
    </a>
</li>
<li class="<?= (array_filter([strpos($final_url, "backend/AgentUserPaymentLog")], 'is_numeric')) ? 'mm-active' : '' ?>">
    <a href="<?= base_url('backend/AgentUserPaymentLog') ?>" class="waves-effect">
        <i class="ion ion-md-contact"></i>
        <span>Payment Logs</span></a>
</li>
<li>
    <a href="<?= base_url('backend/Purchase') ?>" class="waves-effect">
    <i class="ion ion-md-contact"></i> 
        <span>Purchase History</span>
    </a>
</li>
<li>
    <a href="<?= base_url('backend/WithdrawalLog') ?>" class="waves-effect">
        <i class="ion ion-md-list-box"></i> 
        <span>Withdrawal Log</span>
    </a>
</li>

<li class="<?= (array_filter([strpos($final_url, "backend/agent/Settings")], 'is_numeric')) ? 'mm-active' : '' ?>">
    <a href="<?= base_url('backend/agent/Settings') ?>" class="waves-effect">
        <i class="ion ion-md-list-box"></i>
        <span>Settings</span>   
    </a>
</li>

<!-- Payment Gateways -->
<li class="<?= (strpos($final_url, "backend/Gateway/agentGateway") !== false) ? 'mm-active' : '' ?>">
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="ti-layout-grid2-alt"></i>
        <span>Payment Gateways</span>
    </a>
    <ul class="sub-menu mm-collapse">
        <li
            class="<?= (strpos($final_url, "backend/Gateway/agentGateway") !== false) ? 'mm-active' : '' ?>">
            <a href="<?= base_url('backend/Gateway/agentGateway') ?>" class="waves-effect">
                <span>All Gateways</span>
            </a>
        </li>
    </ul>
</li>

<!-- Withdraw Channel -->
<li class="<?= (strpos($final_url, "backend/Gateway/agentGatewayWithdraw") !== false) ? 'mm-active' : '' ?>">
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="ti-layout-grid2-alt"></i>
        <span>Withdraw Channel</span>
    </a>
    <ul class="sub-menu mm-collapse">
        <li class="<?= (strpos($final_url, "backend/Gateway/agentGatewayWithdraw") !== false) ? 'mm-active' : '' ?>">
            <a href="<?= base_url('backend/Gateway/agentGatewayWithdraw') ?>" class="waves-effect">
                <span>All Gateways Withdraw</span>
            </a>
        </li>
    </ul>
</li>

<li class="<?= (strpos($final_url, "backend/Deposit/addToDistributor") !== false) ? 'mm-active' : '' ?>">
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="ti-layout-grid2-alt"></i>
        <span>Deposits </span>
    </a>
    <ul class="sub-menu mm-collapse">
        <li
            class="<?= (strpos($final_url, "backend/Deposit/addToDistributor") !== false) ? 'mm-active' : '' ?>">
            <a href="<?= base_url('backend/Deposit/addToDistributor') ?>" class="waves-effect">
                <span>Request Deposit</span>
            </a>
        </li>
    </ul>
</li>