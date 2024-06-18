@php
    $indent = str_repeat('&nbsp;', $level * 15);
@endphp
<tr>
    <td>{!! $indent !!}{{ $department->DEP_NAME }}</td>
    <td>
        @if (!empty($department->DIRECTOR_FIRSTNAME) && !empty($department->DIRECTOR_LASTNAME))
            {{ $department->DIRECTOR_FIRSTNAME }} {{ $department->DIRECTOR_LASTNAME }}
        @else
            Director Not Assigned
        @endif
    </td>
    <td>{{ $department->STATUSVALUE }}</td>
    <td>{{ $department->SORT_ORDER }}</td>
    <td>{{ $department->EDIT_DATE }}</td>
    <td>
        <form action="{{ route('deleteplace', $department->DEP_ID) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type='submit' class='btn btn-danger' style="float: right;">Устгах</button>
        </form>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" style="float: right;"
            data-bs-target="#editPlaceModal" data-id="{{ $department->DEP_ID }}">
            Засах
        </button>
    </td>
</tr>

@if (!empty($department->children))
    @foreach ($department->children as $child)
        @include('partials.department_row', ['department' => $child, 'level' => $level + 1])
    @endforeach
@endif
