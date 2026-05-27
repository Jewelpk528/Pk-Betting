<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <?php
                $total_profit = 0;

                if(!empty($AdminProfit)){
                    foreach ($AdminProfit as $row) {
                        if ($row->admin_commission > 0) {
                            $total_profit += $row->admin_commission;
                        }
                    }
                }
                ?>

                <h4 class="page-title">
                    Direct Admin Profit :
                    <span style="color:green"><?= $total_profit ?></span>
                </h4>

              <form method="get">

                    <div class="row mb-3 align-items-end">

                        <div class="col-md-3">
                            <input type="date"
                                name="date"
                                value="<?= $search_date ?>"
                                class="form-control">
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">
                                Search
                            </button>
                        </div>

                        <div class="col-auto">
                            <a href="<?= base_url('backend/Setting/AdminProfit_log') ?>" 
                            class="btn btn-secondary">
                            Clear
                            </a>
                        </div>

                    </div>

                </form>
            
                <table class="table table-bordered dt-responsive nowrap"
                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Source ID</th>
                            <th>Source</th>
                            <th>Admin Coin</th>
                            <th>Added Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        if(!empty($AdminProfit)){

                            $i = 0;

                            foreach ($AdminProfit as $log) {
                                $i++;
                        ?>

                        <tr>

                            <td><?= $i ?></td>

                            <td><?= $log->source_id ?></td>

                            <td><?= $log->source ?></td>

                            <td>
                                <?= ($log->admin_commission < 0)
                                    ? $log->admin_coin.'(<span style="color:red">'.$log->admin_commission.'</span>)'
                                    : $log->admin_coin.'(<span style="color:green">+'.$log->admin_commission.'</span>)'
                                ?>
                            </td>

                            <td><?= $log->added_date ?></td>

                        </tr>

                        <?php
                            }
                        }else{
                        ?>

                        <tr>
                            <td colspan="5" style="text-align:center">No Data Found</td>
                        </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>


<script>

$(document).ready(function() {

    $('.table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel',
            'pdf'
        ]
    });

});

</script>