<section class="section">
    <div class="card">
        <div class="card-body">
            <form id="dateFilterForm">
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
                            <button type="submit" class="btn btn-success mt-4">Search</button>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <button type="button" onclick="showAllData()" class="btn btn-primary mt-4">All Data</button>
                        </div>
                    </div>
                </div>
            </form>
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
                            <th>Game Id</th>
                            <th>Date and Time</th>
                            <th>Winner</th>
                            <th>Winning Amount</th>
                            <th>User Amount</th>
                            <th>Admin Commission</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($AllGames)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No records found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($AllGames as $Games): ?>
                                <tr>
                                    <td><?= htmlspecialchars($Games->id) ?></td>
                                    <td><?= date("d-m-Y h:i A", strtotime($Games->added_date)) ?></td>
                                    <td><?= htmlspecialchars($Games->name ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($Games->winning_amount ?? '0') ?></td>
                                    <td><?= htmlspecialchars($Games->user_amount ?? '0') ?></td>
                                    <td><?= htmlspecialchars($Games->commission_amount ?? '0') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var dataTable = $('.table').DataTable({
        pageLength: 10,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Rummy Deal History' + moment().format('YYYY-MM-DD'),
                text: 'Excel',
                exportOptions: {
                    columns: ':visible'
                },
                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c[r^="A"]', sheet).attr('s', '2'); // Bold Game Id column
                }
            }
        ]
    });

    // Initialize DateRangePicker
    $('#report').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    // Handle date range selection
    $('#report').on('apply.daterangepicker', function(ev, picker) {
        $(this).find('span').text(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        $('#sn_date').val(picker.startDate.format('YYYY-MM-DD'));
        $('#en_date').val(picker.endDate.format('YYYY-MM-DD'));
        console.log('Filtering: Start:', $('#sn_date').val(), 'End:', $('#en_date').val());
        dataTable.draw();
    });

    // Handle date range clear
    $('#report').on('cancel.daterangepicker', function(ev, picker) {
        $(this).find('span').text('');
        $('#sn_date').val('');
        $('#en_date').val('');
        console.log('Cleared date filter');
        dataTable.draw();
    });

    // Handle Search button
    $('#dateFilterForm').on('submit', function(e) {
        e.preventDefault();
        console.log('Search clicked');
        dataTable.draw();
    });

    // Custom date filter
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        var startDate = $('#sn_date').val();
        var endDate = $('#en_date').val();
        var date = moment(data[1], 'DD-MM-YYYY hh:mm A'); // Date and Time column
        if (!startDate && !endDate) return true;
        if (startDate && !endDate && date.isSameOrAfter(moment(startDate, 'YYYY-MM-DD'))) return true;
        if (!startDate && endDate && date.isSameOrBefore(moment(endDate, 'YYYY-MM-DD'))) return true;
        if (startDate && endDate && date.isBetween(moment(startDate, 'YYYY-MM-DD'), moment(endDate, 'YYYY-MM-DD'), null, '[]')) return true;
        return false;
    });

    // Error handling
    $.fn.dataTable.ext.errMode = 'none';
    $('.table').on('error.dt', function(e, settings, techNote, message) {
        console.error('DataTables error:', message);
    });
});

// Reset all filters
function search() {
        $('.table').DataTable().draw();
    }

    function showAllData() {
    $('#sn_date').val('');
    $('#en_date').val('');
    $('.table').DataTable().search('').draw();
}

</script>