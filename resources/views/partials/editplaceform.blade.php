<!-- resources/views/partials/editplaceform.blade.php -->
<div class="form-container" id="formContainer">
<form id="editPlaceForm" method="POST" action="{{ route('updateplace', $place->DEP_ID) }}">
    @csrf
    @method('PUT')
    <label for="depName" class="form-check-label">Газар нэгжийн нэршил</label>
    <input type="text" class="form-check-input" id="depName" name="depName" value="{{ $place->DEP_NAME }}" required>

    <label for="status" class="form-check-label">Төлөв</label>
    <select id="status" name="status" required>
        <option value="">[Сонгоно уу]</option>
        <option value="A" {{ $place->STATUS == 'A' ? 'selected' : '' }}>Идэвхитэй</option>
        <option value="N" {{ $place->STATUS == 'N' ? 'selected' : '' }}>Идэвхгүй</option>
    </select>

    <label for="sortOrder" class="form-check-label">Эрэмбэ</label>
    <input type="number" class="form-check-input" id="sortOrder" name="sortOrder" value="{{ $place->SORT_ORDER }}" required>

    <label for="parentDepId" class="form-check-label">Эцэг газар нэгж</label>
    <select id="parentDepId" name="parentDepId" required>
        <option value="">[Сонгоно уу]</option>
        @foreach ($departments as $department)
            <option value="{{ $department->DEP_ID }}" {{ $place->PARENT_DEPID == $department->DEP_ID ? 'selected' : '' }}>{{ $department->DEP_NAME }}</option>
        @endforeach
    </select>

    <label for="directorEmpId" class="form-check-label">Захирал</label>
    <select id="directorEmpId" name="directorEmpId" required>
        <option value="">[Сонгоно уу]</option>
        @foreach ($employees as $employee)
            <option value="{{ $employee->EMP_ID }}" {{ $place->DIRECTOR_EMPID == $employee->EMP_ID ? 'selected' : '' }}>{{ $employee->EMPNAME }} ({{ $employee->DEP_NAME }}-{{ $employee->POS_NAME }})</option>
        @endforeach
    </select>
    <button class="btn btn-primary" type="submit" name="submit">Хадгалах</button>
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
</form>

</div>