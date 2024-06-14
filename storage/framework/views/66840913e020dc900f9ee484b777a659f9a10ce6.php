

<?php $__env->startSection('content'); ?>
<div class="page-wrapper">
    <div class="topbar">
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav mb-0">
                <h4 class="page-title" style="margin: 10px;">Албан тушаалын бүртгэл</h4>
                <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 10px; margin-top: 30px;"
                    data-bs-toggle="modal" data-bs-target="#AddPositionForm">+ Шинээр бүртгэх</button>
                <div class='card-body'>
                    <div class='table-rep-plugin'>
                        <div class='table-responsive mb-0' data-pattern='priority-columns'>
                            <table id='positions-table' class='table table-striped mb-0'>
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
                                            <td><?php echo e($position->STATUS); ?></td>
                                            <td><?php echo e($position->SORT_ORDER); ?></td>
                                            <td><?php echo e($position->EDIT_DATE); ?></td>
                                            <td>
                                            <form action="<?php echo e(route('deleteposition', $position->POS_ID)); ?>" method="POST"
                                                    style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type='submit' class='btn btn-danger' style="float: right;">Устгах</button>
                                                </form>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                style="float: right;"
                                                    data-bs-target="#UpdatePositionForm" data-id="<?php echo e($position->POS_ID); ?>"
                                                    data-name="<?php echo e($position->POS_NAME); ?>"
                                                    data-status="<?php echo e($position->STATUS); ?>"
                                                    data-sort="<?php echo e($position->SORT_ORDER); ?>">Засах</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </ul>
        </nav>
    </div>
</div>

<?php echo $__env->make('modal.addposition', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const updatePositionFormModal = document.getElementById('UpdatePositionForm');
        updatePositionFormModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const posId = button.getAttribute('data-id');
            const posName = button.getAttribute('data-name');
            const status = button.getAttribute('data-status');
            const sortOrder = button.getAttribute('data-sort');

            const modalPosIdInput = document.getElementById('modal-pos-id');
            const modalPosNameInput = document.getElementById('posName');
            const modalStatusInput = document.getElementById('status');
            const modalSortOrderInput = document.getElementById('sortOrder');

            modalPosIdInput.value = posId;
            modalPosNameInput.value = posName;
            modalStatusInput.value = status;
            modalSortOrderInput.value = sortOrder;
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hp\Desktop\dastone\resources\views/viewposition.blade.php ENDPATH**/ ?>