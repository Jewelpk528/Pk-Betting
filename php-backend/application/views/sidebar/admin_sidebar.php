<?php
$actual_link = (($this->input->server('HTTPS') === 'on') ? "https" : "http") . "://" . $this->input->server('HTTP_HOST') . $this->input->server('REQUEST_URI');

$final_url = str_replace(strtolower(base_url()), '', strtolower($actual_link));

$permission = $this->session->userdata("subadmin") ? explode(",", $this->session->userdata("subadmin")) : [];
// print_r($permission);

$role = $this->session->userdata("role");
?>

<?php if ($role == SUPERADMIN || in_array('APP_USER_MANAGEMENT', $permission)) { ?>
    <li class="<?= ((stripos($final_url, "backend/user") !== false && stripos($final_url, "AllLadgerReports") === false) || stripos($final_url, "backend/usercategory") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript:void(0);" class="has-arrow waves-effect">
            <i class="ion ion-md-contact"></i>
            <span>App User Mgmt.</span>
        </a>

        <ul class="sub-menu mm-collapse">
            <li class="<?= (stripos($final_url, "backend/user") !== false && stripos($final_url, "AllLadgerReports") === false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/user') ?>" class="waves-effect">
                    <span>Users</span>
                </a>
            </li>

            <!-- <li class="<?= (strpos($final_url, "backend/kyc") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/Kyc') ?>" class="waves-effect">
                    <span>KYC</span>
                </a>
            </li> -->

            <!-- Uncomment if needed -->
            <!-- <li class="<?= (strpos($final_url, "backend/BankDetails") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/BankDetails') ?>" class="waves-effect">
                    <span>Bank/Crypto Details</span>
                </a>
            </li> -->
        </ul>
    </li>
<?php } ?>


<?php if ($role == SUPERADMIN || in_array('ADMIN_USER_MANAGEMENT', $permission)) { ?>
    <li
        class="<?= (strpos($final_url, "backend/SubAdmin") !== false || strpos($final_url, "backend/Distributor") !== false || strpos($final_url, "backend/Agent") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript:void(0);" class="has-arrow waves-effect">
            <i class="ion ion-md-contact"></i>
            <span>Admin Users Mgmt.</span>
        </a>
        <ul class="sub-menu mm-collapse">

            <?php if (defined('SUB_ADMIN_MANAGEMENT') && SUB_ADMIN_MANAGEMENT == true && ($role == SUPERADMIN || in_array('ADMIN_USER_MANAGEMENT', $permission))) { ?>
                <li class="<?= (strpos($final_url, "backend/SubAdmin") !== false) ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('backend/SubAdmin') ?>" class="waves-effect">
                        <span>Sub-Admin Mgmt.</span>
                    </a>
                </li>
            <?php } ?>

            <?php if (defined('AGENT') && AGENT == true && ($role == SUPERADMIN || in_array('ADMIN_USER_MANAGEMENT', $permission))) { ?>
                <li class="<?= (strpos($final_url, "backend/Distributor") !== false) ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('backend/Distributor') ?>" class="waves-effect">
                        <span>Dist. Management</span>
                    </a>
                </li>
            <?php } ?>

            <?php if (defined('AGENT') && AGENT == true && ($role == SUPERADMIN || in_array('ADMIN_USER_MANAGEMENT', $permission))) { ?>
                <li class="<?= (strpos($final_url, "backend/Agent") !== false) ? 'mm-active' : '' ?>">
                    <a href="<?= base_url('backend/Agent') ?>" class="waves-effect">
                        <span>Agent Management</span>
                    </a>
                </li>
            <?php } ?>

        </ul>
    </li>
<?php } ?>


<?php if ($role == SUPERADMIN || in_array('PAYMENT_MANAGEMENT', $permission)) { ?>
    <li
        class="<?= (array_filter([strpos($final_url, "backend/report")], 'is_numeric')) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Payment Mgmt.</span>
        </a>

        <ul class="sub-menu mm-collapse">
            <!-- <?php if (WITHDRAWAL_LOG == true && ($role == SUPERADMIN || in_array('PAYMENT_MANAGEMENT', $permission))) { ?>
                <li><a href="<?= base_url('backend/DepositPercentage') ?>" class="waves-effect">
                        <span>Deposit Percentage</span>
                    </a></li>
            <?php } ?> -->

            <?php if (WITHDRAWAL_LOG == true && ($role == SUPERADMIN || in_array('PAYMENT_MANAGEMENT', $permission))) { ?>
                <li><a href="<?= base_url('backend/Gateway/manual') ?>" class="waves-effect"><span>Payment Methods</span></a></li>
            <?php } ?>

            <!-- <?php if (WITHDRAWAL_LOG == true && ($role == SUPERADMIN || in_array('PAYMENT_MANAGEMENT', $permission))) { ?>
                <li><a href="<?= base_url('backend/Deposit') ?>" class="waves-effect"><span>Deposit</span></a></li>
            <?php } ?> -->

            <?php if (CHIPS_MANAGEMENT == true && ($role == SUPERADMIN || in_array('PAYMENT_MANAGEMENT', $permission))) { ?>
                <li><a href="<?= base_url('backend/chips') ?>" class="waves-effect">
                        <span>Deposit Chips Mgmt.</span></a></li>
            <?php } ?>

            <?php if (PURCHASE_HISTORY == true && ($role == SUPERADMIN || in_array('PAYMENT_MANAGEMENT', $permission))) { ?>
                <li><a href="<?= base_url('backend/Purchase') ?>" class="waves-effect"><span>Deposit
                            History</span></a></li>
            <?php } ?>

            <?php if (REEDEM_MANAGEMENT == true && ($role == SUPERADMIN || in_array('PAYMENT_MANAGEMENT', $permission))) { ?>
                <li><a href="<?= base_url('backend/WithdrawalLog/ReedemNow') ?>" class="waves-effect">
                        <span>Withdraw Chips Mgmt.</span></a></li>
            <?php } ?>

            <?php if (WITHDRAWAL_LOG == true && ($role == SUPERADMIN || in_array('PAYMENT_MANAGEMENT', $permission))) { ?>
                <li><a href="<?= base_url('backend/WithdrawalLog') ?>" class="waves-effect"><span>Withdrawal
                            History</span></a></li>
            <?php } ?>
        </ul>
    </li>
<?php } ?>


<?php
$games = [
    'AVIATOR',
    'AVIATOR_VERTICAL',
    'ANDER_BAHAR',
    'ANIMAL_ROULETTE',
    'BACCARAT',
    'CAR_ROULETTE',
    'COLOR_PREDICTION',
    'COLOR_PREDICTION_VERTICAL',
    'DRAGON_TIGER',
    'HEAD_TAILS',
    'ICON_ROULETTE',
    'JACKPOT',
    'JHANDI_MUNDA',
    'POKER',
    'RED_VS_BLACK',
    'ROULETTE',
    'POINT_RUMMY',
    'RUMMY_POOL',
    'RUMMY_DEAL',
    'RUMMY_TOURNAMENT',
    'SEVEN_UP_DOWN',
    'SLOT',
    'TEENPATTI',
    'TEENPATTI',
];

$show_games_menu = false;

foreach ($games as $game) {
    if (defined($game) && constant($game) == true && ($role == SUPERADMIN || in_array($game, $permission))) {
        $show_games_menu = true;
        break;
    }
}

if ($show_games_menu || ($role == SUPERADMIN || in_array('TRIPAL_FUN', $permission)) || ($role == SUPERADMIN || in_array('THREE_DICE', $permission))) {
    ?>
    <li class="menu-title" style="color:white">Games</li>
<?php
}
?>


<?php if ((AVIATOR == true || AVIATOR_VERTICAL == true) && ($role == SUPERADMIN || in_array('AVIATOR', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/aviator") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Aviator</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/Aviator") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/Aviator') ?>" class="waves-effect">
                    <span>Aviator History</span></a>
            </li>
        </ul>
    </li>
<?php } ?>

<?php if (ANDER_BAHAR == true && ($role == SUPERADMIN || in_array('ANDER_BAHAR', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/andarbahar") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Andar Bahar</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/AnderBahar") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/AnderBahar') ?>" class="waves-effect">
                    <span>Andar Bahar History</span></a>
            </li>
        </ul>
    </li>
<?php } ?>

<?php if (ANDER_BAHAR_PLUS == true && ($role == SUPERADMIN || in_array('ANDER_BAHAR_PLUS', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/andarbaharplus") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Andar Bahar Plus</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/AnderBaharPlus") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/AnderBaharPlus') ?>" class="waves-effect">
                    <span>Andar Bahar Plus History</span></a>
            </li>
        </ul>
    </li>
<?php } ?>

<?php if (ANIMAL_ROULETTE == true && ($role == SUPERADMIN || in_array('ANIMAL_ROULETTE', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/animalroulette") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Animal Roulette</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/AnimalRoulette") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/AnimalRoulette') ?>" class="waves-effect">
                    <span>Animal Roulette History</span></a>
            </li>
        </ul>
    </li>
<?php } ?>

<?php if (BACCARAT == true && ($role == SUPERADMIN || in_array('BACCARAT', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/baccarat") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Baccarat</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/Baccarat") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/Baccarat') ?>" class="waves-effect">
                    <span>Baccarat History</span></a>
            </li>
        </ul>
    </li>
<?php } ?>

<?php if (CAR_ROULETTE == true && ($role == SUPERADMIN || in_array('CAR_ROULETTE', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/carroulette") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Car Roulette</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/CarRoulette") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/CarRoulette') ?>" class="waves-effect">
                    <span>Car Roulette History</span></a>
            </li>
        </ul>
    </li>
<?php } ?>

<?php if ((COLOR_PREDICTION == true || COLOR_PREDICTION_VERTICAL == true) && ($role == SUPERADMIN || in_array('COLOR_PREDICTION', $permission))) { ?>
    <li class="<?= (strpos($final_url, "backend/ColorPrediction") !== false || strpos($final_url, "backend/colorPrediction1Min") !== false || strpos($final_url, "backend/colorPrediction3Min") !== false || strpos($final_url, "backend/colorPrediction5Min") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Color Prediction</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li class="<?= (strpos($final_url, "backend/ColorPrediction") !== false && strpos($final_url, "backend/colorPrediction1Min") === false && strpos($final_url, "backend/colorPrediction3Min") === false && strpos($final_url, "backend/colorPrediction5Min") === false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/ColorPrediction') ?>" class="waves-effect">
                    <span>Color Prediction 15 Sec</span>
                </a>
            </li>
            <li class="<?= strpos($final_url, "backend/colorPrediction1Min") !== false ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/colorPrediction1Min') ?>" class="waves-effect">
                    <span>Color Prediction 1 Min</span>
                </a>
            </li>
            <li class="<?= strpos($final_url, "backend/colorPrediction3Min") !== false ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/colorPrediction3Min') ?>" class="waves-effect">
                    <span>Color Prediction 3 Min</span>
                </a>
            </li>
            <li class="<?= strpos($final_url, "backend/colorPrediction5Min") !== false ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/colorPrediction5Min') ?>" class="waves-effect">
                    <span>Color Prediction 5 Min</span>
                </a>
            </li>
        </ul>
    </li>
<?php } ?>


<?php if (DRAGON_TIGER == true && ($role == SUPERADMIN || in_array('DRAGON_TIGER', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/dragontiger") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Dragon Tiger</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/DragonTiger") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/DragonTiger') ?>" class="waves-effect">
                    <span>Dragon Tiger History</span></a>
            </li>
        </ul>
    </li>
<?php } ?>

<?php if (HEAD_TAILS == true && ($role == SUPERADMIN || in_array('HEAD_TAILS', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/headtails") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Head & Tail</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/HeadTails") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/HeadTails') ?>" class="waves-effect">
                    <span>Head & Tail History</span></a>
            </li>
        </ul>
    </li>
<?php } ?>

<!-- <?php if (ICON_ROULETTE == true && ($role == SUPERADMIN || in_array('ICON_ROULETTE', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/iconroulette") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Icon Roulette</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/IconRoulette") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/IconRoulette') ?>" class="waves-effect">
                    <span>Icon Roulette History</span></a>
            </li>
        </ul>
    </li>
<?php } ?> -->

<?php if (JACKPOT == true && ($role == SUPERADMIN || in_array('JACKPOT_TEENPATTI', $permission))) { ?>
    <?php $isJackpotActive = (strpos($final_url, "backend/Jackpot") !== false);?>
    <li class="<?= $isJackpotActive ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Jackpot TeenPatti</span>
        </a>
        <ul class="sub-menu mm-collapse" style="<?= $isJackpotActive ? 'display:block;' : '' ?>">
            <li class="<?= ($final_url == base_url('backend/Jackpot')) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/Jackpot') ?>" class="waves-effect">
                    <span>Jackpot TeenPatti History</span>
                </a>
            </li>
        </ul>
    </li>
<?php } ?>

<?php if (JHANDI_MUNDA == true && ($role == SUPERADMIN || in_array('JHANDI_MUNDA', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/jhandimunda") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Jhandi Munda</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/JhandiMunda") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/JhandiMunda') ?>" class="waves-effect">
                    <span>Jhandi Munda History</span></a>
            </li>
        </ul>
    </li>
<?php } ?>

<?php if (POKER == true && ($role == SUPERADMIN || in_array('POKER', $permission))) { ?>
    <li class="<?= (strpos($final_url, "backend/poker") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Poker</span>
        </a>

        <ul class="sub-menu mm-collapse">
            <li class="<?= (strpos($final_url, "backend/PokerMaster") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/PokerMaster') ?>" class="waves-effect">
                    <span>Poker Master Table</span>
                </a>
            </li>
            <li class="<?= (strpos($final_url, "backend/Pokers") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/Pokers') ?>" class="waves-effect">
                    <span>Poker History</span>
                </a>
            </li>
        </ul>
    </li>
<?php } ?>


<?php if (RED_VS_BLACK == true && ($role == SUPERADMIN || in_array('RED_VS_BLACK', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/redblack") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Red Vs Black</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/RedBlack") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/RedBlack') ?>" class="waves-effect">
                    <span>Red Vs Black History</span></a>
            </li>
        </ul>
    </li>
<?php } ?>

<?php if (ROULETTE == true && ($role == SUPERADMIN || in_array('ROULETTE', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/roulette") !== false && strpos($final_url, "backend/animalroulette") === false && strpos($final_url, "backend/iconroulette") === false && strpos($final_url, "backend/carroulette") === false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Roulette</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/Roulette") !== false && strpos($final_url, "backend/animalroulette") === false && strpos($final_url, "backend/iconroulette") === false && strpos($final_url, "backend/carroulette") === false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/Roulette') ?>" class="waves-effect">
                    <span>Roulette History</span></a>
            </li>
        </ul>
    </li>
<?php } ?>


<?php if (POINT_RUMMY == true && ($role == SUPERADMIN || in_array('RUMMY_POINT', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/rtummyablemaster") !== false || strpos($final_url, "backend/rummypoint") !== false || strpos($final_url, "backend/rummytablemaster") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Rummy Point</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/RummyTableMaster") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/RummyTableMaster') ?>" class="waves-effect">
                    <span>Rummy Point Table Master</span></a>
            </li>
            <li
                class="<?= (strpos($final_url, "backend/Rummy") !== false && strpos($final_url, "backend/RummyPool") === false && strpos($final_url, "backend/RummyDeal") === false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/Rummy') ?>" class="waves-effect">
                    <span>Rummy Point History</span></a>
            </li>
        </ul>
    </li>
<?php } ?>


<?php if (RUMMY_POOL == true && ($role == SUPERADMIN || in_array('RUMMY_POOL', $permission))) { ?>
    <li class="<?= (strpos($final_url, "backend/rummypool") !== false || strpos($final_url, "backend/PoolTableMaster") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Rummy Pool</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li class="<?= strpos($final_url, "backend/PoolTableMaster") !== false ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/PoolTableMaster') ?>" class="waves-effect">
                    <i class="ion ion-md-contact"></i>
                    <span>Rummy Pool Table Master</span>
                </a>
            </li>
            <li class="<?= strpos($final_url, "backend/RummyPool") !== false ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/RummyPool') ?>" class="waves-effect">
                    <i class="ion ion-md-list-box"></i>
                    <span>Rummy Pool History</span>
                </a>
            </li>
        </ul>
    </li>
<?php } ?>


<?php if (RUMMY_DEAL == true && ($role == SUPERADMIN || in_array('RUMMY_DEAL', $permission))) { ?>
    <li class="<?= (strpos($final_url, "backend/DealTableMaster") !== false || strpos($final_url, "backend/RummyDeal") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Rummy Deal</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li class="<?= (strpos($final_url, "backend/DealTableMaster") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/DealTableMaster') ?>" class="waves-effect">
                    <i class="ion ion-md-contact"></i>
                    <span>Rummy Deal Table Master</span>
                </a>
            </li>
            <li class="<?= (strpos($final_url, "backend/RummyDeal") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/RummyDeal') ?>" class="waves-effect">
                    <span>Rummy Deal History</span>
                </a>
            </li>
        </ul>
    </li>
<?php } ?>


<?php if (RUMMY_TOURNAMENT == true && ($role == SUPERADMIN || in_array('RUMMY_TOURNAMENT', $permission))) { ?>
    <li class="<?= strpos($final_url, "backend/TournamentTypes") !== false || strpos($final_url, "backend/TournamentMaster") !== false ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Rummy Tournament</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li class="<?= strpos($final_url, "backend/TournamentTypes") !== false ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/TournamentTypes') ?>" class="waves-effect">
                    <span>Rummy Tournament Types</span>
                </a>
            </li>
            <li class="<?= strpos($final_url, "backend/TournamentMaster") !== false ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/TournamentMaster') ?>" class="waves-effect">
                    <span>Rummy Tournament Master</span>
                </a>
            </li>
        </ul>
    </li>
<?php } ?>


<?php if (SEVEN_UP_DOWN == true && ($role == SUPERADMIN || in_array('SEVEN_UP_DOWN', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/sevenup") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Seven Up Down</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/SevenUp") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/SevenUp') ?>" class="waves-effect">
                    <span>Seven Up Down History</span></a>
            </li>
        </ul>
    </li>
<?php } ?>

<?php if (SLOT == true && ($role == SUPERADMIN || in_array('SLOT_GAME', $permission))) { ?>
    <li
        class="<?= (strpos($final_url, "backend/slotgame") !== false) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Slot Game</span>
        </a>
        <ul class="sub-menu mm-collapse">
            <li
                class="<?= (strpos($final_url, "backend/SlotGame") !== false) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/SlotGame') ?>" class="waves-effect">
                    <span>Slot Game History</span></a>
            </li>
        </ul>
    </li>
<?php } ?>


<?php
    $segment_2 = $this->uri->segment(2);

    $teenpatti_pages = ['tableMaster', 'Game', 'table', 'RobotCards'];
    $is_teenpatti_active = in_array($segment_2, $teenpatti_pages);
?>

<?php if (TEENPATTI == true && ($role == SUPERADMIN || in_array('TEENPATTI', $permission))) { ?>
    <li class="<?= $is_teenpatti_active ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>TeenPatti</span>
        </a>

        <ul class="sub-menu mm-collapse">
            <li class="<?= ($segment_2 == 'tableMaster') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/tableMaster') ?>">Teen Patti Table Master</a>
            </li>

            <li class="<?= ($segment_2 == 'Game') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/Game') ?>" class="waves-effect">
                    <span>Teenpatti History</span>
                </a>
            </li>

            <li class="<?= ($segment_2 == 'table') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/table') ?>" class="waves-effect">
                    <span>Watch Table Teenpatti</span>
                </a>
            </li>

            <li class="<?= ($segment_2 == 'RobotCards') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/RobotCards') ?>" class="waves-effect">
                    <span>Robot Cards</span>
                </a>
            </li>
        </ul>
    </li>
<?php } ?>

<!-- <?php if (($role == SUPERADMIN || in_array('TRIPAL_FUN', $permission))) { ?>
    <?php $isTriplefunActive = (strpos($final_url, "backend/Triplefun") !== false); ?>
    <li class="<?= $isTriplefunActive ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Triple Fun</span>
        </a>
        <ul class="sub-menu mm-collapse" style="<?= $isTriplefunActive ? 'display:block;' : '' ?>">
            <li class="<?= ($final_url == base_url('backend/Triplefun')) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/Triplefun') ?>" class="waves-effect">
                    <span>Triple Fun History</span>
                </a>
            </li>
        </ul>
    </li>
<?php } ?> -->

<!-- <?php if (($role == SUPERADMIN || in_array('THREE_DICE', $permission))) { ?>
    <?php $isThreediceActive = (strpos($final_url, "backend/Threedice") !== false); ?>
    <li class="<?= $isThreediceActive ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Three Dice</span>
        </a>
        <ul class="sub-menu mm-collapse" style="<?= $isThreediceActive ? 'display:block;' : '' ?>">
            <li class="<?= ($final_url == base_url('backend/Threedice')) ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/Threedice') ?>" class="waves-effect">
                    <span>Three Dice History</span>
                </a>
            </li>
        </ul>
    </li>
<?php } ?> -->



<?php
    $segment_1 = $this->uri->segment(2);
    $segment_2 = $this->uri->segment(3);
    $active_report_pages = [
        'AllLadgerReports',
        'aviator_bet',
        'ander_baher_bet',
        'animal_roulette_bet',
        'baccarat_bet',
        'car_roulette_bet',
        'color_prediction_bet',
        'color_prediction_1min_bet',
        'dragon_tiger_bet',
        'head_tails_bet',
        'icon_roulette_bet',
        'jackpot_teenpatti_bet',
        'jhandi_munda_bet',
        'poker_bet',
        'red_vs_black_bet',
        'roulette_bet',
        'rummy_point_bet',
        'rummy_pool_bet',
        'rummy_deal_bet',
        'rummy_tournament_bet',
        'seven_up_down_bet',
        'slot_game_bet',
        'teenpatti_bet'
    ];

    $is_report_active = ($segment_1 == 'User' && $segment_2 == 'AllLadgerReports') || ($segment_1 == 'GameReport' && in_array($segment_2, $active_report_pages));
?>

<?php
$others = [
    'REPORT_MANAGEMENT',
    'NOTIFICATION',
    'SETTING',
    'TICKET'
];

$show_others_menu = array_filter($others, function ($other) use ($role, $permission) {
    return defined($other) && constant($other) === true && ($role == SUPERADMIN || in_array($other, $permission));
});

if (!empty($show_others_menu)) {
    ?>
    <li class="menu-title" style="color:white">Others</li>
<?php
}
?>



<?php if (REPORT == true && ($role == SUPERADMIN || in_array('REPORT_MANAGEMENT', $permission))) { ?>
    <li class="<?= $is_report_active ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Report Mgmt.</span>
        </a>
        <ul class="sub-menu mm-collapse <?= $is_report_active ? 'mm-show' : '' ?>">

            <li class="<?= ($segment_1 == 'User' && $segment_2 == 'AllLadgerReports') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/User/AllLadgerReports') ?>" class="waves-effect">
                    <span>Ladger Report</span>
                </a>
            </li>

            <li class="menu-title" style="color:white">Game Reports</li>

            <li class="<?= ($segment_2 == 'aviator_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/aviator_bet') ?>">Aviator</a>
            </li>
            <li class="<?= ($segment_2 == 'ander_baher_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/ander_baher_bet') ?>">Andar Bahar</a>
            </li>
            <li class="<?= ($segment_2 == 'animal_roulette_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/animal_roulette_bet') ?>">Animal Roulette</a>
            </li>
            <li class="<?= ($segment_2 == 'baccarat_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/baccarat_bet') ?>">Baccarat</a>
            </li>
            <li class="<?= ($segment_2 == 'car_roulette_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/car_roulette_bet') ?>">Car Roulette</a>
            </li>
            <li class="<?= ($segment_2 == 'color_prediction_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/color_prediction_bet') ?>">Color Prediction</a>
            </li>
            <li class="<?= ($segment_2 == 'color_prediction_1min_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/color_prediction_1min_bet') ?>">Color Prediction 1 Minute</a>
            </li>
            <li class="<?= ($segment_2 == 'color_prediction_3min_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/color_prediction_3min_bet') ?>">Color Prediction 3 Minute</a>
            </li>
            <li class="<?= ($segment_2 == 'color_prediction_5min_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/color_prediction_5min_bet') ?>">Color Prediction 5 Minute</a>
            </li>
            <li class="<?= ($segment_2 == 'dragon_tiger_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/dragon_tiger_bet') ?>">Dragon Tiger</a>
            </li>
            <li class="<?= ($segment_2 == 'head_tails_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/head_tails_bet') ?>">Head & Tail</a>
            </li>
            <li class="<?= ($segment_2 == 'icon_roulette_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/icon_roulette_bet') ?>">Icon Roulette</a>
            </li>
            <li class="<?= ($segment_2 == 'jackpot_teenpatti_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/jackpot_teenpatti_bet') ?>">Jackpot TeenPatti</a>
            </li>
            <li class="<?= ($segment_2 == 'jhandi_munda_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/jhandi_munda_bet') ?>">Jhandi Munda</a>
            </li>
            <li class="<?= ($segment_2 == 'poker_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/poker_bet') ?>">Poker</a>
            </li>
            <li class="<?= ($segment_2 == 'red_vs_black_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/red_vs_black_bet') ?>">Red Vs Black</a>
            </li>
            <li class="<?= ($segment_2 == 'roulette_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/roulette_bet') ?>">Roulette</a>
            </li>
            <li class="<?= ($segment_2 == 'rummy_point_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/rummy_point_bet') ?>">Rummy Point</a>
            </li>
            <li class="<?= ($segment_2 == 'rummy_pool_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/rummy_pool_bet') ?>">Rummy Pool</a>
            </li>
            <li class="<?= ($segment_2 == 'rummy_deal_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/rummy_deal_bet') ?>">Rummy Deal</a>
            </li>
            <!-- <li class="<?= ($segment_2 == 'rummy_tournament_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/rummy_tournament_bet') ?>">Rummy Tournament</a>
            </li> -->
            <li class="<?= ($segment_2 == 'seven_up_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/seven_up_bet') ?>">Seven Up Down</a>
            </li>
            <li class="<?= ($segment_2 == 'slot_game_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/slot_game_bet') ?>">Slot Game</a>
            </li>
            <li class="<?= ($segment_2 == 'teenpatti_bet') ? 'mm-active' : '' ?>">
                <a href="<?= base_url('backend/GameReport/teenpatti_bet') ?>">TeenPatti</a>
            </li>

        </ul>
    </li>
<?php } ?>

<?php if (NOTIFICATION == true && ($role == SUPERADMIN || in_array('NOTIFICATION', $permission))) { ?>
    <li><a href="<?= base_url('backend/notification') ?>" class="waves-effect"><i
                class="ion ion-md-list-box"></i> <span>Notification</span></a></li>
<?php } ?>

<!-- <?php if (SETTING == true && ($role == SUPERADMIN || in_array('SETTING', $permission))) { ?>
<li><a href="<?= base_url('backend/setting') ?>" class="waves-effect"><i
            class="ion ion-md-list-box"></i> <span>Setting</span></a></li>
<?php } ?> -->

<?php if ($role == SUPERADMIN || in_array('APPBANNER', $permission) || in_array('MASTER_MANAGEMENT', $permission) || in_array('IMAGE_NOTIFICATION', $permission) || in_array('INCOME_DEPOSIT_BONUS', $permission) || in_array('INCOME_BET_BONUS', $permission) || in_array('INCOME_DAILY_SALARY_BONUS', $permission) || in_array('INCOME_DAILY_ATTENDANCE_BONUS', $permission) || in_array('WELCOME_BONUS', $permission)) { ?>

    <li
        class="<?= (array_filter([strpos($final_url, "backend/report")], 'is_numeric')) ? 'mm-active' : '' ?>">
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="ti-layout-grid2-alt"></i>
            <span>Settings</span>
        </a>

        <ul class="sub-menu mm-collapse">
            <?php if (SETTING == true && ($role == SUPERADMIN || in_array('SETTING', $permission))) { ?>
                <li><a href="<?= base_url('backend/setting/appConfiguration') ?>" class="waves-effect">
                        <span>Game Configuration</span>
                    </a>
                </li>
                <li><a href="<?= base_url('backend/setting/systemConfiguration') ?>" class="waves-effect">
                        <span>System Configuration</span>
                    </a>
                </li>
                <li><a href="<?= base_url('backend/setting/gamePermissions') ?>" class="waves-effect">
                        <span>Game Permission</span>
                    </a>
                </li>
            <?php } ?>
            <?php if (APPBANNER == true && ($role == SUPERADMIN || in_array('MASTER_MANAGEMENT', $permission))) { ?>
                <li><a href="<?= base_url('backend/AppBanner') ?>" class="waves-effect">
                        <span>App Banner</span></a></li>
            <?php } ?>
            <?php if (BANNER == true && ($role == SUPERADMIN || in_array('MASTER_MANAGEMENT', $permission))) { ?>
                <li><a href="<?= base_url('backend/banner') ?>" class="waves-effect">
                        <span>Website Banner</span></a></li>
            <?php } ?>
            <?php if (IMAGE_NOTIFICATION == true && ($role == SUPERADMIN || in_array('MASTER_MANAGEMENT', $permission))) { ?>
                <li><a href="<?= base_url('backend/ImageNotification') ?>" class="waves-effect"> <span>Welcome
                            App Image</span></a></li>
                <?php if (INCOME_DEPOSIT_BONUS == true && ($role == SUPERADMIN || in_array('MASTER_MANAGEMENT', $permission))) { ?>
                    <li
                        class="<?= (array_filter([strpos($final_url, "deposit_bonus"),], 'is_numeric')) ? 'mm-active' : '' ?>">
                        <a href="<?= base_url('backend/DepositBonus') ?>" class="waves-effect">
                            <span>Deposit Bonus</span></a>
                    </li>
                <?php } ?>
                <?php if (INCOME_BET_BONUS == true && ($role == SUPERADMIN || in_array('MASTER_MANAGEMENT', $permission))) { ?>
                    <li
                        class="<?= (array_filter([strpos($final_url, "report"),], 'is_numeric')) ? 'mm-active' : '' ?>">
                        <a href="<?= base_url('backend/Bet_income_master') ?>" class="waves-effect">
                            <span>Bet Income Bonus</span></a>
                    </li>
                <?php } ?>

                <?php if (INCOME_DAILY_SALARY_BONUS == true && ($role == SUPERADMIN || in_array('MASTER_MANAGEMENT', $permission))) { ?>
                    <li
                        class="<?= (array_filter([strpos($final_url, "report"),], 'is_numeric')) ? 'mm-active' : '' ?>">
                        <a href="<?= base_url('backend/DailySalaryBonusMaster') ?>" class="waves-effect">
                            <span>Daily Salary Bonus</span></a>
                    </li>
                <?php } ?>
                <?php if (INCOME_DAILY_ATTENDANCE_BONUS == true && ($role == SUPERADMIN || in_array('MASTER_MANAGEMENT', $permission))) { ?>
                    <li
                        class="<?= (array_filter([strpos($final_url, "report"),], 'is_numeric')) ? 'mm-active' : '' ?>">
                        <a href="<?= base_url('backend/DailyAttendenceBonusMaster') ?>" class="waves-effect">
                            <span>Daily Attendance Bonus</span></a>
                    </li>

                <?php } ?>

            <?php } ?>
            <?php if (WELCOME_BONUS == true && ($role == SUPERADMIN || in_array('MASTER_MANAGEMENT', $permission))) { ?>
                <li><a href="<?= base_url('backend/welcomebonus') ?>" class="waves-effect"> <span>Welcome
                            Bonus</span></a></li>
            <?php } ?>
        </ul>
    </li>
<?php } ?>

<?php if (($role == SUPERADMIN || in_array('TICKET', $permission))) {
    $CI = &get_instance();
    $CI->load->model('Support_model');
    $ticket_total = $CI->Support_model->TicketCount();
    ?>
    <li><a href="<?= base_url('backend/Tickets') ?>" class="waves-effect"><i
                class="ion ion-md-list-box"></i> <span>Tickets</span><span
                class="badge rounded-pill bg-danger float-end"><?= $ticket_total ?></span></a></li>
<?php } ?>