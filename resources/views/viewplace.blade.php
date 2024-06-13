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
                                        <th style=" text-align: center; ">Үйлдэл</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departmentTree as $department)
                                        @include('partials.department_row', ['department' => $department, 'level' => 0])
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
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const updatePlaceFormModal = document.getElementById('UpdatePlaceForm');
        updatePlaceFormModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const depId = button.getAttribute('data-id');
            const depName = button.getAttribute('data-name');
            const status = button.getAttribute('data-status');
            const sortOrder = button.getAttribute('data-sort');
            const parentDepId = button.getAttribute('data-parent');
            const directorEmpId = button.getAttribute('data-director');

            const modalDepIdInput = document.getElementById('modal-dep-id');
            const modalDepNameInput = document.getElementById('depName');
            const modalStatusInput = document.getElementById('status');
            const modalSortOrderInput = document.getElementById('sortOrder');
            const modalParentDepIdInput = document.getElementById('parentDepId');
            const modalDirectorEmpIdInput = document.getElementById('directorEmpId');

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