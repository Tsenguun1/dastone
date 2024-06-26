<div class="modal fade" id="AddEmployeeForm" tabindex="-1" aria-labelledby="AddEmployeeFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container" id="formContainer">
                <form id="registrationForm" action="{{ route('storeemployee') }}" method="POST"
                    enctype="multipart/form-data" novalidate>
                    @csrf
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
                                @foreach($positions as $position)
                                    <option value="{{ $position->POS_ID }}">{{ $position->POS_NAME }}</option>
                                @endforeach
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
                                @foreach($departments as $department)
                                    <option value="{{ $department->DEP_ID }}">{{ $department->DEP_NAME }}</option>
                                @endforeach
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