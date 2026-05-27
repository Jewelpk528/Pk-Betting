<?php
    function formatIndianCurrency($amount) {
        $amount = number_format($amount, 2, '.', '');
        $parts = explode('.', $amount);
        $int = $parts[0];
        $decimal = $parts[1];
        $last3 = substr($int, -3);
        $restUnits = substr($int, 0, -3);
        if ($restUnits != '') {
            $restUnits = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $restUnits);
            $formatted = $restUnits . "," . $last3;
        } else {
            $formatted = $last3;
        }
        return '₹ ' . $formatted . '.' . $decimal;
    }
    
    function formatWithoutIndianCurrency($amount) {
        $amount = number_format($amount, 2, '.', '');
        $parts = explode('.', $amount);
        $int = $parts[0];
        $decimal = $parts[1];
        $last3 = substr($int, -3);
        $restUnits = substr($int, 0, -3);
        if ($restUnits != '') {
            $restUnits = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $restUnits);
            $formatted = $restUnits . "," . $last3;
        } else {
            $formatted = $last3;
        }
        return $formatted . '.' . $decimal;
    }
?>

<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0px !important;
    }
</style>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>User Name</th>
                            <th>Total Bet</th>
                            <th>Total Winning</th>
                            <th>Win Amount (₹)</th>
                            <th>Lose Amount (₹)</th>
                            <th>Deposit (₹)</th>
                            <th>Withdrawal (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            $total_win = 0;
                            $total_lose = 0;
                            $total_deposit = 0;
                            $total_withdrawal = 0;

                            foreach ($report as $row):
                                $win_amt = 0;
                                $lose_amt = 0;

                                if ($row->total_winning >= $row->total_bet) {
                                    $win_amt = $row->total_winning - $row->total_bet;
                                    $total_win += $win_amt;
                                } else {
                                    $lose_amt = $row->total_bet - $row->total_winning;
                                    $total_lose += $lose_amt;
                                }

                                $deposit = $row->total_deposit ?? 0;
                                $withdrawal = $row->total_withdrawal ?? 0;

                                $total_deposit += $deposit;
                                $total_withdrawal += $withdrawal;
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->name ?></td>
                            <td><?= formatWithoutIndianCurrency($row->total_bet) ?></td>
                            <td><?= formatWithoutIndianCurrency($row->total_winning) ?></td>
                            <td style="color:green;"><b><?= formatWithoutIndianCurrency($win_amt) ?></b></td>
                            <td style="color:red"><b><?= formatWithoutIndianCurrency($lose_amt) ?></b></td>
                            <td><b><?= formatWithoutIndianCurrency($deposit) ?></b></td>
                            <td><b><?= formatWithoutIndianCurrency($withdrawal) ?></b></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="4" style="text-align:right">Total</th>
                            <th style="color:green"><b><?= formatIndianCurrency($total_win) ?></b></th>
                            <th style="color:red"><b><?= formatIndianCurrency($total_lose) ?></b></th>
                            <th><b><?= formatIndianCurrency($total_deposit) ?></b></th>
                            <th><b><?= formatIndianCurrency($total_withdrawal) ?></b></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
$(document).ready(function () {
    $('.table').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Roulette Win / Lose Report'
            }
        ],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });
});
</script>