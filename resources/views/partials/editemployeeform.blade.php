<div class="form-container" id="formContainer">
    <div class="container mt-5">
        <form id="registrationForm" action="{{ route('updateemployee', $employee->EMP_ID) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="EMP_ID" value="{{ $employee->EMP_ID }}">

            @if($employee->PICTURE_LINK)
                <img src="{{ asset($employee->PICTURE_LINK) }}" alt="Employee Picture" class="img-thumbnail mt-2"
                    style=" width:100px; height:100px; border-radius:50%; margin:1px; margin-top : -50px;">
            @endif
            <div class="row">
                <div class="col-md-6">
                    <label for="REGISTER" class="form-check-label">Регистр</label>
                    <input type="text" class="form-control" id="REGISTER" name="REGISTER"
                        value="{{ $employee->REGISTER }}" required minlength="10" maxlength="10" size="10">

                    <label for="FIRSTNAME" class="form-check-label">Эцэг/эхийн нэр</label>
                    <input type="text" class="form-control" id="FIRSTNAME" name="FIRSTNAME"
                        value="{{ $employee->FIRSTNAME }}" required>

                    <label for="LASTNAME" class="form-check-label">Өөрийн нэр</label>
                    <input type="text" class="form-control" id="LASTNAME" name="LASTNAME"
                        value="{{ $employee->LASTNAME }}" required>

                    <label for="DEP_ID" class="form-check-label">Газар нэгж</label>
                    <select id="DEP_ID" name="DEP_ID" class="form-control" required>
                        @foreach ($departments as $department)
                            <option value="{{ $department->DEP_ID }}" {{ $department->DEP_ID == $employee->DEP_ID ? 'selected' : '' }}>{{ $department->DEP_NAME }}</option>
                        @endforeach
                    </select>
                    <label for="POS_ID" class="form-check-label">Албан тушаал</label>
                    <select id="POS_ID" name="POS_ID" class="form-control" required>
                        @foreach ($positions as $position)
                            <option value="{{ $position->POS_ID }}" {{ $position->POS_ID == $employee->POS_ID ? 'selected' : '' }}>
                                {{ $position->POS_NAME }}
                            </option>
                        @endforeach
                    </select>
                    <label for="EMAIL" class="form-check-label">Цахим шуудан</label>
                    <input type="email" class="form-control" id="EMAIL" name="EMAIL" value="{{ $employee->EMAIL }}"
                        required>

                    <div class="form-group">
                        <label for="WORK_DATE" class="form-check-label">Ажилд орсон огноо</label>
                        <input type="date" class="form-control" id="WORK_DATE" name="WORK_DATE"
                            value="{{ old('WORK_DATE', $employee->WORK_DATE ? date('Y-m-d', strtotime($employee->WORK_DATE)) : '') }}"
                            max="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="STATUS" class="form-check-label">Төлөв</label>
                    <select id="STATUS" name="STATUS" class="form-control" required>
                        <option value="A" {{ $employee->STATUS == 'A' ? 'selected' : '' }}>Идэвхитэй</option>
                        <option value="N" {{ $employee->STATUS == 'N' ? 'selected' : '' }}>Идэвхгүй</option>
                    </select>

                    <label for="HANDPHONE" class="form-check-label">Гар утас</label>
                    <input type="text" class="form-control" id="HANDPHONE" name="HANDPHONE"
                        value="{{ $employee->HANDPHONE }}" required minlength="8" maxlength="8" size="8">
                    <label for="HOMEPHONE" class="form-check-label">Гэрийн утас</label>
                    <input type="text" class="form-control" id="HOMEPHONE" name="HOMEPHONE"
                        value="{{ $employee->HOMEPHONE }}" minlength="8" maxlength="8" size="8">

                    <label for="WORKPHONE" class="form-check-label">Ажлын утас</label>
                    <input type="text" class="form-control" id="WORKPHONE" name="WORKPHONE"
                        value="{{ $employee->WORKPHONE }}" minlength="8" maxlength="10" size="10">

                    <label for="SEX" class="form-check-label">Хүйс</label>
                    <select id="SEX" name="SEX" class="form-control" required>
                        <option value="M" {{ $employee->SEX == 'M' ? 'selected' : '' }}>Эрэгтэй</option>
                        <option value="F" {{ $employee->SEX == 'F' ? 'selected' : '' }}>Эмэгтэй</option>
                    </select>
                    <label for="PICTURE_LINK" class="form-check-label">Зураг</label>
                    <input type="file" class="form-control" id="PICTURE_LINK" name="PICTURE_LINK">
                    <div class="form-group">
                        <label for="BIRTHDATE" class="form-check-label">Төрсөн огноо</label>
                        <input type="date" class="form-control" id="BIRTHDATE" name="BIRTHDATE"
                            value="{{ old('BIRTHDATE', date('Y-m-d', strtotime($employee->BIRTHDATE))) }}"
                            max="1999-12-31" required>

                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <button type="submit" class="btn btn-primary mt-3" id="saveEmployeeChanges">Засах</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
            </div>
        </form>
    </div>
</div>