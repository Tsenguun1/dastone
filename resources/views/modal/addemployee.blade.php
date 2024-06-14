<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('#UpdateEmployeeForm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var empId = button.data('id');
            var lastName = button.data('lastname');
            var firstName = button.data('firstname');
            var regNumber = button.data('regnumber');
            var position = button.data('position');
            var phoneNumber = button.data('phonenumber');
            var birthDate = button.data('birthdate');
            var workNumber = button.data('worknumber');
            var state = button.data('state');
            var place = button.data('place');
            var email = button.data('email');
            var gender = button.data('gender');
            var startDate = button.data('startdate');
            var homeNumber = button.data('homenumber');
            var photo = button.data('photo');

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
            modal.find('#place').val(place);
            modal.find('#email').val(email);
            modal.find('#gender').val(gender);
            modal.find('#start_date').val(startDate);
            modal.find('#home_number').val(homeNumber);
            // Handle photo preview or other logic if needed
        });
    });
</script>

<div class="modal fade" id="UpdateEmployeeForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container" id="formContainer">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="container mt-5">
                    <form id="registrationForm" method="POST" action="{{ route('updateemployee') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="modal-emp-id" name="EMP_ID">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="last_name">Эцэг/эхийн нэр:</label>
                                <input class="form-control" type="text" id="last_name" name="LASTNAME" required>

                                <label class="form-label" for="reg_number">Регистрийн дугаар:</label>
                                <input class="form-control" type="text" id="reg_number" name="REGISTER" required>

                                <label class="form-label" for="position">Албан тушаал:</label>
                                <select class="form-control" id="position" name="POS_ID" required>
                                    <option value="">[Сонгоно уу]</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->POS_ID }}">{{ $position->POS_NAME }}</option>
                                    @endforeach
                                </select>

                                <label class="form-label" for="phone_number">Гар утасны дугаар:</label>
                                <input class="form-control" type="text" id="phone_number" name="HANDPHONE" required>

                                <label class="form-label" for="birth_date">Төрсөн өдөр:</label>
                                <input class="form-control" type="date" id="birth_date" name="BIRTHDATE" required>

                                <label class="form-label" for="work_number">Ажлын утасны дугаар:</label>
                                <input class="form-control" type="text" id="work_number" name="WORKPHONE">

                                <label class="form-label" for="state">Төлөв:</label>
                                <select class="form-control" id="state" name="STATUS" required>
                                    <option value="N">Идэвхгүй</option>
                                    <option value="A">Идэвхтэй</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="first_name">Өөрийн нэр:</label>
                                <input class="form-control" type="text" id="first_name" name="FIRSTNAME" required>

                                <label class="form-label" for="place">Газар нэгж:</label>
                                <select class="form-control" id="place" name="DEP_ID" required>
                                    <option value="">[Сонгоно уу]</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->DEP_ID }}">{{ $department->DEP_NAME }}</option>
                                    @endforeach
                                </select>

                                <label class="form-label" for="email">И-мэйл:</label>
                                <input class="form-control" type="email" id="email" name="EMAIL" required>

                                <label class="form-label" for="gender">Хүйс:</label>
                                <select class="form-control" id="gender" name="SEX" required>
                                    <option value="male">Эрэгтэй</option>
                                    <option value="female">Эмэгтэй</option>
                                </select>

                                <label class="form-label" for="start_date">Ажилд орсон өдөр:</label>
                                <input class="form-control" type="date" id="start_date" name="WORK_DATE" required>

                                <label class="form-label" for="home_number">Гэрийн утасны дугаар:</label>
                                <input class="form-control" type="text" id="home_number" name="HOMEPHONE">

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


<div class="modal fade" id="AddEmployeeForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container" id="formContainer">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="container mt-5">
                    <form id="registrationForm" method="POST" action="{{ route('addformemployee') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="last_name">Эцэг/эхийн нэр:</label>
                                <input class="form-control" type="text" id="last_name" name="LASTNAME" required>

                                <label class="form-label" for="reg_number">Регистрийн дугаар:</label>
                                <input class="form-control" type="text" id="reg_number" name="REGISTER" required>

                                <label class="form-label" for="position">Албан тушаал:</label>
                                <select class="form-control" id="position" name="POS_ID" required>
                                    <option value="">[Сонгоно уу]</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->POS_ID }}">{{ $position->POS_NAME }}</option>
                                    @endforeach
                                </select>

                                <label class="form-label" for="phone_number">Гар утасны дугаар:</label>
                                <input class="form-control" type="text" id="phone_number" name="HANDPHONE" required>

                                <label class="form-label" for="birth_date">Төрсөн өдөр:</label>
                                <input class="form-control" type="date" id="birth_date" name="BIRTHDATE" required>

                                <label class="form-label" for="work_number">Ажлын утасны дугаар:</label>
                                <input class="form-control" type="text" id="work_number" name="WORKPHONE">

                                <label class="form-label" for="state">Төлөв:</label>
                                <select class="form-control" id="state" name="STATUS" required>
                                    <option value="N">Идэвхгүй</option>
                                    <option value="A">Идэвхтэй</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="first_name">Өөрийн нэр:</label>
                                <input class="form-control" type="text" id="first_name" name="FIRSTNAME" required>

                                <label class="form-label" for="place">Газар нэгж:</label>
                                <select class="form-control" id="place" name="DEP_ID" required>
                                    <option value="">[Сонгоно уу]</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->DEP_ID }}">{{ $department->DEP_NAME }}</option>
                                    @endforeach
                                </select>

                                <label class="form-label" for="email">И-мэйл:</label>
                                <input class="form-control" type="email" id="email" name="EMAIL" required>

                                <label class="form-label" for="gender">Хүйс:</label>
                                <select class="form-control" id="gender" name="SEX" required>
                                    <option value="male">Эрэгтэй</option>
                                    <option value="female">Эмэгтэй</option>
                                </select>

                                <label class="form-label" for="start_date">Ажилд орсон өдөр:</label>
                                <input class="form-control" type="date" id="start_date" name="WORK_DATE" required>

                                <label class="form-label" for="home_number">Гэрийн утасны дугаар:</label>
                                <input class="form-control" type="text" id="home_number" name="HOMEPHONE">

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
