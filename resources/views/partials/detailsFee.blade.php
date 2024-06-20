<div class="form-container" id="formContainer">
    <form id="feeDetailsForm">
        @csrf
        <div class="mb-3">
            <label for="feeName" class="form-check-label">Шимтгэлийн : {{ $fee->FEE_ID }}</label>
        </div>

        <div class="mb-3">
            <label for="feeName" class="form-check-label">Шимтгэлийн нэр : {{ $fee->FEE_NAME }}</label>
        </div>

        <div class="mb-3">
            <label for="feeDescr" class="form-check-label">Тайлбар : {{ $fee->FEE_DESCR }}</label>
        </div>

        <div class="mb-3">
            <label for="feeTXN" class="form-check-label">Гүйлгээний Утга : {{ $fee->TXN_DESC }}</label>
        </div>

        <div class="mb-3">
            <label for="feeOrder" class="form-check-label">Эрэмбэ : {{ $fee->ORDER_NO }}</label>
        </div>

        <div class="mb-3">
            <label for="feeType" class="form-check-label">Шимтгэлийн төрөл : {{ $fee->FEE_TYPE }}</label>
        </div>

        <div class="mb-3">
            <label for="feeStatus" class="form-check-label">Төлөв : {{ $fee->STATUSVALUE}}</label>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-check-label">Гүйлгээ хийж эхлэх огноо:
                {{ $fee->FEE_STARTDATE}}</label>
        </div>

        <div class="mb-3">
            <label for="feesql" class="form-check-label">Томъёо : {{ $fee->FEE_SQL }}</label>
        </div>

        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
    </form>
</div>