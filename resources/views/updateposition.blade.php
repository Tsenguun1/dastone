@extends('viewplace')

@section('viewform')
<div class="form-container-update" style='position: absolute; top: 10%; z-index: 1; background-color: white' id="formContainerUpdate">
    <form method="POST" action="{{ route('updateposition', ['id' => $place['POS_ID']]) }}">
        @csrf
        <label for="posName" class="form-check-label">Албан тушаалын нэршил:</label>
        
        <input type="text" id="posName" name="posName" class="form-check-input" value="{{ $place['POS_NAME'] }}" required><br>

        <label for="status" class="form-check-label">Төлөв:</label>
        <select id="status" name="status" required>
            
            <option value="A" @if ($place['STATUS'] == 'A') selected @endif>Идэвхитэй</option>
            <option value="N" @if ($place['STATUS'] == 'N') selected @endif>Идэвхгүй</option>
        </select><br>

        <label for="sortOrder" class="form-check-label">Эрэмбэ:</label>
        <input type="text" class="form-check-input" id="sortOrder" name="sortOrder" value="{{ $place['SORT_ORDER'] }}"><br>

        <button class="btn btn-primary" type="submit">Засах</button>
        <button class="btn btn-danger" type="button" onclick="window.location='{{ route('viewposition') }}'">Буцах</button>
    </form>
</div>
@endsection
