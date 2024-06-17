@extends('layouts.app')

@section('content')
<div class="topbar">
    <nav class="navbar-custom">
        <h4 class="page-title" style="margin: 10px;">Албан тушаалын бүртгэл</h4>
    </nav>
</div>

<div class="page-content">

    <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 15px;" data-bs-toggle="modal"
        data-bs-target="#AddPositionForm">+ Шинээр бүртгэх</button>
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
                                        <td>
                                            @if ($position->STATUS == 'A')
                                                Идэвхитэй
                                            @elseif ($position->STATUS == 'N')
                                                Идэвхгүй
                                            @else
                                                Unknown Status
                                            @endif
                                        </td>
                                        <td>{{ $position->SORT_ORDER }}</td>
                                        <td>{{ $position->EDIT_DATE }}</td>
                                        <td>
                                            <form action="{{ route('deleteposition', $position->POS_ID) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type='submit' class='btn btn-danger'
                                                    style="float: right;">Устгах</button>
                                            </form>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                style="float: right;" data-bs-target="#UpdatePositionForm"
                                                data-id="{{ $position->POS_ID }}" data-name="{{ $position->POS_NAME }}"
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
        </div> <!-- end col -->
    </div> <!-- end row -->
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