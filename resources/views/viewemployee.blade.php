@extends('layouts.app')

@section('content')
<div class="topbar">
    <nav class="navbar-custom">
        <h4 class="page-title" style="margin: 10px;">Ажилтны бүртгэл</h4>
    </nav>
</div>

<!-- Page Content-->
<div class="page-content">
    <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 15px;" data-bs-toggle="modal"
        data-bs-target="#AddEmployeeForm">+ Шинээр бүртгэх</button>
    <div class="container-fluid"></div>
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
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 10px;">
                            <thead>
                                <tr>
                                    <th>Зураг</th>
                                    <th>Эцэг/эхийн нэр</th>
                                    <th>Өөрийн нэр</th>
                                    <th>Газар нэгж</th>
                                    <th>Албан тушаал</th>
                                    <th>Регистр</th>
                                    <th>Хүйс</th>
                                    <th>Цахим шуудан</th>
                                    <th>Төрсөн огноо</th>
                                    <th>Гар утас</th>
                                    <th>Ажлын утас</th>
                                    <th>Төлөв</th>
                                    <th>Үйлдэл</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td><img src="{{$employee->PICTURE_LINK}}"
                                                style="border-radius: 50%; width: 50px; height: 50px; object-fit: cover;"
                                                alt="Employee Picture" width="50"></td>
                                        <td>{{ $employee->FIRSTNAME }}</td>
                                        <td>{{ $employee->LASTNAME }}</td>
                                        <td>{{ $employee->DEP_NAME }}</td> <!-- Displaying Department Name -->
                                        <td>{{ $employee->POS_NAME }}</td> <!-- Displaying Position Name -->
                                        <td>{{ $employee->REGISTER }}</td>
                                        <td>{{ $employee->SEX }}</td>
                                        <td>{{ $employee->EMAIL }}</td>
                                        <td>{{ $employee->BIRTHDATE }}</td>
                                        <td>{{ $employee->HANDPHONE }}</td>
                                        <td>{{ $employee->WORKPHONE }}</td>
                                        <td>{{ $employee->STATUSVALUE }}</td>
                                        <td>
                                            <button type='button' class='btn btn-success' data-bs-toggle='modal'
                                                data-bs-target='#editEmployeeModal'
                                                data-id='{{ $employee->EMP_ID }}'>Засах</button>
                                            <form action="{{ route('deleteemployee', ['id' => $employee->EMP_ID]) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Устгах</button>
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
</div>

<!-- Update Position Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">
        <div class="modal-content">

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        $('#statusFilter').on('change', function () {
            var selectedStatus = $(this).val();
            filterTable(selectedStatus);
        });

        function filterTable(status) {
            $('#datatable tbody tr').each(function () {
                var row = $(this);
                var rowStatus = row.find('td:nth-child(12)').text(); // Correct column index for status
                if (status === "" || rowStatus === status) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        }

        // Function to handle opening the edit employee modal and loading content via AJAX
        $('#editEmployeeModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var empId = button.data('id'); // Extract info from data-* attributes
            var modal = $(this);

            // Load the form via AJAX
            $.ajax({
                url: '/editemployee/' + empId,
                method: 'GET',
                success: function (response) {
                    modal.find('.modal-content').html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        // Function to handle saving changes made in the edit employee modal
        $(document).on('click', '#saveEmployeeChanges', function () {
            var form = $('#editEmployeeModal').find('form');
            var formData = new FormData(form[0]);

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#editEmployeeModal').modal('hide');
                    location.reload(); // Reload the page to see the changes
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        // Initialize DataTable with specific configurations
        $('#datatable').DataTable({
            "columnDefs": [{ "orderable": false, "targets": 12 }], // Disable sorting on the 'Action' column
            "order": [], // Disable initial sorting
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/mn.json" // Example for Mongolian translation
            }
        });
    });
</script>
@endsection

@include('modal.addemployee')
