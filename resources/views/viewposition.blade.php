@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="topbar">
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav mb-0">
                <h4 class="page-title" style="margin: 10px;">Албан тушаалын бүртгэл</h4>
                <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 10px; margin-top: 30px;"
                    data-bs-toggle="modal" data-bs-target="#AddPositionForm">+ Шинээр бүртгэх</button>
                <div class='card-body'>
                    <div class='table-rep-plugin'>
                        <div class='table-responsive mb-0' data-pattern='priority-columns'>
                            <table id='positions-table' class='table table-striped mb-0'>
                                <thead>
                                    <tr>
                                        <th>Нэр</th>
                                        <th>Төлөв</th>
                                        <th>Эрэмбэ</th>
                                        <th>Зассан</th>
                                        <th style=" text-align: center; ">Үйлдэл</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($positions as $position)
                                        <tr>
                                            <td>{{ $position->POS_NAME }}</td>
                                            <td>{{ $position->STATUS }}</td>
                                            <td>{{ $position->SORT_ORDER }}</td>
                                            <td>{{ $position->EDIT_DATE }}</td>
                                            <td>
                                            <form action="{{ route('deleteposition', $position->POS_ID) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type='submit' class='btn btn-danger' style="float: right;">Устгах</button>
                                                </form>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                style="float: right;"
                                                    data-bs-target="#UpdatePositionForm" data-id="{{ $position->POS_ID }}"
                                                    data-name="{{ $position->POS_NAME }}"
                                                    data-status="{{ $position->STATUS }}"
                                                    data-sort="{{ $position->SORT_ORDER }}">Засах</button>
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

@include('modal.addposition')

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const updatePositionFormModal = document.getElementById('UpdatePositionForm');
        updatePositionFormModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const posId = button.getAttribute('data-id');
            const posName = button.getAttribute('data-name');
            const status = button.getAttribute('data-status');
            const sortOrder = button.getAttribute('data-sort');

            const modalPosIdInput = document.getElementById('modal-pos-id');
            const modalPosNameInput = document.getElementById('posName');
            const modalStatusInput = document.getElementById('status');
            const modalSortOrderInput = document.getElementById('sortOrder');

            modalPosIdInput.value = posId;
            modalPosNameInput.value = posName;
            modalStatusInput.value = status;
            modalSortOrderInput.value = sortOrder;
        });
    });
</script>
@endsection
