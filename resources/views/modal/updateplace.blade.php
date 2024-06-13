<div class="modal fade" id="UpdatePlaceForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
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
                <form id="registrationForm" method="POST" action="{{ route('updateplace') }}">
                    @csrf
                    <input type="hidden" id="modal-dep-id" name="depId">
                    <label for="depName" class="form-check-label">Газар нэгжийн нэршил</label>
                    <input type="text" class="form-check-input" id="depName" name="depName" required>

                    <label for="status" class="form-check-label">Төлөв</label>
                    <select id="status" name="status" required>
                        <option value="A">Идэвхитэй</option>
                        <option value="N">Идэвхгүй</option>
                    </select>

                    <label for="sortOrder" class="form-check-label">Эрэмбэ</label>
                    <input type="text" class="form-check-input" id="sortOrder" name="sortOrder">

                    <label for="parentDepId" class="form-check-label">Эцэг газар нэгж</label>
                    <select id="parentDepId" name="parentDepId" required>
                        <option value="">[Сонгоно уу]</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->DEP_ID }}">{{ $department->DEP_NAME }}</option>
                        @endforeach
                    </select>

                    <label for="directorEmpId" class="form-check-label">Захирал</label>
                    <select id="directorEmpId" name="directorEmpId" required>
                        <option value="">[Сонгоно уу]</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->EMP_ID }}">{{ $employee->EMPNAME }} ({{ $employee->DEP_NAME }} - {{ $employee->POS_NAME }})</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary" type="submit" name="submit">Update</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
                </form>
            </div> 
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->
