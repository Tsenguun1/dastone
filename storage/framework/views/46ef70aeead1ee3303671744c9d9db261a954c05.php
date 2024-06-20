

<?php $__env->startSection('content'); ?>
<div class="topbar">
    <nav class="navbar-custom">
        <h4 class="page-title" style="margin: 10px;">Албан тушаалын бүртгэл</h4>
    </nav>
</div>

<div class="page-content">
    <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 15px;" data-bs-toggle="modal"
        data-bs-target="#AddPositionForm">+ Шинээр бүртгэх</button>
    <div class="container-fluid"></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class='table-rep-plugin'>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped mb-0"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Нэр</th>
                                    <th>Төлөв</th>
                                    <th>Эрэмбэ</th>
                                    <th>Зассан</th>
                                    <th style=" text-align: center; ">Үйлдэл</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($position->POS_NAME); ?></td>
                                        <td><?php echo e($position->STATUSVALUE); ?></td>
                                        <td><?php echo e($position->SORT_ORDER); ?></td>
                                        <td><?php echo e($position->EDIT_DATE); ?></td>
                                        <td>
                                            <form action="<?php echo e(route('deleteposition', $position->POS_ID)); ?>" method="POST"
                                                style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type='submit' class='btn btn-danger'
                                                    style="float: right;">Устгах</button>
                                            </form>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                style="float: right;" data-bs-target="#editPositionModal"
                                                data-id="<?php echo e($position->POS_ID); ?>">Засах</button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
</div>

<!-- Update Position Modal -->
<div class="modal fade" id="editPositionModal" tabindex="-1" role="dialog" aria-labelledby="editPositionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        // Function to handle opening the edit position modal and loading content via AJAX
        $('#editPositionModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var posId = button.data('id'); // Extract info from data-* attributes
            var modal = $(this);

            // Load the form via AJAX
            $.ajax({
                url: '/editposition/' + posId,
                method: 'GET',
                success: function (response) {
                    modal.find('.modal-content').html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        // Function to handle saving changes made in the edit position modal
        $('#savePositionChanges').click(function () {
            var form = $('#editPositionModal').find('form');
            var formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: formData,
                success: function (response) {
                    $('#editPositionModal').modal('hide');
                    location.reload(); // Reload the page to see the changes
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        // Initialize DataTable with specific configurations
        $('#datatable').DataTable({
            "columnDefs": [{ "orderable": false, "targets": 4 }], // Disable sorting on the 'Action' column
            "order": [], // Disable initial sorting
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/mn.json" // Example for Mongolian translation
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('modal.addposition', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pc\Documents\GitHub\dastone\resources\views/viewposition.blade.php ENDPATH**/ ?>