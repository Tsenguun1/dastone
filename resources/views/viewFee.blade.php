@extends('layouts.app')

@section('content')
<div class="topbar">
    <nav class="navbar-custom">
        <h4 class="page-title" style="margin: 10px;">Шимтгэлийн бүртгэл</h4>
    </nav>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class='table-rep-plugin'>
                    <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 15px;"
                        data-bs-toggle="modal" data-bs-target="#AddFeeForm">+ Шинээр бүртгэх</button>
                    <table id="feeTable" class="table table-bordered dt-responsive nowrap table-striped mb-0"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th data-sortable="false">№</th>
                                <th data-sortable="true">ID</th>
                                <th data-sortable="true">Төрөл</th>
                                <th data-sortable="true">Нэр</th>
                                <th data-sortable="true">Тайлбар</th>
                                <th data-sortable="false" style="text-align: center;">Эрэмбэ</th>
                                <th data-sortable="false">Эхлэх огноо</th>
                                <th data-sortable="true">Төлөв</th>
                                <th data-sortable="true">Үйлдэл</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fees as $index => $fee)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $fee->FEE_ID }}</td>
                                    <td>{{ $fee->FEE_TYPE }}</td>
                                    <td>{{ $fee->FEE_NAME }}</td>
                                    <td>{{ $fee->FEE_DESCR }}</td>
                                    <td>{{ $fee->ORDER_NO }}</td>
                                    <td>{{ $fee->FEE_STARTDATE }}</td>
                                    <td>{{ $fee->STATUSVALUE }}</td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#detailsFeeModal"
                                            data-id="{{ $fee->FEE_ID }}">Дэлгэрэнгүй</button>


                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#editFeeModal" data-id="{{ $fee->FEE_ID }}">Засах</button>

                                        <form action="{{ route('deletefee', $fee->FEE_ID) }}" method="POST"
                                            style="display:inline;">
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
    </div> <!-- end col -->
</div> <!-- end row -->

<!-- Edit Fee Modal -->
<!-- Modal Containers -->
<div class="modal fade" id="editFeeModal" tabindex="-1" role="dialog" aria-labelledby="editFeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <!-- Content will be loaded via AJAX -->
        </div>
    </div>
</div>

<div class="modal fade" id="detailsFeeModal" tabindex="-1" role="dialog" aria-labelledby="detailsFeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <!-- Content will be loaded here via AJAX -->
        </div>
    </div>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('#detailsFeeModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var feeId = button.data('id');
            var modal = $(this);

            $.ajax({
                url: '/detailsfee/' + feeId,
                method: 'GET',
                success: function (response) {
                    modal.find('.modal-content').html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('#editFeeModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var feeId = button.data('id');
            var modal = $(this);

            $.ajax({
                url: '/editfee/' + feeId,
                method: 'GET',
                success: function (response) {
                    modal.find('.modal-content').html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('#saveFeeChanges').click(function () {
            var form = $('#editFeeModal').find('form');
            var formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: formData,
                success: function (response) {
                    $('#editFeeModal').modal('hide');
                    location.reload();
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });

    $(document).ready(function () {
        $('#feeTable').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": 5 }
            ],
            "order": [],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/mn.json"
            }
        });
    });
</script>
@endsection

@include('modal.addfee')
