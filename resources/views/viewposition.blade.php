@extends('layouts.app')

@section('content')
<div class="topbar">
    <nav class="navbar-custom">
        <h4 class="page-title" style="margin: 10px;">Ажлын байрны жагсаалт</h4>
    </nav>
</div>
<div class="page-content">
    <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 15px;" data-bs-toggle="modal" data-bs-target="#AddPositionForm">+ Шинээр бүртгэх</button>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class='table-rep-plugin'>
                            <div class="mb-3">
                                <label for="statusFilter" class="form-check-label">Төлөв:</label>
                                <select id="statusFilter" class="form-control">
                                    <option value="">Бүх</option>
                                    <option value="A">Идэвхитэй</option>
                                    <option value="N">Идэвхгүй</option>
                                </select>
                            </div>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Нэр</th>
                                        <th>Төлөв</th>
                                        <th>Эрэмбэ</th>
                                        <th>Зассан</th>
                                        <th>Үйлдэл</th>
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
</div>

<!-- Edit Position Modal -->
<div class="modal fade" id="editPositionModal" tabindex="-1" role="dialog" aria-labelledby="editPositionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <!-- Content will be loaded here via AJAX -->
        </div>
    </div>
</div>

<!-- Add Position Modal -->
@include('modal.addposition')

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {
    // Initialize DataTable with AJAX
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('positionlisttable') }}',
            type: 'GET'
        },
        columns: [
            { data: 'POS_NAME', name: 'POS_NAME' },
            { data: 'STATUS', name: 'STATUS' },
            { data: 'SORT_ORDER', name: 'SORT_ORDER' },
            { data: 'EDIT_DATE', name: 'EDIT_DATE' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All']
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/mn.json" // Mongolian translation
        }
    });

    // Status filter functionality
    $('#statusFilter').on('change', function () {
        var selectedStatus = $(this).val();
        table.column(1).search(selectedStatus).draw();
    });

    // Edit position modal
    $('#editPositionModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var posId = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);

        // Load the form via AJAX
        $.ajax({
            url: '/editposition/' + posId,
            method: 'GET',
            success: function (response) {
                modal.find('.modal-content').html(response);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Save changes in the edit position modal
    $(document).on('click', '#savePositionChanges', function () {
        var form = $('#editPositionModal').find('form');
        var formData = new FormData(form[0]);

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#editPositionModal').modal('hide');
                table.ajax.reload(); // Reload the DataTable to see the changes
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
</script>
@endsection
