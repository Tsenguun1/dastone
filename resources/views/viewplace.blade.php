@extends('layouts.app')

@section('content')
<div class="topbar">
    <nav class="navbar-custom">
        <h4 class="page-title" style="margin: 10px;">Газар нэгжийн бүртгэл</h4>
    </nav>
</div>
<div class="page-content">

    <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 15px;"
    data-bs-toggle="modal" data-bs-target="#AddPlaceForm">+ Шинээр бүртгэх</button>
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
                                <option value="Идэвхитэй">Идэвхитэй</option>
                                <option value="Идэвхгүй">Идэвхгүй</option>
                            </select>
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped mb-0"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th data-sortable="false">Нэр</th> <!-- Name -->
                                    <th data-sortable="true">Захирал</th> <!-- Director -->
                                    <th data-sortable="true">Төлөв</th> <!-- Status -->
                                    <th data-sortable="true">Эрэмбэ</th> <!-- Order -->
                                    <th data-sortable="true">Зассан</th> <!-- Edited -->
                                    <th data-sortable="false" style="text-align: center;">Үйлдэл</th> <!-- Action -->
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
</div> <!-- end container -->
</div> <!-- end row -->

<!-- Edit Place Modal -->
<div class="modal fade" id="editPlaceModal" tabindex="-1" role="dialog" aria-labelledby="editPlaceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">

        </div>
    </div>
</div>

<!-- Add Place Modal -->
@include('modal.addplace', ['departments' => $departments])

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script>
   $(document).ready(function () {
    // Initialize DataTable with AJAX
  
        columns: [
            { data: 'DEP_NAME', name: 'DEP_NAME' },
            { data: 'DIRECTOR', name: 'DIRECTOR' },
            { data: 'STATUSVALUE', name: 'STATUSVALUE' },
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
        },
        columnDefs: [
            { orderable: false, targets: 5 }  // Disable sorting on the 'Action' column
        ],
        order: []  // Disable initial sorting
    });

    // Status filter functionality
    $('#statusFilter').on('change', function () {
        var selectedStatus = $(this).val();
        table.column(2).search(selectedStatus).draw();
    });

    // Edit place modal
    $('#editPlaceModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var depId = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);

        // Load the form via AJAX
        $.ajax({
            url: '/editplace/' + depId,
            method: 'GET',
            success: function (response) {
                modal.find('.modal-content').html(response);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Save changes in the edit place modal
    $('#saveChanges').click(function () {
        var form = $('#editPlaceModal').find('form');
        var formData = form.serialize();

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: formData,
            success: function (response) {
                $('#editPlaceModal').modal('hide');
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
