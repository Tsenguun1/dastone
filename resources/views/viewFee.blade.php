@extends('layouts.app')

@section('content')
<div class="topbar">
    <nav class="navbar-custom">
        <h4 class="page-title" style="margin: 10px;">Шимтгэлийн бүртгэл</h4>
    </nav>
</div>

<div class="page-content">
    <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 15px;" data-bs-toggle="modal" data-bs-target="#AddFeeForm">+ Шинээр бүртгэх</button>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class='table-rep-plugin'>
                        <table id="feeTable" class="table table-bordered dt-responsive nowrap table-striped mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                    <th data-sortable="false">Үйлдэл</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Fee Modal -->
<div class="modal fade" id="editFeeModal" tabindex="-1" role="dialog" aria-labelledby="editFeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <!-- Content will be loaded via AJAX -->
        </div>
    </div>
</div>

<!-- Add Fee Modal -->
@include('modal.addfee')

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {
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

        $('#feeTable').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            dom: 'fBrltip',
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('feeListTable') }}',
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'FEE_ID', name: 'FEE_ID' },
                { data: 'FEE_TYPE', name: 'FEE_TYPE' },
                { data: 'FEE_NAME', name: 'FEE_NAME' },
                { data: 'FEE_DESCR', name: 'FEE_DESCR' },
                { data: 'ORDER_NO', name: 'ORDER_NO' },
                { data: 'FEE_STARTDATE', name: 'FEE_STARTDATE' },
                { data: 'STATUS', name: 'STATUS', render: function(data, type, row) {
                        return data === 'A' ? 'Идэвхитэй' : (data === 'N' ? 'Идэвхгүй' : 'Unknown Status');
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            "bDestroy": true
        });
    });
</script>
@endsection
