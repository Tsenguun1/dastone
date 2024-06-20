<div class="form-container" id="formContainer">
    <form id="feeForm" action="{{ route('updatefee', $fee->FEE_ID) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="feeName" class="form-check-label">Шимтгэлийн нэр</label>
        <input type="text" class="form-control" id="feeName" name="feeName" value="{{ $fee->FEE_NAME }}" required>

        <label for="feeDescr" class="form-check-label">Тайлбар</label>
        <textarea class="form-control" id="feeDescr" name="feeDescr" required>{{ $fee->FEE_DESCR }}</textarea>

        <label for="feeTXN" class="form-check-label">Гүйлгээний Утга</label>
        <input type="text" class="form-control" id="feeTXN" name="feeTXN" value="{{ $fee->TXN_DESC }}" required>

        <label for="feeOrder" class="form-check-label">Эрэмбэ</label>
        <input type="number" class="form-check-input" id="feeOrder" name="feeOrder" value="{{ $fee->ORDER_NO }}" required>

        <label for="feeType" class="form-check-label">Шимтгэлийн төрөл</label>
        <input type="text" class="form-control" id="feeType" name="feeType" value="{{ $fee->FEE_TYPE }}" required>

        <label for="feeStatus" class="form-check-label">Төлөв</label>
        <select id="feeStatus" name="feeStatus" class="form-control" required>
            <option value="A" {{ $fee->STATUS == 'A' ? 'selected' : '' }}>Идэвхитэй</option>
            <option value="N" {{ $fee->STATUS == 'N' ? 'selected' : '' }}>Идэвхгүй</option>
        </select>

        <label for="start_date" class="form-check-label">Гүйлгээ хийж эхлэх огноо:</label>
        <input class="form-control" type="date" id="start_date" name="start_date" value="{{ old('start_date', date('Y-m-d', strtotime($fee->FEE_STARTDATE))) }}" required>

        <label for="feesql" class="form-check-label">Томъёо</label>
        <label for="feesql" class="form-check-label">Заавал байх талбарууд: (TOT_REQUIST_NO, MAIN_JRNO, PAN, DT_ACNTNO, DT_AMOUNT, DT_CURCODE, DT_CURRATE, CR_ACNTNO, CR_ACNTNAME, CT_SYSNO, CR_AMOUNT, CR_CURCODE, CR_CURRADE, TXN_DESC)</label>
        <textarea class="form-control" id="feesql" name="feesql" style="margin-bottom:10px;" required>{{ $fee->FEE_SQL }}</textarea>

        <button type="submit" class="btn btn-primary">Хадгалах</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
    </form>
</div>
