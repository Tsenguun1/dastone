@extends('layouts.app')
@section('content')
<div class="topbar">
    <nav class="navbar-custom">
        <h4 class="page-title" style="margin: 10px;">Газар нэгжийн бүртгэл</h4>
    </nav>
</div>

<div class="page-content">
    <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 15px;" data-bs-toggle="modal"
        data-bs-target="#AddPlaceForm">+ Шинээр бүртгэх</button>
    <div class="container-fluid"></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class='table-rep-plugin'>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped mb-0"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
        </div> <!-- end col -->
    </div> <!-- end row -->
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