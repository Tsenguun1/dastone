
<?php $__env->startSection('content'); ?>
<div class="topbar">
    <nav class="navbar-custom">
        <h4 class="page-title" style="margin: 10px;">Газар нэгжийн бүртгэл</h4>
    </nav>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class='table-rep-plugin'>
                    <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 15px;"
                        data-bs-toggle="modal" data-bs-target="#AddPlaceForm">+ Шинээр бүртгэх</button>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped mb-0"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Нэр</th>
                                <th>Захирал</th>
                                <th>Төлөв</th>
                                <th>Эрэмбэ</th>
                                <th>Зассан</th>
                                <th style=" text-align: center; ">Үйлдэл</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $departmentTree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('partials.department_row', ['department' => $department, 'level' => 0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<?php echo $__env->make('modal.addplace', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const updatePlaceFormModal = document.getElementById('UpdatePlaceForm');
        updatePlaceFormModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const depId = button.getAttribute('data-id');
            const depName = button.getAttribute('data-name');
            const status = button.getAttribute('data-status');
            const sortOrder = button.getAttribute('data-sort');
            const parentDepId = button.getAttribute('data-parent');
            const directorEmpId = button.getAttribute('data-director');

            const modalDepIdInput = document.getElementById('modal-dep-id');
            const modalDepNameInput = document.getElementById('depName');
            const modalStatusInput = document.getElementById('status');
            const modalSortOrderInput = document.getElementById('sortOrder');
            const modalParentDepIdInput = document.getElementById('parentDepId');
            const modalDirectorEmpIdInput = document.getElementById('directorEmpId');

            modalDepIdInput.value = depId;
            modalDepNameInput.value = depName;
            modalStatusInput.value = status;
            modalSortOrderInput.value = sortOrder;
            modalParentDepIdInput.value = parentDepId;
            modalDirectorEmpIdInput.value = directorEmpId;
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hp\Desktop\dastone\resources\views/viewplace.blade.php ENDPATH**/ ?>