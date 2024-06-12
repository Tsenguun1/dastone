<div class="modal fade" id="AddPositionForm" tabindex="-1" aria-labelledby="AddPositionFormLabel" aria-hidden="true">
    <div class="form-container" style="background-color: white;">
        <form id="registrationForm" method="POST" action="{{ route('addformpos') }}">
            @csrf
            <div class="form-group">
                <label for="posName" class="form-check-label">Албан тушаалын нэршил</label>
                <input type="text" class="form-control" id="posName" name="posName" required>
            </div>
            <div class="form-group">
                <label for="status" class="form-check-label">Төлөв</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="A">Идэвхитэй</option>
                    <option value="N">Идэвхгүй</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sortOrder" class="form-check-label">Эрэмбэ</label>
                <input type="text" class="form-control" id="sortOrder" name="sortOrder">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Хадгалах</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Буцах</button>
        </form>
    </div>
</div>