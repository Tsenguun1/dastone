

<?php $__env->startSection('content'); ?>
<div class="topbar">
    <nav class="navbar-custom">
        <h4 class="page-title" style="margin: 10px;">Ажилтны бүртгэл</h4>
    </nav>
</div>

<!-- Page Content-->
<div class="page-content">
    <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 15px;" data-bs-toggle="modal"
        data-bs-target="#AddEmployeeForm">+ Шинээр бүртгэх</button>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class='table-rep-plugin'>
                            <div class="mb-3">
                                <label for="statusFilter" class="form-check-label">Төлөв:</label>
                                <select id="statusFilter" class="form-control">
                                    <option value="">Бүх</option>
                                    <option value="A">Идэвхитэй</option>
                                    <option value="N">Идэвхгүй</option>
                                </select>
                            </div>
                            <div class="table-responsive">
                                <table id="datatable"
                                    class="table table-bordered dt-responsive nowrap table-striped mb-0"
                                    style="border-collapse: collapse; width: 100%; font-size:10px;">
                                    <thead>
                                        <tr>
                                            <th>Зураг</th>
                                            <th>Эцэг/эхийн нэр</th>
                                            <th>Өөрийн нэр</th>
                                            <th class="dept-col">Газар нэгж</th>
                                            <th class="pos-col">Албан тушаал</th>
                                            <th>Регистр</th>
                                            <th>Хүйс</th>
                                            <th>Цахим шуудан</th>
                                            <th>Төрсөн огноо</th>
                                            <th>Гар утас</th>
                                            <th>Ажлын утас</th>
                                            <th>Төлөв</th>
                                            <th>Үйлдэл</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>

<!-- Edit Employee Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <!-- Modal content will be loaded here via AJAX -->
        </div>
    </div>
</div>

<div class="modal fade" id="AddEmployeeForm" tabindex="-1" aria-labelledby="AddEmployeeFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container" id="formContainer">
                <form id="registrationForm" action="<?php echo e(route('storeemployee')); ?>" method="POST"
                    enctype="multipart/form-data" novalidate>
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="last_name">Эцэг/эхийн нэр:</label>
                            <input class="form-control" type="text" id="last_name" name="LASTNAME" required
                                pattern="^[^0-9]*$" title="Lastname must not contain numbers"
                                placeholder="Lastname">
                            <div class="invalid-feedback" id="last_name_error"></div>

                            <label for="reg_number">Регистрийн дугаар:</label>
                            <input class="form-control" type="text" id="reg_number" name="REGISTER" required
                                pattern="[A-Za-z]{2}[0-9]{8}"
                                title="The first 2 characters must be letters and the next 8 digits must be numbers"
                                minlength="10" maxlength="10" size="10" placeholder="AA12345678">
                            <div class="invalid-feedback" id="reg_number_error"></div>

                            <label for="position">Албан тушаал:</label>
                            <select class="form-control" id="position" name="POS_ID" required>
                                <option value="">[Сонгоно уу]</option>
                                <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($position->POS_ID); ?>"><?php echo e($position->POS_NAME); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <label for="phone_number">Гар утасны дугаар:</label>
                            <input class="form-control" type="text" id="phone_number" name="HANDPHONE" required
                                pattern="[6-9][0-9]{7}"
                                title="Mobile phone number must be 8 digits and cannot start with numbers 1-5"
                                minlength="8" maxlength="8" size="8" >
                            <div class="invalid-feedback" id="phone_number_error"></div>

                            <label for="birth_date">Төрсөн өдөр:</label>
                            <input class="form-control" type="date" id="birth_date" name="BIRTHDATE" required>

                            <label for="work_number">Ажлын утасны дугаар:</label>
                            <input class="form-control" type="text" id="work_number" name="WORKPHONE"
                                pattern="[6-9][0-9]{7}"
                                title="Work phone number must be 8 digits and cannot start with numbers 1-5"
                                minlength="8" maxlength="10" size="10" >
                            <div class="invalid-feedback" id="work_number_error"></div>

                            <label for="state">Төлөв:</label>
                            <select class="form-control" id="state" name="STATUS" required>
                                <option value="N">Идэвхгүй</option>
                                <option value="A">Идэвхтэй</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="first_name">Өөрийн нэр:</label>
                            <input class="form-control" type="text" id="first_name" name="FIRSTNAME" required
                                pattern="^[^0-9]*$" title="Firstname must not contain numbers"
                                placeholder="Firstname">
                            <div class="invalid-feedback" id="first_name_error"></div>

                            <label for="place">Газар нэгж:</label>
                            <select class="form-control" id="place" name="DEP_ID" required>
                                <option value="">[Сонгоно уу]</option>
                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($department->DEP_ID); ?>"><?php echo e($department->DEP_NAME); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <label for="email">И-мэйл:</label>
                            <input class="form-control" type="email" id="email" name="EMAIL" required
                                placeholder="example@gmail.com">
                            <div class="invalid-feedback" id="email_error"></div>

                            <label for="gender">Хүйс:</label>
                            <select class="form-control" id="gender" name="SEX" required>
                                <option value="male">Эрэгтэй</option>
                                <option value="female">Эмэгтэй</option>
                            </select>

                            <label for="start_date">Ажилд орсон өдөр:</label>
                            <input class="form-control" type="date" id="start_date" name="WORK_DATE" required>

                            <label for="home_number">Гэрийн утасны дугаар:</label>
                            <input class="form-control" type="text" id="home_number" name="HOMEPHONE"
                                pattern="[6-9][0-9]{7}"
                                title="Home phone number must be 8 digits and cannot start with numbers 1-5"
                                minlength="8" maxlength="8" size="8">
                            <div class="invalid-feedback" id="home_number_error"></div>

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



<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            ajax: {
                url: '<?php echo e(route('employeeListTable')); ?>',
                type: 'GET'
            },
            columns: [
                {
                    data: 'picture', name: 'picture', render: function (data) {
                        return '<img src="' + data + '" alt="Employee Picture" width="30" height="30">';
                    }, orderable: false, searchable: false
                },
                { data: 'lastname', name: 'lastname' },
                { data: 'firstname', name: 'firstname' },
                { data: 'department', name: 'department', className: 'dept-col', searchable: false },
                { data: 'position', name: 'position', className: 'pos-col', searchable: false },
                { data: 'register', name: 'register' },
                { data: 'sex', name: 'sex', searchable: false },
                { data: 'email', name: 'email', searchable: false },
                { data: 'birthdate', name: 'birthdate', searchable: false },
                { data: 'handphone', name: 'handphone', searchable: false },
                { data: 'workphone', name: 'workphone', searchable: false },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],

            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/mn.json" // Mongolian translation
            },
            columnDefs: [
                { orderable: false, targets: 12 }  // Disable sorting on the 'Action' column
            ],
            order: []  // Disable initial sorting
        });

        // Status filter functionality
        $('#statusFilter').on('change', function () {
            var selectedStatus = $(this).val();
            table.column(11).search(selectedStatus).draw();
        });

        // Edit employee modal
        $('#editEmployeeModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var empId = button.data('id');
            var modal = $(this);

            $.ajax({
                url: '/editemployee/' + empId,
                method: 'GET',
                success: function (response) {
                    modal.find('.modal-content').html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        // Save changes in the edit employee modal
        $(document).on('click', '#saveEmployeeChanges', function () {
            var form = $('#editEmployeeModal').find('form');
            var formData = new FormData(form[0]);

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#editEmployeeModal').modal('hide');
                    table.ajax.reload(); // Reload the DataTable to see the changes
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('start_date').setAttribute('max', today);
    });

    document.addEventListener('DOMContentLoaded', function () {
        var maxDate = new Date('1999-12-31').toISOString().split('T')[0];
        document.getElementById('birth_date').setAttribute('max', maxDate);
    });


    document.addEventListener('DOMContentLoaded', function () {
        const fields = [
            { id: 'last_name', errorId: 'last_name_error', pattern: /^[^0-9]*$/, errorMessage: 'Lastname must not contain numbers' },
            { id: 'reg_number', errorId: 'reg_number_error', pattern: /^[A-Za-z]{2}[0-9]{8}$/, errorMessage: 'The first 2 characters must be letters and the next 8 digits must be numbers' },
            { id: 'phone_number', errorId: 'phone_number_error', pattern: /^[6-9][0-9]{7}$/, errorMessage: 'Mobile phone number must be 8 digits and cannot start with numbers 1-5' },
            { id: 'work_number', errorId: 'work_number_error', pattern: /^[6-9][0-9]{7}$/, errorMessage: 'Work phone number must be 8 digits and cannot start with numbers 1-5' },
            { id: 'first_name', errorId: 'first_name_error', pattern: /^[^0-9]*$/, errorMessage: 'Firstname must not contain numbers' },
            { id: 'home_number', errorId: 'home_number_error', pattern: /^[6-9][0-9]{7}$/, errorMessage: 'Home phone number must be 8 digits and cannot start with numbers 1-5' },
            { id: 'email', errorId: 'email_error', type: 'email', errorMessage: 'Enter a valid email address' }
        ];

        fields.forEach(field => {
            const input = document.getElementById(field.id);
            const error = document.getElementById(field.errorId);

            input.addEventListener('input', function () {
                if (field.pattern) {
                    if (!field.pattern.test(input.value)) {
                        input.classList.add('is-invalid');
                        error.textContent = field.errorMessage;
                    } else {
                        input.classList.remove('is-invalid');
                        error.textContent = '';
                    }
                } else if (field.type === 'email') {
                    if (!input.checkValidity()) {
                        input.classList.add('is-invalid');
                        error.textContent = field.errorMessage;
                    } else {
                        input.classList.remove('is-invalid');
                        error.textContent = '';
                    }
                }
            });
        });
    });

</script>


<style>
    .invalid-feedback {
        display: block;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hp\Desktop\dastone\resources\views/viewemployee.blade.php ENDPATH**/ ?>