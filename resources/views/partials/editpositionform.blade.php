<div class="form-container" id="formContainer">
    <form id="registrationForm" action="{{ route('updateposition', $position->POS_ID) }}" method="POST">
        @csrf
        @method('PUT')
            <label for="posName">Ажлын байрны нэршил</label>
            <input type="text" class="form-control" id="posName" name="posName" value="{{ $position->POS_NAME }}"
                required>
            <label for="status">Төлөв</label>
            <select id="status" name="status" class="form-control" required>
                <option value="">[Сонгоно уу]</option>
                <option value="A" {{ $position->STATUS == 'A' ? 'selected' : '' }}>Идэвхитэй</option>
                <option value="N" {{ $position->STATUS == 'N' ? 'selected' : '' }}>Идэвхгүй</option>
            </select>
            <label for="sortOrder">Эрэмбэ</label>
            <input type="number" class="form-control" id="sortOrder" name="sortOrder"
                value="{{ $position->SORT_ORDER }}" required>
        <button type="submit" class="btn btn-primary">Хадгалах</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
    </form>
</div>