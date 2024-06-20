<div class="form-container" id="formContainer">
    <form id="feeForm" action="<?php echo e(route('updatefee', $fee->FEE_ID)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <label for="feeName" class="form-check-label">Хураамжийн нэр</label>
        <input type="text" class="form-control" id="feeName" name="feeName" value="<?php echo e($fee->FEE_NAME); ?>" required>

        <label for="feeDescr" class="form-check-label">Тайлбар</label>
        <textarea class="form-control" id="feeDescr" name="feeDescr" required><?php echo e($fee->FEE_DESCR); ?></textarea>

        <label for="feeType" class="form-check-label">Төрөл</label>
        <input type="text" class="form-control" id="feeType" name="feeType" value="<?php echo e($fee->FEE_TYPE); ?>" required>

        <label for="feeOrder" class="form-check-label">Эрэмбэ</label>
        <input type="number" class="form-check-input" id="feeOrder" name="feeOrder" value="<?php echo e($fee->ORDER_NO); ?>" required>

        <label for="feeStatus" class="form-check-label">Байдал</label>
        <select id="feeStatus" name="feeStatus" class="form-control" required>
            <option value="A" <?php echo e($fee->STATUS == 'A' ? 'selected' : ''); ?>>Идэвхитэй</option>
            <option value="N" <?php echo e($fee->STATUS == 'N' ? 'selected' : ''); ?>>Идэвхгүй</option>
        </select>

        <button type="submit" class="btn btn-primary">Хадгалах</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
    </form>
</div>
<?php /**PATH C:\Users\pc\Documents\GitHub\dastone\resources\views/partials/editFeeform.blade.php ENDPATH**/ ?>