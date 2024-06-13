@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="topbar">
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav mb-0">
                <h4 class="page-title" style="margin: 10px;">Ажилтан бүртгэл</h4>
                <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 10px; margin-top: 30px;"
                    data-bs-toggle="modal" data-bs-target="#AddEmployeeForm">+ Шинээр бүртгэх</button>
                <div class='card-body'>
                    <div class='table-rep-plugin'>
                        <div class='table-responsive mb-0' data-pattern='priority-columns'>
                            <table id='tech-companies-1' class='table table-striped mb-0'>
                                <thead>
                                    <tr>
                                        <th>Регистр</th>
                                        <th>Нэр</th>
                                        <th>Эцэг газар нэгж</th>
                                        <th>Албан тушаал</th>
                                        <th>И-мэйл</th>
                                        <th>Үйлдэл</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->REGISTER }}</td>
                                            <td>{{ $employee->FIRSTNAME }} {{ $employee->LASTNAME }}</td>
                                            <td>{{ $employee->department->DEP_NAME }}</td>
                                            <td>{{ $employee->position->POS_NAME }}</td>
                                            <td>{{ $employee->EMAIL }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#UpdateEmployeeForm" data-id="{{ $employee->EMP_ID }}"
                                                    data-register="{{ $employee->REGISTER }}"
                                                    data-firstname="{{ $employee->FIRSTNAME }}"
                                                    data-lastname="{{ $employee->LASTNAME }}"
                                                    data-pos_id="{{ $employee->POS_ID }}"
                                                    data-dep_id="{{ $employee->DEP_ID }}"
                                                    data-email="{{ $employee->EMAIL }}"
                                                    data-pass="{{ $employee->PASS }}"
                                                    data-work_date="{{ $employee->WORK_DATE }}"
                                                    data-status="{{ $employee->STATUS }}"
                                                    data-birthdate="{{ $employee->BIRTHDATE }}"
                                                    data-handphone="{{ $employee->HANDPHONE }}"
                                                    data-homephone="{{ $employee->HOMEPHONE }}"
                                                    data-workphone="{{ $employee->WORKPHONE }}"
                                                    data-fingerid="{{ $employee->FINGERID }}"
                                                    data-sex="{{ $employee->SEX }}"
                                                    data-picture_link="{{ $employee->PICTURE_LINK }}">Засах</button>
                                                <form action="{{ route('deleteemployee', $employee->EMP_ID) }}" method="POST"
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
            </ul>
        </nav>
    </div>
</div>

@include('modal.addemployee')
@endsection
