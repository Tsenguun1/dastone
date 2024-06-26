

<?php $__env->startSection('content'); ?>
<div class="topbar">
    <nav class="navbar-custom">
        <h4 class="page-title" style="margin: 10px;">Хураамжийн бүртгэл</h4>
    </nav>
</div>
<div class="page-content">
    <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 15px;" data-bs-toggle="modal"
        data-bs-target="#AddFeeForm">
        + Шинээр бүртгэх
    </button>
    <div class="container-fluid">
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
                            <table id="feeTable" class="table table-bordered dt-responsive nowrap table-striped mb-0"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th data-sortable="false">№</th>
                                        <th data-sortable="true">ID</th>
                                        <th data-sortable="true">Төрөл</th>
                                        <th data-sortable="true">Нэр</th>
                                        <th data-sortable="true">Тайлбар</th>
                                        <th data-sortable="false" style="text-align: center;">Эрэмбэ</th>
                                        <th data-sortable="false">Эхлэх огноо</th>
                                        <th data-sortable="true">Төлөв</th>
                                        <th data-sortable="true">Үйлдэл</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add Fee Modal -->
<?php echo $__env->make('modal.addfee', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Edit Fee Modal -->
<div class="modal fade" id="editFeeModal" tabindex="-1" role="dialog" aria-labelledby="editFeeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <!-- Content will be loaded via AJAX -->
        </div>
    </div>
</div>

<!-- Details Fee Modal -->
<div class="modal fade" id="detailsFeeModal" tabindex="-1" role="dialog" aria-labelledby="detailsFeeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <!-- Content will be loaded here via AJAX -->
        </div>
    </div>
</div>

<!-- Include jQuery, Bootstrap, and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        var table = $('#feeTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(route('feelisttable')); ?>',
                type: 'GET'
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'FEE_ID', name: 'FEE_ID' },
                { data: 'FEE_TYPE', name: 'FEE_TYPE' },
                { data: 'FEE_NAME', name: 'FEE_NAME' },
                { data: 'FEE_DESCR', name: 'FEE_DESCR' },
                { data: 'ORDER_NO', name: 'ORDER_NO' },
                { data: 'FEE_STARTDATE', name: 'FEE_STARTDATE' },
                { data: 'STATUS', name: 'STATUS' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ]
        });

        // Status filter functionality
        $('#statusFilter').on('change', function () {
            var selectedStatus = $(this).val();
            table.column(7).search(selectedStatus).draw();
        });

        // Edit fee modal
        $('#editFeeModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var feeId = button.data('id');
            var modal = $(this);

            $.ajax({
                url: '/editfee/' + feeId,
                method: 'GET',
                success: function (response) {
                    modal.find('.modal-content').html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        // Details fee modal
        $('#detailsFeeModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var feeId = button.data('id');
            var modal = $(this);

            $.ajax({
                url: '/detailsfee/' + feeId,
                method: 'GET',
                success: function (response) {
                    modal.find('.modal-content').html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        // Save changes in the edit fee modal
        $(document).on('click', '#saveFeeChanges', function () {
            var form = $('#editFeeModal').find('form');
            var formData = new FormData(form[0]);

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#editFeeModal').modal('hide');
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hp\Desktop\dastone\resources\views/viewFee.blade.php ENDPATH**/ ?>