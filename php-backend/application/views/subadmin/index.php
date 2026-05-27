<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0px !important;
    }
    
    div.dataTables_wrapper {
        padding: 10px;
    }
</style>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<div class="row">

    <div class="col-12">
        <div class="card">
        <div class="row">
            <div class="card-body table-responsive">

                <table class="table table-bordered nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Employee ID</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Password</th>
                            <!-- <th>Wallet</th> -->
                            <!-- <th>Status</th> -->
                            <th>Added Date and Time</th>
                            <?php if ($_ENV['ENVIRONMENT']!= 'demo') { ?>
                            <th>Action</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach($AllSubAdmin as $subdomain) { ?> 
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $subdomain->first_name ?></td>
                                <td><?= $subdomain->last_name ?></td>
                                <td><?= $subdomain->id ?></td>
                                <td><?= $subdomain->email_id ?></td>
                                <td><?= $subdomain->mobile ?></td>
                                <td><?= $subdomain->password ?></td>
                                <td><?= $subdomain->created_date ?></td>
                               <?php if ($_ENV['ENVIRONMENT']!= 'demo') { ?>
                                <td>

                                     <a href="<?= base_url('backend/SubAdmin/edit_subadmin/' . $subdomain->id) ?>" class="btn btn-info"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>

                                    | <a href="<?= base_url('backend/SubAdmin/delete/' . $subdomain->id) ?>" class="btn btn-danger"
                                        data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are You Sure Want To Delete <?= $subdomain->first_name ?>?')"><span class="fa fa-trash"></span></a>
                                </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
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
                title: 'SubAdmin Management Report'
            }
        ],
        pageLength: 10,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
    });
});
</script>
