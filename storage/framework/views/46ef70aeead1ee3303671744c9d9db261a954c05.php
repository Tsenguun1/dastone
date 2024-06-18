

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
                                        <td>
                                            <?php if($position->STATUS == 'A'): ?>
                                                Идэвхитэй
                                            <?php elseif($position->STATUS == 'N'): ?>
                                                Идэвхгүй
                                            <?php else: ?>
                                                Unknown Status
                                            <?php endif; ?>
                                        </td>
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
                                                style="float: right;" data-bs-target="#UpdatePositionForm"
                                                data-id="<?php echo e($position->POS_ID); ?>" data-name="<?php echo e($position->POS_NAME); ?>"
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
        </div> <!-- end col -->
    </div> <!-- end row -->
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pc\Documents\GitHub\dastone\resources\views/viewposition.blade.php ENDPATH**/ ?>