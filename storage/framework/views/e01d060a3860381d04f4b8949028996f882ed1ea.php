<div class="modal fade" id="AddEmployeeForm" tabindex="-1" aria-labelledby="AddEmployeeFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container" id="formContainer">
                <form id="registrationForm" action="<?php echo e(route('storeemployee')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="last_name">Эцэг/эхийн нэр:</label>
                            <input class="form-control" type="text" id="last_name" name="LASTNAME" required pattern="^[^0-9]*$" title="Lastname must not contain numbers">

                            <label for="reg_number">Регистрийн дугаар:</label>
                            <input class="form-control" type="text" id="reg_number" name="REGISTER" required pattern="[A-Za-z]{2}[0-9]{8}" title="The first 2 digits must be letters and the next 8 digits must be numbers">

                            <label for="position">Албан тушаал:</label>
                            <select class="form-control" id="position" name="POS_ID" required>
                                <option value="">[Сонгоно уу]</option>
                                <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($position->POS_ID); ?>"><?php echo e($position->POS_NAME); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <label for="phone_number">Гар утасны дугаар:</label>
                            <input class="form-control" type="text" id="phone_number" name="HANDPHONE" required pattern="[6-9][0-9]{7}" title="Mobile phone number must be 8 digits and cannot start with numbers 1-5">

                            <label for="birth_date">Төрсөн өдөр:</label>
                            <input class="form-control" type="date" id="birth_date" name="BIRTHDATE" required>

                            <label for="work_number">Ажлын утасны дугаар:</label>
                            <input class="form-control" type="text" id="work_number" name="WORKPHONE" pattern="[6-9][0-9]{7}" title="Work phone number must be 8 digits and cannot start with numbers 1-5">

                            <label for="state">Төлөв:</label>
                            <select class="form-control" id="state" name="STATUS" required>
                                <option value="N">Идэвхгүй</option>
                                <option value="A">Идэвхтэй</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="first_name">Өөрийн нэр:</label>
                            <input class="form-control" type="text" id="first_name" name="FIRSTNAME" required pattern="^[^0-9]*$" title="Firstname must not contain numbers">

                            <label for="place">Газар нэгж:</label>
                            <select class="form-control" id="place" name="DEP_ID" required>
                                <option value="">[Сонгоно уу]</option>
                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($department->DEP_ID); ?>"><?php echo e($department->DEP_NAME); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <label for="email">И-мэйл:</label>
                            <input class="form-control" type="email" id="email" name="EMAIL" required>

                            <label for="gender">Хүйс:</label>
                            <select class="form-control" id="gender" name="SEX" required>
                                <option value="male">Эрэгтэй</option>
                                <option value="female">Эмэгтэй</option>
                            </select>

                            <label for="start_date">Ажилд орсон өдөр:</label>
                            <input class="form-control" type="date" id="start_date" name="WORK_DATE" required>

                            <label for="home_number">Гэрийн утасны дугаар:</label>
                            <input class="form-control" type="text" id="home_number" name="HOMEPHONE" pattern="[6-9][0-9]{7}" title="Home phone number must be 8 digits and cannot start with numbers 1-5">

                            <label for="photo">Зураг:</label>
                            <input class="form-control" type="file" id="photo" name="PICTURE_LINK">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-right">
                            <button class="btn btn-primary" type="submit" name="submit">Хадгалах</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\pc\Documents\GitHub\dastone\resources\views\modal\addemployee.blade.php ENDPATH**/ ?>