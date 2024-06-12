<div class="modal fade" id="AddPositionForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container"  id="formContainer">
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
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->

<!-- addplace.blade.php -->
<div class="modal fade" id="UpdatePositionForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container" id="formContainer">
                <form method="POST" action="{{ route('updateposition') }}">
                    @csrf
                    <input type="hidden" name="POS_ID" id="modal-pos-id">
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
                    <button class="btn btn-primary" type="submit" name="submit">Засах</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
                </form>
            </div>
        </div>
    </div>
</div>