

<?php $__env->startSection('content'); ?>
<div class="topbar">
    <nav class="navbar-custom">
        <h4 class="page-title" style="margin: 10px;">Хураамжийн бүртгэл</h4>
    </nav>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class='table-rep-plugin'>
                    <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 15px;"
                        data-bs-toggle="modal" data-bs-target="#AddFeeForm">+ Шинээр бүртгэх</button>
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
                            <?php $__currentLoopData = $fees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($fee->FEE_ID); ?></td>
                                    <td><?php echo e($fee->FEE_TYPE); ?></td>
                                    <td><?php echo e($fee->FEE_NAME); ?></td>
                                    <td><?php echo e($fee->FEE_DESCR); ?></td>
                                    <td><?php echo e($fee->ORDER_NO); ?></td>
                                    <td><?php echo e($fee->FEE_STARTDATE); ?></td>
                                    <td><?php echo e($fee->STATUSVALUE); ?></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#detailsFeeModal"
                                            data-id="<?php echo e($fee->FEE_ID); ?>">Дэлгэрэнгүй</button>


                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#editFeeModal" data-id="<?php echo e($fee->FEE_ID); ?>">Засах</button>

                                        <form action="<?php echo e(route('deletefee', $fee->FEE_ID)); ?>" method="POST"
                                            style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type='submit' class='btn btn-danger'>Устгах</button>
                                        </form>
                                    </td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Fee Modal -->
<div class="modal fade" id="editFeeModal" tabindex="-1" role="dialog" aria-labelledby="editFeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <!-- Content will be loaded via AJAX -->
        </div>
    </div>
</div>

<div class="modal fade" id="detailsFeeModal" tabindex="-1" role="dialog" aria-labelledby="detailsFeeModalLabel" aria-hidden="true">
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

<script>
    $(document).ready(function () {
        $('#statusFilter').on('change', function () {
            var selectedStatus = $(this).val();
            filterTable(selectedStatus);
        });

        function filterTable(status) {
            $('#feeTable tbody tr').each(function () {
                var row = $(this);
                var rowStatus = row.find('td:nth-child(8)').text(); // Match the correct column for status
                if (status === "" || rowStatus === status) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        }
        
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

        $('#saveFeeChanges').click(function () {
            var form = $('#editFeeModal').find('form');
            var formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: formData,
                success: function (response) {
                    $('#editFeeModal').modal('hide');
                    location.reload();
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('#feeTable').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": 8 }
            ],
            "order": [],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/mn.json"
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pc\Documents\GitHub\dastone\resources\views\viewFee.blade.php ENDPATH**/ ?>