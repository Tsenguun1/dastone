<!-- modal.addfee -->
<div class="modal fade" id="AddFeeForm" tabindex="-1" role="dialog" aria-labelledby="addFeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container" id="formContainer">
                <form id="registrationForm" action="<?php echo e(route('addfee')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <label for="feeName" class="form-check-label">Шимтгэлийн нэр</label>
                    <input type="text" class="form-control" id="feeName" name="feeName" required>

                    <label for="feeDescr" class="form-check-label">Тайлбар</label>
                    <textarea class="form-control" id="feeDescr" name="feeDescr" required></textarea>

                    <label for="feeTXN" class="form-check-label">Гүйлгээний Утга</label>
                    <input type="text" class="form-control" id="feeTXN" name="feeTXN" required>

                    <label for="feeOrder" class="form-check-label">Эрэмбэ</label>
                    <input type="number" class="form-control" id="feeOrder" name="feeOrder" required>

                    <label for="feeType" class="form-check-label">Шимтгэлийн төрөл</label>
                    <input type="text" class="form-control" id="feeType" name="feeType" required>

                    <label for="feeStatus" class="form-check-label">Төлөв</label>
                    <select id="feeStatus" name="feeStatus" class="form-control" required>
                        <option value="A">Идэвхитэй</option>
                        <option value="N">Идэвхгүй</option>
                    </select>

                    <label for="start_date" class="form-check-label">Гүйлгээ хийж эхлэх огноо:</label>
                    <input class="form-control" type="date" id="start_date" name="start_date" required>

                    <label for="feesql" class="form-check-label">Томъёо</label>
                    <label for="feesql" class="form-check-label">Заавал байх талбарууд: (TOT_REQUIST_NO, MAIN_JRNO, PAN, DT_ACNTNO, DT_AMOUNT, DT_CURCODE, DT_CURRATE, CR_ACNTNO, CR_ACNTNAME, CT_SYSNO, CR_AMOUNT, CR_CURCODE, CR_CURRADE, TXN_DESC)</label>
                    <textarea class="form-control" id="feesql" name="feesql" style="margin-bottom:10px;" required></textarea>

                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\pc\Documents\GitHub\dastone\resources\views/modal/addfee.blade.php ENDPATH**/ ?>