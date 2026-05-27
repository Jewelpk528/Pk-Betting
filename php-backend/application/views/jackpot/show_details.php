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
                <table class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Game Id</th>
                            <th>User Name</th>
                            <th>Amount</th>
                            <th>Winnig Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($AllUsers as $key => $Games) {
                                $bet='';
                                switch ($Games->bet) {
                                    case '1':
                                        $bet='High Card';
                                        break;
                                    case '2':
                                        $bet='Pair';
                                        break;
                                    case '3':
                                        $bet='Color';
                                        break;
                                    case '4':
                                        $bet='Sequence';
                                        break;
                                    case '5':
                                        $bet='Pure Sequence';
                                        break;
                                    case '6':
                                        $bet='Set';
                                        break;
                                }
                        ?>
                        <tr>
                            <td><?= $Games->jackpot_id ?></td>
                            <td><?= $Games->user_name ?></td>
                            <td><?= $Games->amount ?><?= '('.$bet.')' ?></td>
                            <td><?= $Games->winning_amount ?></td>
                        </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->
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
                title: 'Jackpot User Report'
            }
        ],
        pageLength: 10,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
    });
});
</script>