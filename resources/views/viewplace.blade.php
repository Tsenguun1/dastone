@extends('layouts.app')

@section('content')


<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="topbar">
    <nav class="navbar-custom">
        <h4 class="page-title" style="margin: 10px;">Газар нэгжийн бүртгэл</h4>
    </nav>
</div>
<div class="page-content">
    <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 15px;" data-bs-toggle="modal" data-bs-target="#AddPlaceForm">+ Шинээр бүртгэх</button>

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
                            <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
<div class="modal fade" id="editPlaceModal" tabindex="-1" role="dialog" aria-labelledby="editPlaceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <!-- Content will be loaded here via AJAX -->
        </div>
    </div>
</div>

<!-- Add Place Modal -->
<div class="modal fade" id="AddPlaceForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="form-container" id="formContainer">
                <form id="registrationForm" method="POST" action="{{ route('addform') }}">
                    @csrf
                    <label for="depName" class="form-check-label">Газар нэгжийн нэршил</label>
                    <input type="text" class="form-check-input" id="depName" name="depName" required>

                    <label for="status" class="form-check-label">Төлөв</label>
                    <select id="status" name="status" required>
                        <option value="">[Сонгоно уу]</option>
                        <option value="A">Идэвхитэй</option>
                        <option value="N">Идэвхгүй</option>
                    </select>

                    <label for="sortOrder" class="form-check-label">Эрэмбэ</label>
                    <input type="number" class="form-check-input" id="sortOrder" name="sortOrder" required>

                    <label for="parentDepId" class="form-check-label">Эцэг газар нэгж</label>
                    <select id="parentDepId" name="parentDepId" required>
                        <option value="">[Сонгоно уу]</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->DEP_ID }}">{{ $department->DEP_NAME }}</option>
                        @endforeach
                    </select>

                    <label for="directorEmpId" class="form-check-label">Захирал</label>
                    <select id="directorEmpId" name="directorEmpId" required>
                        <option value="">[Сонгоно уу]</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->EMP_ID }}">{{ $employee->EMPNAME }} ({{ $employee->DEP_NAME }}-{{ $employee->POS_NAME }})
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary" type="submit" name="submit">Хадгалах</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
                </form>
            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('placelisttable') !!}',
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

        // Attach click event to the edit button
        $('#datatable').on('click', '.edit-button', function () {
            var placeId = $(this).data('id');
            $.ajax({
                url: 'editplace/' + placeId,
                type: 'GET',
                success: function (response) {
                    $('#editPlaceModal .modal-content').html(response);
                    $('#editPlaceModal').modal('show');
                }
            });
        });

        // Attach submit event to the edit form
        $('#editPlaceModal').on('submit', '#editPlaceForm', function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        $('#editPlaceModal').modal('hide');
                        table.ajax.reload(); // Reload the DataTable to reflect changes
                        // Optionally, you can show a success message to the user
                    }
                }
            });
        });
    });
</script>
@endsection
