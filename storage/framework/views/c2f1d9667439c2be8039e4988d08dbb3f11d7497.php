<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 
<script>
    $(document).ready(function () {
        $('#UpdateEmployeeForm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var empId = button.data('id');
            var lastName = button.data('lastname');
            var firstName = button.data('firstname');
            var regNumber = button.data('register'); // Updated to match the data attribute correctly
            var position = button.data('posid');
            var phoneNumber = button.data('handphone');
            var birthDate = button.data('birthdate');
            var workNumber = button.data('workphone');
            var state = button.data('state');
            var department_id = button.data('depid');
            var email = button.data('email');
            var gender = button.data('sex');
            var startDate = button.data('startdate');
            var homeNumber = button.data('homephone');
            var photo = button.data('photo');
            var wdate = button.data('workdate');
            var modal = $(this);
            modal.find('#modal-emp-id').val(empId);
            modal.find('#last_name').val(lastName);
            modal.find('#first_name').val(firstName);
            modal.find('#reg_number').val(regNumber);
            modal.find('#position').val(position);
            modal.find('#phone_number').val(phoneNumber);
            modal.find('#birth_date').val(birthDate);
            modal.find('#work_number').val(workNumber);
            modal.find('#state').val(state);
            modal.find('#place').val(department_id);
            modal.find('#email').val(email);
            modal.find('#gender').val(gender);
            modal.find('#start_date').val(wdate);
            modal.find('#home_number').val(homeNumber);
            modal.find('#Photo').val(photo);
            // Handle photo preview or other logic if needed
        });
    });
    document.getElementById('addEmployeeForm').addEventListener('submit', function(event) {
        var regNumber = document.getElementById('reg_number').value;
        var phoneNumber = document.getElementById('phone_number').value;
        var workNumber = document.getElementById('work_number').value;
        var homeNumber = document.getElementById('home_number').value;
        var firstName = document.getElementById('first_name').value;
        var lastName = document.getElementById('last_name').value;
 
        var regNumberPattern = /^[A-Za-z]{2}[0-9]{8}$/;
        var phonePattern = /^[6-9][0-9]{7}$/;
        var namePattern = /^[^0-9]*$/;
 
        if (!regNumberPattern.test(regNumber)) {
            alert('The registration number must start with 2 letters followed by 8 numbers.');
            event.preventDefault();
        }
 
        if (!phonePattern.test(phoneNumber)) {
            alert('Mobile phone number must be 8 digits and cannot start with numbers 1-5.');
            event.preventDefault();
        }
 
        if (workNumber && !phonePattern.test(workNumber)) {
            alert('Work phone number must be 8 digits and cannot start with numbers 1-5.');
            event.preventDefault();
        }
 
        if (homeNumber && !phonePattern.test(homeNumber)) {
            alert('Home phone number must be 8 digits and cannot start with numbers 1-5.');
            event.preventDefault();
        }
 
        if (!namePattern.test(firstName)) {
            alert('Firstname must not contain numbers.');
            event.preventDefault();
        }
 
        if (!namePattern.test(lastName)) {
            alert('Lastname must not contain numbers.');
            event.preventDefault();
        }
    });
</script>
 
 
<div class="modal fade" id="UpdateEmployeeForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container" id="formContainer">
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="container mt-5">
                    <form id="updateEmployeeForm" method="POST" action="<?php echo e(route('updateemployee')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="modal-emp-id" name="EMP_ID">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="last_name">Эцэг/эхийн нэр:</label>
                                <input class="form-control" type="text" id="last_name" name="LASTNAME" required
                                       pattern="^[^0-9]*$" title="Lastname must not contain numbers">
                   
                                <label class="form-label" for="reg_number">Регистрийн дугаар:</label>
                                <input class="form-control" type="text" id="reg_number" name="REGISTER" required
                                       pattern="[A-Za-z]{2}[0-9]{8}" title="The first 2 digits must be letters and the next 8 digits must be numbers">
                   
                                <label class="form-label" for="position">Албан тушаал:</label>
                                <select class="form-control" id="position" name="POS_ID" required>
                                    <option value="">[Сонгоно уу]</option>
                                    <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($position->POS_ID); ?>"><?php echo e($position->POS_NAME); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                   
                                <label class="form-label" for="phone_number">Гар утасны дугаар:</label>
                                <input class="form-control" type="text" id="phone_number" name="HANDPHONE" required
                                       pattern="[6-9][0-9]{7}" title="Mobile phone number must be 8 digits and cannot start with numbers 1-5">
                   
                                <label class="form-label" for="birth_date">Төрсөн өдөр:</label>
                                <input class="form-control" type="datetime-local" id="birth_date" name="BIRTHDATE" required>
                   
                                <label class="form-label" for="work_number">Ажлын утасны дугаар:</label>
                                <input class="form-control" type="text" id="work_number" name="WORKPHONE"
                                       pattern="[6-9][0-9]{7}" title="Work phone number must be 8 digits and cannot start with numbers 1-5">
                   
                                <label class="form-label" for="state">Төлөв:</label>
                                <select class="form-control" id="state" name="STATUS" required>
                                    <option value="N">Идэвхгүй</option>
                                    <option value="A">Идэвхтэй</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="first_name">Өөрийн нэр:</label>
                                <input class="form-control" type="text" id="first_name" name="FIRSTNAME" required
                                       pattern="^[^0-9]*$" title="Firstname must not contain numbers">
                   
                                <label class="form-label" for="place">Газар нэгж:</label>
                                <select class="form-control" id="place" name="DEP_ID" required>
                                    <option value="">[Сонгоно уу]</option>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->DEP_ID); ?>"><?php echo e($department->DEP_NAME); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                   
                                <label class="form-label" for="email">И-мэйл:</label>
                                <input class="form-control" type="email" id="email" name="EMAIL" required>
                   
                                <label class="form-label" for="gender">Хүйс:</label>
                                <select class="form-control" id="gender" name="SEX" required>
                                    <option value="male">Эрэгтэй</option>
                                    <option value="female">Эмэгтэй</option>
                                </select>
                   
                                <label class="form-label" for="start_date">Ажилд орсон өдөр:</label>
                                <input class="form-control" type="datetime-local" id="start_date" name="WORK_DATE" required>
                   
                                <label class="form-label" for="home_number">Гэрийн утасны дугаар:</label>
                                <input class="form-control" type="text" id="home_number" name="HOMEPHONE"
                                       pattern="[6-9][0-9]{7}" title="Home phone number must be 8 digits and cannot start with numbers 1-5">
                   
                                <label class="form-label" for="photo">Зураг:</label>
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
</div>
 
 
<div class="modal fade" id="AddEmployeeForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container" id="formContainer">
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="container mt-5">
                    <form id="addEmployeeForm" method="POST" action="<?php echo e(route('addformemployee')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="last_name">Эцэг/эхийн нэр:</label>
                                <input class="form-control" type="text" id="last_name" name="LASTNAME" required
                                       pattern="^[^0-9]*$" title="Lastname must not contain numbers">
                   
                                <label class="form-label" for="reg_number">Регистрийн дугаар:</label>
                                <input class="form-control" type="text" id="reg_number" name="REGISTER" required
                                       pattern="[A-Za-z]{2}[0-9]{8}" title="The first 2 digits must be letters and the next 8 digits must be numbers">
                   
                                <label class="form-label" for="position">Албан тушаал:</label>
                                <select class="form-control" id="position" name="POS_ID" required>
                                    <option value="">[Сонгоно уу]</option>
                                    <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($position->POS_ID); ?>"><?php echo e($position->POS_NAME); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                   
                                <label class="form-label" for="phone_number">Гар утасны дугаар:</label>
                                <input class="form-control" type="text" id="phone_number" name="HANDPHONE" required
                                       pattern="[6-9][0-9]{7}" title="Mobile phone number must be 8 digits and cannot start with numbers 1-5">
                   
                                <label class="form-label" for="birth_date">Төрсөн өдөр:</label>
                                <input class="form-control" type="datetime-local" id="birth_date" name="BIRTHDATE" required>
                   
                                <label class="form-label" for="work_number">Ажлын утасны дугаар:</label>
                                <input class="form-control" type="text" id="work_number" name="WORKPHONE"
                                       pattern="[6-9][0-9]{7}" title="Work phone number must be 8 digits and cannot start with numbers 1-5">
                   
                                <label class="form-label" for="state">Төлөв:</label>
                                <select class="form-control" id="state" name="STATUS" required>
                                    <option value="N">Идэвхгүй</option>
                                    <option value="A">Идэвхтэй</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="first_name">Өөрийн нэр:</label>
                                <input class="form-control" type="text" id="first_name" name="FIRSTNAME" required
                                       pattern="^[^0-9]*$" title="Firstname must not contain numbers">
                   
                                <label class="form-label" for="place">Газар нэгж:</label>
                                <select class="form-control" id="place" name="DEP_ID" required>
                                    <option value="">[Сонгоно уу]</option>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->DEP_ID); ?>"><?php echo e($department->DEP_NAME); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                   
                                <label class="form-label" for="email">И-мэйл:</label>
                                <input class="form-control" type="email" id="email" name="EMAIL" required>
                   
                                <label class="form-label" for="gender">Хүйс:</label>
                                <select class="form-control" id="gender" name="SEX" required>
                                    <option value="male">Эрэгтэй</option>
                                    <option value="female">Эмэгтэй</option>
                                </select>
                   
                                <label class="form-label" for="start_date">Ажилд орсон өдөр:</label>
                                <input class="form-control" type="datetime-local" id="start_date" name="WORK_DATE" required>
                   
                                <label class="form-label" for="home_number">Гэрийн утасны дугаар:</label>
                                <input class="form-control" type="text" id="home_number" name="HOMEPHONE"
                                       pattern="[6-9][0-9]{7}" title="Home phone number must be 8 digits and cannot start with numbers 1-5">
                   
                                <label class="form-label" for="photo">Зураг:</label>
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
</div><?php /**PATH C:\Users\pc\Documents\GitHub\dastoneTest\dastone\resources\views/modal/addemployee.blade.php ENDPATH**/ ?>