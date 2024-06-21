<div class="form-container" id="formContainer">
    <form id="registrationForm" action="<?php echo e(route('updateposition', $position->POS_ID)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
            <label for="posName">Ажлын байрны нэршил</label>
            <input type="text" class="form-control" id="posName" name="posName" value="<?php echo e($position->POS_NAME); ?>"
                required>
            <label for="status">Төлөв</label>
            <select id="status" name="status" class="form-control" required>
                <option value="">[Сонгоно уу]</option>
                <option value="A" <?php echo e($position->STATUS == 'A' ? 'selected' : ''); ?>>Идэвхитэй</option>
                <option value="N" <?php echo e($position->STATUS == 'N' ? 'selected' : ''); ?>>Идэвхгүй</option>
            </select>
            <label for="sortOrder">Эрэмбэ</label>
            <input type="number" class="form-control" id="sortOrder" name="sortOrder"
                value="<?php echo e($position->SORT_ORDER); ?>" required>
        <button type="submit" class="btn btn-primary">Хадгалах</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
    </form>
</div><?php /**PATH C:\Users\pc\Documents\GitHub\dastone\resources\views\partials\editpositionform.blade.php ENDPATH**/ ?>