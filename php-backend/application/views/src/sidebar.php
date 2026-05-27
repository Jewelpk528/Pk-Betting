<?php
    $actual_link = (($this->input->server('HTTPS') === 'on') ? "https" : "http") . "://" . $this->input->server('HTTP_HOST') . $this->input->server('REQUEST_URI');
    
    $final_url = str_replace(strtolower(base_url()), '', strtolower($actual_link));
    
    $permission = $this->session->userdata("subadmin") ? explode(",", $this->session->userdata("subadmin")) : [];
    // print_r($permission);
    
    $role = $this->session->userdata("role");
?>

<div class="left side-menu">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">

                <li>
                    <a href="<?= base_url('backend/dashboard/admin') ?>" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                <a href="<?php echo base_url('backend/calculation_dashboard'); ?>">
                    <i class="fa fa-calculator"></i>
                    <span>Calculation Dashboard</span>
                </a>
            </li>

                <!-- Sidebar for different user roles -->
                <?php if ($role == SUPERADMIN || $role == SUBADMIN): ?>
                    <?php $this->load->view('sidebar/admin_sidebar'); ?>
                <?php elseif ($role == DISTRIBUTOR): ?>
                    <?php $this->load->view('sidebar/distributor_sidebar'); ?>
                <?php elseif ($role == ROLEAGENT): ?>
                    <?php $this->load->view('sidebar/agent_sidebar'); ?>
                <?php endif; ?>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title"><?= $title ?></h4>

                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-md-block">
                            <?php

                                if (isset($SideBarbutton) && isset($SideBarbutton[1])) {
                                    ?>

                                <a href="<?= base_url($SideBarbutton[0]) ?>"
                                    class="btn btn-primary btn-lg btn-dashboard custom-btn">
                                    <?= $SideBarbutton[1] ?></a>

                            <?php
                                } ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->