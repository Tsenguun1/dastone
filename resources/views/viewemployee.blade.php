@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="topbar">
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav mb-0">
                <h4 class="page-title" style="margin: 10px;">Ажилтны бүртгэл</h4>
                <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 10px; margin-top: 30px;"
                    data-bs-toggle="modal" data-bs-target="#AddEmployeeForm">+ Шинээр бүртгэх</button>
                
                <div class='card-body'>
                    <div class='table-rep-plugin'>
                        <div class='table-responsive mb-0' data-pattern='priority-columns'>
                            <table id='tech-companies-1' class='table table-striped mb-0'>
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
                                        <td><img src="{{ $employee->PICTURE_LINK }}" alt="Employee Picture" width="50"></td>
                                        <td>{{ $employee->FIRSTNAME }}</td>
                                        <td>{{ $employee->LASTNAME }}</td>
                                        <td>{{ $employee->DEP_ID}}</td>
                                        <td>{{ $employee->POS_ID}}</td>
                                        <td>{{ $employee->REGISTER }}</td>
                                        <td>{{ $employee->SEX }}</td>
                                        <td>{{ $employee->EMAIL }}</td>
                                        <td>{{ $employee->BIRTHDATE }}</td>
                                        <td>{{ $employee->HANDPHONE }}</td>
                                        <td>{{ $employee->WORKPHONE }}</td>
                                        <td>{{ $employee->STATUS }}</td>
                                        <td>
                                            <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#UpdateEmployeeForm' data-id='{{ $employee->EMP_ID }}' data-firstname='{{ $employee->FIRSTNAME }}' data-lastname='{{ $employee->LASTNAME }}' data-depid='{{ $employee->DEP_ID }}' data-posid='{{ $employee->POS_ID }}' data-register='{{ $employee->REGISTER }}' data-sex='{{ $employee->SEX }}' data-email='{{ $employee->EMAIL }}' data-birthdate='{{ $employee->BIRTHDATE }}' data-handphone='{{ $employee->HANDPHONE }}' data-workphone='{{ $employee->WORKPHONE }}' data-status='{{ $employee->STATUS }}'>Засах</button>
                                            <form action="{{ route('deleteemployee', ['id' => $employee->EMP_ID]) }}" method="POST" style="display:inline;">
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
            </ul>
        </nav>
    </div>
</div>

@include('modal.addemployee')

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const updateEmployeeFormModal = document.getElementById('UpdateEmployeeForm');
        updateEmployeeFormModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const empId = button.getAttribute('data-id');
            const firstName = button.getAttribute('data-firstname');
            const lastName = button.getAttribute('data-lastname');
            const depId = button.getAttribute('data-depid');
            const posId = button.getAttribute('data-posid');
            const register = button.getAttribute('data-register');
            const sex = button.getAttribute('data-sex');
            const email = button.getAttribute('data-email');
            const birthDate = button.getAttribute('data-birthdate');
            const handPhone = button.getAttribute('data-handphone');
            const workPhone = button.getAttribute('data-workphone');
            const status = button.getAttribute('data-status');

            const modalEmpIdInput = document.getElementById('modal-emp-id');
            const modalFirstNameInput = document.getElementById('firstName');
            const modalLastNameInput = document.getElementById('lastName');
            const modalDepIdInput = document.getElementById('depId');
            const modalPosIdInput = document.getElementById('posId');
            const modalRegisterInput = document.getElementById('register');
            const modalSexInput = document.getElementById('sex');
            const modalEmailInput = document.getElementById('email');
            const modalBirthDateInput = document.getElementById('birthDate');
            const modalHandPhoneInput = document.getElementById('handPhone');
            const modalWorkPhoneInput = document.getElementById('workPhone');
            const modalStatusInput = document.getElementById('status');

            modalEmpIdInput.value = empId;
            modalFirstNameInput.value = firstName;
            modalLastNameInput.value = lastName;
            modalDepIdInput.value = depId;
            modalPosIdInput.value = posId;
            modalRegisterInput.value = register;
            modalSexInput.value = sex;
            modalEmailInput.value = email;
            modalBirthDateInput.value = birthDate;
            modalHandPhoneInput.value = handPhone;
            modalWorkPhoneInput.value = workPhone;
            modalStatusInput.value = status;
        });
    });
</script>
@endsection
