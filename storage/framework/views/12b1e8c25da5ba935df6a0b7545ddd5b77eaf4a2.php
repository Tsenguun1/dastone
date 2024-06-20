<div class="modal fade" id="AddPositionForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container" id="formContainer">
                <?php echo csrf_field(); ?>
                <form id="registrationForm" method="POST" action="<?php echo e(route('addformpos')); ?>">

                    <label for="posName" class="form-check-label">Албан тушаалын нэршил</label>
                    <input type="text" class="form-check-input" id="posName" name="posName" required>

                    <label for="status" class="form-check-label">Төлөв</label>
                    <select id="status" name="status" required>
                        <option value="A">Идэвхитэй</option>
                        <option value="N">Идэвхгүй</option>
                    </select>

                    <label for="sortOrder" class="form-check-label">Эрэмбэ</label>
                    <input type="text" class="form-check-input" id="sortOrder" name="sortOrder" required>

                    <button class="btn btn-primary" type="submit" name="submit">Хадгалах</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
                </form>
            </div><!--end modal-content-->
        </div>
    </div><!--end modal-dialog-->
</div><!--end modal--><?php /**PATH C:\Users\hp\Desktop\dastone\resources\views/modal/addposition.blade.php ENDPATH**/ ?>