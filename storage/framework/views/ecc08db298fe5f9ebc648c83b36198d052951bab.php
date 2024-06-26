<form action="<?php echo e(route('deleteposition', $position->POS_ID)); ?>" method="POST" style="display:inline;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type='submit' class='btn btn-danger' style="float: right;">Устгах</button>
</form>
<button type="button" class="btn btn-success" data-bs-toggle="modal" style="float: right;"
    data-bs-target="#editPositionModal" data-id="<?php echo e($position->POS_ID); ?>">Засах</button><?php /**PATH C:\Users\hp\Desktop\dastone\resources\views/partials/position_actions.blade.php ENDPATH**/ ?>