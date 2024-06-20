<div class="modal-header">
    <h5 class="modal-title" id="detailsFeeModalLabel">Дэлгэрэнгүй</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="feeDetailsForm">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="feeName" class="form-check-label">Шимтгэлийн ID : <?php echo e($fee->FEE_ID); ?></label>
        </div>

        <div class="mb-3">
            <label for="feeName" class="form-check-label">Шимтгэлийн нэр : <?php echo e($fee->FEE_NAME); ?></label>
        </div>

        <div class="mb-3">
            <label for="feeDescr" class="form-check-label">Тайлбар : <?php echo e($fee->FEE_DESCR); ?></label>
        </div>

        <div class="mb-3">
            <label for="feeTXN" class="form-check-label">Гүйлгээний Утга : <?php echo e($fee->TXN_DESC); ?></label>
        </div>

        <div class="mb-3">
            <label for="feeOrder" class="form-check-label">Эрэмбэ : <?php echo e($fee->ORDER_NO); ?></label>
        </div>

        <div class="mb-3">
            <label for="feeType" class="form-check-label">Шимтгэлийн төрөл : <?php echo e($fee->FEE_TYPE); ?></label>
        </div>

        <div class="mb-3">
            <label for="feeStatus" class="form-check-label">Төлөв : <?php echo e($fee->STATUSVALUE); ?></label>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-check-label">Гүйлгээ хийж эхлэх огноо: <?php echo e($fee->FEE_STARTDATE); ?></label>
        </div>

        <div class="mb-3">
            <label for="feesql" class="form-check-label">Томъёо : <?php echo e($fee->FEE_SQL); ?></label>
        </div>

        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
    </form>
</div>
<?php /**PATH C:\Users\hp\Desktop\dastone\resources\views/partials/detailsFee.blade.php ENDPATH**/ ?>