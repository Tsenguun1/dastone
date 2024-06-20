

<?php $__env->startSection('content'); ?>
<div class="topbar">
    <nav class="navbar-custom">
        <h4 class="page-title" style="margin: 10px;">Ажилтны бүртгэл</h4>
    </nav>
</div>

<!-- Page Content-->
<div class="page-content">
    <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 15px;" data-bs-toggle="modal"
        data-bs-target="#AddEmployeeForm">+ Шинээр бүртгэх</button>
    <div class="container-fluid"></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class='table-rep-plugin'>
                        <div class="mb-3">
                            <label for="statusFilter" class="form-check-label">Төлөв:</label>
                            <select id="statusFilter" class="form-control">
                                <option value="">Бүх</option>
                                <option value="Идэвхитэй">Идэвхитэй</option>
                                <option value="Идэвхгүй">Идэвхгүй</option>
                            </select>
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped mb-0"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 10px;">
                            <thead>
                                <tr>
                                    <th>Зураг</th>
                                    <th>Эцэг/эхийн нэр</th>
                                    <th>Өөрийн нэр</th>
                                    <th>Газар нэгж</th>
                                    <th>Албан тушаал</th>
                                    <th>Регистр</th>
                                    <th>Хүйс</th>
                                    <th>Цахим шуудан</th>
                                    <th>Төрсөн огноо</th>
                                    <th>Гар утас</th>
                                    <th>Ажлын утас</th>
                                    <th>Төлөв</th>
                                    <th>Үйлдэл</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>

<!-- Edit Employee Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <!-- Modal content will be loaded here via AJAX -->
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script>
   $(document).ready(function () {
    // Initialize DataTable
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo e(route('employeeListTable')); ?>',
            type: 'GET'
        },
        columns: [
            { data: 'picture', name: 'picture', render: function(data) {
                return '<img src="' + data + '" alt="Employee Picture" width="50" height="50">';
            }},
            { data: 'lastname', name: 'lastname' },
            { data: 'firstname', name: 'firstname' },
            { data: 'department', name: 'department' },
            { data: 'position', name: 'position' },
            { data: 'register', name: 'register' },
            { data: 'sex', name: 'sex' },
            { data: 'email', name: 'email' },
            { data: 'birthdate', name: 'birthdate' },
            { data: 'handphone', name: 'handphone' },
            { data: 'workphone', name: 'workphone' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false, render: function(data, type, row) {
                return '<button type="button" class="btn btn-primary btn-xs edit-button" data-id="' + row.id + '" data-bs-toggle="modal" data-bs-target="#editEmployeeModal">Засах</button>' + 
                       '<form action="/deleteemployee/' + row.id + '" method="POST" style="display:inline;">' +
                       '<?php echo csrf_field(); ?>' +
                       '<?php echo method_field("DELETE"); ?>' +
                       '<button type="submit" class="btn btn-danger btn-xs">Устгах</button>' +
                       '</form>';
            }}
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ]
    });

    // Status filter functionality
    $('#statusFilter').on('change', function () {
        var selectedStatus = $(this).val();
        table.column(11).search(selectedStatus).draw();
    });

    // Edit employee modal
    $('#editEmployeeModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var empId = button.data('id');
        var modal = $(this);

        $.ajax({
            url: '/editemployee/' + empId,
            method: 'GET',
            success: function (response) {
                modal.find('.modal-content').html(response);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Save changes in the edit employee modal
    $(document).on('click', '#saveEmployeeChanges', function () {
        var form = $('#editEmployeeModal').find('form');
        var formData = new FormData(form[0]);

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#editEmployeeModal').modal('hide');
                table.ajax.reload(); // Reload the DataTable to see the changes
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('modal.addemployee', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pc\Documents\GitHub\dastone\resources\views/viewemployee.blade.php ENDPATH**/ ?>