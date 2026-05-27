<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <input type="hidden" id="sn_date" value="" name="start_date">
                        <input type="hidden" id="en_date" value="" name="end_date">
                        <label for="crm_attendence_date">Date filter</label>
                        <div id="report" class="form-control" style="cursor: pointer;">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span>
                            <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <div class="form-group">
                        <button type="button" onclick="search()" class="btn btn-success mt-4">Search</button>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <button type="button" onclick="showAllData()" class="btn btn-primary mt-4">All Data</button>
                    </div>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Game Id</th>
                            <th>Date and Time</th>
                            <th>No. of bets</th>
                            <th>Total Bet</th>
                            <th>Winning Amount</th>
                            <th>User Amount</th>
                            <th>Winning</th>
                            <th>Commission Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         $sr = 1;
                        foreach ($AllGames as $Games) {
                            $bet = 0;
                            $users = 0;
                            $amt = 0;
                            if (!empty($Games->details)) {
                                foreach ($Games->details as $game) {
                                    $bet += $game->amount;
                                    $users++;
                                    $amt += $game->winning_amount;
                                }
                            } ?>
                            <tr>
                                <td><?= $sr++ ?></td> 
                                <td><?= $Games->id ?></td>
                                <td><?= date("d-m-Y H:i:s A", strtotime($Games->added_date)) ?></td>
                                <td><u><a href="<?= base_url('backend/Jackpot/jackpot_bet/' . $Games->id) ?>"> <?= $users ?></a></u></td>
                                <td><?= $bet ?></td>
                                <td><?= $amt ?></td>
                                <td><?= $Games->user_amount ?></td>
                                <td>
                                    <?php
                                    $handTypes = [
                                        1 => 'High Card',
                                        2 => 'Pair',
                                        3 => 'Color',
                                        4 => 'Sequence',
                                        5 => 'Pure Sequence',
                                        6 => 'Set'
                                    ];
                                    echo isset($handTypes[$Games->winning]) ? $handTypes[$Games->winning] : 'N/A';
                                    ?>
                                </td>
                                <td><?= $Games->comission_amount ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
  function search() {
        $('.table').DataTable().draw();
    }

    function showAllData() {
    $('#sn_date').val('');
    $('#en_date').val('');
    $('.table').DataTable().search('').draw();
}

$(document).ready(function() {
    var dataTable = $('.table').DataTable({
        pageLength: 10,
        order: [[1, "desc"]],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Jackpot Teenpatti History' + new Date().toISOString().slice(0, 10),
                text: 'Excel',
                exportOptions: {
                    columns: ':visible'
                },
                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c[r^="A"]', sheet).attr('s', '2'); 
                }
            }
        ]
    });

    $('#report').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('#report').on('apply.daterangepicker', function(ev, picker) {
        $(this).find('span').text(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        $('#sn_date').val(picker.startDate.format('YYYY-MM-DD'));
        $('#en_date').val(picker.endDate.format('YYYY-MM-DD'));
        dataTable.draw();
    });

    $('#report').on('cancel.daterangepicker', function(ev, picker) {
        $(this).find('span').text('');
        $('#sn_date').val('');
        $('#en_date').val('');
        dataTable.draw();
    });

    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var startDate = $('#sn_date').val();
            var endDate = $('#en_date').val();
            var date = moment(data[1], 'DD-MM-YYYY HH:mm:ss A'); // Column 1 is Date and Time
            if (!startDate && !endDate) return true;
            if (startDate && !endDate && date.isSameOrAfter(moment(startDate, 'YYYY-MM-DD'))) return true;
            if (!startDate && endDate && date.isSameOrBefore(moment(endDate, 'YYYY-MM-DD'))) return true;
            if (startDate && endDate && date.isBetween(moment(startDate, 'YYYY-MM-DD'), moment(endDate, 'YYYY-MM-DD'), null, '[]')) return true;
            return false;
        }
    );
});
</script>