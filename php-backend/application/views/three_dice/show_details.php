<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0px !important;
    }
</style>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<div class="card">
    <div class="card-body">
        <table class="table table-bordered dt-responsive nowrap" style="width: 100%;">
            <thead>
                <tr>
                    <th>Game ID</th>
                    <th>User Name</th>
                    <th>Amount</th>
                    <th>Winning Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $handTypes = [
                        1 => 'High Card',
                        2 => 'Pair',
                        3 => 'Color',
                        4 => 'Sequence',
                        5 => 'Pure Sequence',
                        6 => 'Set'
                    ];
                    foreach ($AllUsers as $game): 
                        $betName = $handTypes[$game->bet] ?? 'N/A';
                ?>
                    <tr>
                        <td><?= $game->three_dice_id ?></td>
                        <td><?= $game->user_name ?></td>
                        <td><?= $game->amount . ' (' . $betName . ')' ?></td>
                        <td><?= $game->winning_amount ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- jQuery + DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script>
    $(document).ready(function () {
        $('.table').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'Three Dice User Report'
                }
            ],
            pageLength: 10
        });
    });
</script>
