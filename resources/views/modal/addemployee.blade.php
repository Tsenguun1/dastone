<div class="modal fade" id="AddEmployeeForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel"
    aria-hidden="true">
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
                <form id="registrationForm" method="POST" action="{{ route('addformemployee') }}">
                    @csrf
                    <label for="register" class="form-check-label">Регистр</label>
                    <input type="text" class="form-check-input" id="register" name="register" required>

                    <label for="firstname" class="form-check-label">Нэр</label>
                    <input type="text" class="form-check-input" id="firstname" name="firstname" required>

                    <label for="lastname" class="form-check-label">Овог</label>
                    <input type="text" class="form-check-input" id="lastname" name="lastname" required>

                    <label for="pos_id" class="form-check-label">Албан тушаал</label>
                    <select id="pos_id" name="pos_id" required>
                        <option value="">[Сонгоно уу]</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->POS_ID }}">{{ $position->POS_NAME }}</option>
                        @endforeach
                    </select>

                    <label for="dep_id" class="form-check-label">Эцэг газар нэгж</label>
                    <select id="dep_id" name="dep_id" required>
                        <option value="">[Сонгоно уу]</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->DEP_ID }}">{{ $department->DEP_NAME }}</option>
                        @endforeach
                    </select>

                    <label for="email" class="form-check-label">И-мэйл</label>
                    <input type="email" class="form-check-input" id="email" name="email" required>

                    <!-- Add other fields as necessary -->

                    <button class="btn btn-primary" type="submit" name="submit">Хадгалах</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
                </form>
            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->
