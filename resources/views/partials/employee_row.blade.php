<!-- resources/views/partials/employee_row.blade.php -->
<tr>
    <td><img src="{{ $employee->PICTURE_LINK }}" style="border-radius: 50%; width: 50px; height: 50px; object-fit: cover;" alt="Employee Picture" width="50"></td>
    <td>{{ $employee->FIRSTNAME }}</td>
    <td>{{ $employee->LASTNAME }}</td>
    <td>{{ $employee->DEP_NAME }}</td> <!-- Displaying Department Name -->
    <td>{{ $employee->POS_NAME }}</td> <!-- Displaying Position Name -->
    <td>{{ $employee->REGISTER }}</td>
    <td>{{ $employee->SEX }}</td>
    <td>{{ $employee->EMAIL }}</td>
    <td>{{ $employee->BIRTHDATE }}</td>
    <td>{{ $employee->HANDPHONE }}</td>
    <td>{{ $employee->WORKPHONE }}</td>
    <td>
        @if ($employee->STATUS == 'A')
            Идэвхитэй
        @elseif ($employee->STATUS == 'N')
            Идэвхгүй
        @else
            Unknown Status
        @endif
    </td>
    <td>
        <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#UpdateEmployeeForm'
            data-photo='{{ $employee->PICTURE_LINK }}' data-state='{{ $employee->STATUS }}' data-id='{{ $employee->EMP_ID }}'
            data-homephone='{{ $employee->HOMEPHONE }}' data-firstname='{{ $employee->FIRSTNAME }}'
            data-lastname='{{ $employee->LASTNAME }}' data-depid='{{ $employee->DEP_ID }}'
            data-posid='{{ $employee->POS_ID }}' data-register='{{ $employee->REGISTER }}'
            data-sex='{{ $employee->SEX }}' data-email='{{ $employee->EMAIL }}'
            data-birthdate='{{ $employee->BIRTHDATE }}' data-handphone='{{ $employee->HANDPHONE }}'
            data-workphone='{{ $employee->WORKPHONE }}' data-status='{{ $employee->STATUS }}'
            data-workdate='{{ $employee->WORK_DATE }}'>Засах</button>
            
        <form action="{{ route('deleteemployee', ['id' => $employee->EMP_ID]) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Устгах</button>
        </form>
    </td>
</tr>
