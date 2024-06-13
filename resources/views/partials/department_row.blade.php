@php
    $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $level * 4);
@endphp
<tr>
    <td>{!! $indent !!}{{ $department->DEP_NAME }}</td>
    <td>{{ $department->DIRECTOR_EMPID }}</td>
    <td>{{ $department->STATUS }}</td>
    <td>{{ $department->SORT_ORDER }}</td>
    <td>{{ $department->EDIT_DATE }}</td>
    <td>
        <form action="{{ route('deleteplace', $department->DEP_ID) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type='submit' class='btn btn-danger' style="float: right;">Устгах</button>
        </form>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#UpdatePlaceForm"
            style="float: right;" data-id="{{ $department->DEP_ID }}" data-name="{{ $department->DEP_NAME }}"
            data-status="{{ $department->STATUS }}" data-sort="{{ $department->SORT_ORDER }}"
            data-parent="{{ $department->PARENT_DEPID }}"
            data-director="{{ $department->DIRECTOR_EMPID }}">Засах</button>
    </td>
</tr>

@if (!empty($department->children))
    @foreach ($department->children as $child)
        @include('partials.department_row', ['department' => $child, 'level' => $level + 1])
    @endforeach
@endif
