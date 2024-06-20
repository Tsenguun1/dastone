

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
                        <table id="employeeTable" class="table table-bordered dt-responsive nowrap table-striped mb-0"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function () {
    load_employee_data();

    function load_employee_data(from_date = '', to_date = '') {
        var table = $('#employeeTable').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
           
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(route('employeeListTable')); ?>',
                data: function (d) {
                    d.status = $('#status').val(),
                    d.department = $('#department').val(),
                    d.position = $('#position').val()
                }
            },
            columns: [
                { data: 'picture', name: 'picture', render: function(data, type, row) {
                        return '<img src="' + data + '" style="border-radius: 50%; width: 50px; height: 50px; object-fit: cover;" alt="Employee Picture">';
                    }
                },
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
                { data: 'status', name: 'status', render: function(data, type, row) {
                        return data === 'A' ? 'Идэвхитэй' : 'Идэвхгүй';
                    }
                },
                {
                    data: 'action', name: 'action', orderable: false, searchable: false,
                    render: function(data, type, row) {
                        return '<a class="btn btn-primary btn-xs" onclick="getEditEmployeeModal(' + row.id + ')" data-bs-toggle="modal" data-bs-target="#editEmployeeModal">Засах</a>' +
                            ' <button class="btn btn-danger btn-xs" onclick="deleteEmployee(' + row.id + ')">Устгах</button>';
                    }
                },
            ],
            "bDestroy": true
        });

        $('#status').change(function() {
            table.draw();
        });
        $('#department').change(function() {
            table.draw();
        });
        $('#position').change(function() {
            table.draw();
        });
    }
});

function getEditEmployeeModal(id) {
    $.ajax({
        url: '/editemployee/' + id,
        method: 'GET',
        success: function(response) {
            $('#editEmployeeModal .modal-content').html(response);
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}

function deleteEmployee(id) {
    if (confirm('Та энэ ажилтныг устгахдаа итгэлтэй байна уу?')) {
        $.ajax({
            url: '/deleteemployee/' + id,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('modal.addemployee', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pc\Documents\GitHub\dastone\resources\views/viewemployee.blade.php ENDPATH**/ ?>