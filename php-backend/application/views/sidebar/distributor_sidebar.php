<?php
    $actual_link = (($this->input->server('HTTPS') === 'on') ? "https" : "http") . "://" . $this->input->server('HTTP_HOST') . $this->input->server('REQUEST_URI');
    
    $final_url = str_replace(strtolower(base_url()), '', strtolower($actual_link));
    
    $permission = $this->session->userdata("subadmin") ? explode(",", $this->session->userdata("subadmin")) : [];
    // print_r($permission);
    
    $role = $this->session->userdata("role");
?>

<li>
    <a href="<?= base_url("backend/Agent" ) ?>" class="waves-effect">
        <i class="ion ion-md-contact"></i>
        <span>Agent Management</span>
    </a>
</li>

<li>
    <a href="<?= base_url("backend/Distributor/PaymentHistory") ?>" class="waves-effect"> 
        <i class="ion ion-md-list-box"></i>
        <span>Payment Logs</span>
    </a>
</li>

<!-- Payment Gateways -->
<li class="<?= strpos($final_url, "backend/Gateway/distributorGateway" ) !== false ? "mm-active" : "" ?>">
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="ti-layout-grid2-alt"></i>
        <span>Payment Gateways</span>
    </a>
    <ul class="sub-menu mm-collapse">
        <li class="<?= strpos($final_url,"backend/Gateway/distributorGateway") !== false ? "mm-active" : "" ?>">
            <a href="<?= base_url("backend/Gateway/distributorGateway") ?>" class="waves-effect">
                <span>All Gateways</span>
            </a>
        </li>
    </ul>
</li>

<!-- Withdraw Channel -->
<li class="<?= strpos($final_url,"backend/Gateway/distributorGatewayWithdraw") !== false ? "mm-active" : "" ?>">
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="ti-layout-grid2-alt"></i>
        <span>Withdraw Channel</span>
    </a>
    <ul class="sub-menu mm-collapse">
        <li class="<?= strpos($final_url,"backend/Gateway/distributorGatewayWithdraw") !== false ? "mm-active" : "" ?>">
            <a href="<?= base_url(
                "backend/Gateway/distributorGatewayWithdraw"
            ) ?>" class="waves-effect">
                <span>All Gateways Withdraw</span>
            </a>
        </li>
    </ul>
</li>

<!-- Deposit Channel -->
<li class="<?= strpos($final_url,"backend/Deposit/add") !== false ? "mm-active" : "" ?>">
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="ti-layout-grid2-alt"></i>
        <span>Deposits </span>
    </a>
    <ul class="sub-menu mm-collapse">
        <li class="<?= strpos($final_url,"backend/Deposit/add") !== false ? "mm-active": "" ?>">
            <a href="<?= base_url("backend/Deposit/add") ?>" class="waves-effect">
                <span>Request Deposit</span>
            </a>
        </li>
        <li class="<?= strpos($final_url,"backend/Deposit/indexDistributor") !== false ? "mm-active" : "" ?>">
            <a href="<?= base_url("backend/Deposit/indexDistributor") ?>" class="waves-effect">
                <span>Deposit From Agent</span>
            </a>
        </li>
    </ul>            
</li>