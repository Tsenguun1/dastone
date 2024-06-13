@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="topbar">
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav mb-0">
                <h4 class="page-title" style="margin: 10px;">Газар нэгжийн бүртгэл</h4>
                <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 10px; margin-top: 30px;"
                    data-bs-toggle="modal" data-bs-target="#AddPlaceForm">+ Шинээр бүртгэх</button>
                <div class='card-body'>
                    <div class='table-rep-plugin'>
                        <div class='table-responsive mb-0' data-pattern='priority-columns'>
                            <table id='tech-companies-1' class='table table-striped mb-0'>
                                <thead>
                                    <tr>
                                        <th>Нэр</th>
                                        <th>Захирал</th>
                                        <th>Төлөв</th>
                                        <th>Эрэмбэ</th>
                                        <th>Зассан</th>
                                        <th>Үйлдэл</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departments as $department)
                                    <tr>
                                        <td><span class='co-name'>{{ $department->DEP_NAME }}</span></td>
                                        <td>{{ $department->DIRECTOR_EMPID }}</td>
                                        <td>{{ $department->STATUS }}</td>
                                        <td>{{ $department->SORT_ORDER }}</td>
                                        <td>{{ $department->EDIT_DATE }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#UpdatePlaceForm"
                                            data-id="{{ $department->DEP_ID }}"
                                            data-name="{{ $department->DEP_NAME }}"
                                            data-status="{{ $department->STATUS }}"
                                            data-sort="{{ $department->SORT_ORDER }}"
                                            data-parent="{{ $department->PARENT_DEPID }}"
                                            data-director="{{ $department->DIRECTOR_EMPID }}">Update</button>
                                            <form action="{{ route('deleteplace', $department->DEP_ID) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type='submit' class='btn btn-danger'>Устгах</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </ul>
        </nav>
    </div>
</div>

@include('modal.addplace')
@include('modal.updateplace')
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const updatePlaceFormModal = document.getElementById('UpdatePlaceForm');
        updatePlaceFormModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            const button = event.relatedTarget;

            // Extract info from data-* attributes
            const depId = button.getAttribute('data-id');
            const depName = button.getAttribute('data-name');
            const status = button.getAttribute('data-status');
            const sortOrder = button.getAttribute('data-sort');
            const parentDepId = button.getAttribute('data-parent');
            const directorEmpId = button.getAttribute('data-director');

            // Update the modal's content
            const modalDepIdInput = document.getElementById('modal-dep-id');
            const modalDepNameInput = document.getElementById('modal-dep-name');
            const modalStatusInput = document.getElementById('modal-status');
            const modalSortOrderInput = document.getElementById('modal-sort-order');
            const modalParentDepIdInput = document.getElementById('modal-parent-dep-id');
            const modalDirectorEmpIdInput = document.getElementById('modal-director-emp-id');

            modalDepIdInput.value = depId;
            modalDepNameInput.value = depName;
            modalStatusInput.value = status;
            modalSortOrderInput.value = sortOrder;
            modalParentDepIdInput.value = parentDepId;
            modalDirectorEmpIdInput.value = directorEmpId;
        });
    });
</script>
@endsection
