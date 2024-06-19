<!-- modal.addfee -->
<div class="modal fade" id="AddFeeForm" tabindex="-1" role="dialog" aria-labelledby="addFeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <form id="newFeeForm" action="{{ route('addfee') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addFeeModalLabel">Шинэ хураамж нэмэх</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="feeName" class="form-check-label">Хураамжийн нэр</label>
                    <input type="text" class="form-control" id="feeName" name="feeName" required>

                    <label for="feeDescr" class="form-check-label">Тайлбар</label>
                    <textarea class="form-control" id="feeDescr" name="feeDescr" required></textarea>

                    <label for="feeType" class="form-check-label">Төрөл</label>
                    <input type="text" class="form-control" id="feeType" name="feeType" required>

                    <label for="feeOrder" class="form-check-label">Эрэмбэ</label>
                    <input type="number" class="form-check-input" id="feeOrder" name="feeOrder" required>

                    <label for="feeStatus" class="form-check-label">Байдал</label>
                    <select id="feeStatus" name="feeStatus" class="form-control" required>
                        <option value="A">Идэвхитэй</option>
                        <option value="N">Идэвхгүй</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
                </div>
            </form>
        </div>
    </div>
</div>
