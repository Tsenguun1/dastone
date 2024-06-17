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
                        <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped mb-0"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                        <td>{{ $employee->DEP_NAME }}</td>
                                        <td>{{ $employee->POS_NAME }}</td>
                                        <td>{{ $employee->REGISTER }}</td>
                                        <td>{{ $employee->SEX }}</td>
                                        <td>{{ $employee->EMAIL }}</td>
                                        <td>{{ $employee->BIRTHDATE }}</td>
                                        <td>{{ $employee->HANDPHONE }}</td>
                                        <td>{{ $employee->WORKPHONE }}</td>
                                        <td>{{ $employee->STATUS }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#EditEmployeeForm{{$employee->EMP_ID}}">Засах</a>
                                            <a href="{{ route('deleteemployee', $employee->EMP_ID) }}">Устгах</a>
                                        </td>
                                    </tr>
                                    <!-- Edit Employee Modal -->
                                    <div class="modal fade" id="EditEmployeeForm{{$employee->EMP_ID}}" tabindex="-1"
                                        aria-labelledby="EditEmployeeFormLabel{{$employee->EMP_ID}}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="EditEmployeeFormLabel{{$employee->EMP_ID}}">Ажилтны
                                                        мэдээлэл засах</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('updateemployee') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="EMP_ID"
                                                            value="{{ $employee->EMP_ID }}">
                                                        <div class="row mb-3">
                                                            <label for="REGISTER" class="col-md-4 col-form-label text-md-end">Регистр:</label>
                                                            <div class="col-md-6">
                                                                <input id="REGISTER" type="text"
                                                                    class="form-control @error('REGISTER') is-invalid @enderror"
                                                                    name="REGISTER"
                                                                    value="{{ $employee->REGISTER }}" required>
                                                                @error('REGISTER')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="FIRSTNAME" class="col-md-4 col-form-label text-md-end">Эцэг/эхийн
                                                                нэр:</label>
                                                            <div class="col-md-6">
                                                                <input id="FIRSTNAME" type="text"
                                                                    class="form-control @error('FIRSTNAME') is-invalid @enderror"
                                                                    name="FIRSTNAME"
                                                                    value="{{ $employee->FIRSTNAME }}" required>
                                                                @error('FIRSTNAME')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="LASTNAME" class="col-md-4 col-form-label text-md-end">Өөрийн
                                                                нэр:</label>
                                                            <div class="col-md-6">
                                                                <input id="LASTNAME" type="text"
                                                                    class="form-control @error('LASTNAME') is-invalid @enderror"
                                                                    name="LASTNAME"
                                                                    value="{{ $employee->LASTNAME }}" required>
                                                                @error('LASTNAME')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="DEP_ID" class="col-md-4 col-form-label text-md-end">Газар
                                                                нэгж:</label>
                                                            <div class="col-md-6">
                                                                <select id="DEP_ID" name="DEP_ID" class="form-control"
                                                                    required>
                                                                    @foreach($departments as $department)
                                                                    <option value="{{ $department->DEP_ID }}"
                                                                        {{ $department->DEP_ID == $employee->DEP_ID ? 'selected' : '' }}>
                                                                        {{ $department->DEP_NAME }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="POS_ID" class="col-md-4 col-form-label text-md-end">Албан
                                                                тушаал:</label>
                                                            <div class="col-md-6">
                                                                <select id="POS_ID" name="POS_ID" class="form-control"
                                                                    required>
                                                                    @foreach($positions as $position)
                                                                    <option value="{{ $position->POS_ID }}"
                                                                        {{ $position->POS_ID == $employee->POS_ID ? 'selected' : '' }}>
                                                                        {{ $position->POS_NAME }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="EMAIL" class="col-md-4 col-form-label text-md-end">Цахим
                                                                шуудан:</label>
                                                            <div class="col-md-6">
                                                                <input id="EMAIL" type="email"
                                                                    class="form-control @error('EMAIL') is-invalid @enderror"
                                                                    name="EMAIL" value="{{ $employee->EMAIL }}"
                                                                    required>
                                                                @error('EMAIL')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="WORK_DATE" class="col-md-4 col-form-label text-md-end">Ажилд
                                                                орсон огноо:</label>
                                                            <div class="col-md-6">
                                                                <input id="WORK_DATE" type="date"
                                                                    class="form-control @error('WORK_DATE') is-invalid @enderror"
                                                                    name="WORK_DATE"
                                                                    value="{{ $employee->WORK_DATE }}" required>
                                                                @error('WORK_DATE')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="STATUS" class="col-md-4 col-form-label text-md-end">Төлөв:</label>
                                                            <div class="col-md-6">
                                                                <input id="STATUS" type="text"
                                                                    class="form-control @error('STATUS') is-invalid @enderror"
                                                                    name="STATUS"
                                                                    value="{{ $employee->STATUS }}" required>
                                                                @error('STATUS')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="BIRTHDATE" class="col-md-4 col-form-label text-md-end">Төрсөн
                                                                огноо:</label>
                                                            <div class="col-md-6">
                                                                <input id="BIRTHDATE" type="date"
                                                                    class="form-control @error('BIRTHDATE') is-invalid @enderror"
                                                                    name="BIRTHDATE"
                                                                    value="{{ $employee->BIRTHDATE }}" required>
                                                                @error('BIRTHDATE')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="HANDPHONE" class="col-md-4 col-form-label text-md-end">Гар
                                                                утас:</label>
                                                            <div class="col-md-6">
                                                                <input id="HANDPHONE" type="text"
                                                                    class="form-control @error('HANDPHONE') is-invalid @enderror"
                                                                    name="HANDPHONE"
                                                                    value="{{ $employee->HANDPHONE }}" required>
                                                                @error('HANDPHONE')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="HOMEPHONE" class="col-md-4 col-form-label text-md-end">Гэрийн
                                                                утас:</label>
                                                            <div class="col-md-6">
                                                                <input id="HOMEPHONE" type="text"
                                                                    class="form-control @error('HOMEPHONE') is-invalid @enderror"
                                                                    name="HOMEPHONE"
                                                                    value="{{ $employee->HOMEPHONE }}">
                                                                @error('HOMEPHONE')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="WORKPHONE" class="col-md-4 col-form-label text-md-end">Ажлын
                                                                утас:</label>
                                                            <div class="col-md-6">
                                                                <input id="WORKPHONE" type="text"
                                                                    class="form-control @error('WORKPHONE') is-invalid @enderror"
                                                                    name="WORKPHONE"
                                                                    value="{{ $employee->WORKPHONE }}">
                                                                @error('WORKPHONE')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="SEX" class="col-md-4 col-form-label text-md-end">Хүйс:</label>
                                                            <div class="col-md-6">
                                                                <input id="SEX" type="text"
                                                                    class="form-control @error('SEX') is-invalid @enderror"
                                                                    name="SEX" value="{{ $employee->SEX }}" required>
                                                                @error('SEX')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="PICTURE_LINK" class="col-md-4 col-form-label text-md-end">Зураг:</label>
                                                            <div class="col-md-6">
                                                                <input id="PICTURE_LINK" type="file"
                                                                    class="form-control @error('PICTURE_LINK') is-invalid @enderror"
                                                                    name="PICTURE_LINK">
                                                                @error('PICTURE_LINK')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="FINGERID" class="col-md-4 col-form-label text-md-end">FINGERID:</label>
                                                            <div class="col-md-6">
                                                                <input id="FINGERID" type="number" class="form-control"
                                                                    name="FINGERID" value="{{ $employee->FINGERID }}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-0">
                                                            <div class="col-md-6 offset-md-4">
                                                                <button type="submit" class="btn btn-primary">Хадгалах</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Employee Modal -->
<div class="modal fade" id="AddEmployeeForm" tabindex="-1" aria-labelledby="AddEmployeeFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddEmployeeFormLabel">Ажилтан нэмэх</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('addemployee') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="REGISTER" class="col-md-4 col-form-label text-md-end">Регистр:</label>
                        <div class="col-md-6">
                            <input id="REGISTER" type="text"
                                class="form-control @error('REGISTER') is-invalid @enderror" name="REGISTER" required>
                            @error('REGISTER')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="FIRSTNAME" class="col-md-4 col-form-label text-md-end">Эцэг/эхийн нэр:</label>
                        <div class="col-md-6">
                            <input id="FIRSTNAME" type="text"
                                class="form-control @error('FIRSTNAME') is-invalid @enderror" name="FIRSTNAME" required>
                            @error('FIRSTNAME')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="LASTNAME" class="col-md-4 col-form-label text-md-end">Өөрийн нэр:</label>
                        <div class="col-md-6">
                            <input id="LASTNAME" type="text"
                                class="form-control @error('LASTNAME') is-invalid @enderror" name="LASTNAME" required>
                            @error('LASTNAME')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="DEP_ID" class="col-md-4 col-form-label text-md-end">Газар нэгж:</label>
                        <div class="col-md-6">
                            <select id="DEP_ID" name="DEP_ID" class="form-control" required>
                                @foreach($departments as $department)
                                <option value="{{ $department->DEP_ID }}">{{ $department->DEP_NAME }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="POS_ID" class="col-md-4 col-form-label text-md-end">Албан тушаал:</label>
                        <div class="col-md-6">
                            <select id="POS_ID" name="POS_ID" class="form-control" required>
                                @foreach($positions as $position)
                                <option value="{{ $position->POS_ID }}">{{ $position->POS_NAME }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="EMAIL" class="col-md-4 col-form-label text-md-end">Цахим шуудан:</label>
                        <div class="col-md-6">
                            <input id="EMAIL" type="email"
                                class="form-control @error('EMAIL') is-invalid @enderror" name="EMAIL" required>
                            @error('EMAIL')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="WORK_DATE" class="col-md-4 col-form-label text-md-end">Ажилд орсон огноо:</label>
                        <div class="col-md-6">
                            <input id="WORK_DATE" type="date"
                                class="form-control @error('WORK_DATE') is-invalid @enderror" name="WORK_DATE" required>
                            @error('WORK_DATE')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="STATUS" class="col-md-4 col-form-label text-md-end">Төлөв:</label>
                        <div class="col-md-6">
                            <input id="STATUS" type="text"
                                class="form-control @error('STATUS') is-invalid @enderror" name="STATUS" required>
                            @error('STATUS')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="BIRTHDATE" class="col-md-4 col-form-label text-md-end">Төрсөн огноо:</label>
                        <div class="col-md-6">
                            <input id="BIRTHDATE" type="date"
                                class="form-control @error('BIRTHDATE') is-invalid @enderror" name="BIRTHDATE" required>
                            @error('BIRTHDATE')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="HANDPHONE" class="col-md-4 col-form-label text-md-end">Гар утас:</label>
                        <div class="col-md-6">
                            <input id="HANDPHONE" type="text"
                                class="form-control @error('HANDPHONE') is-invalid @enderror" name="HANDPHONE" required>
                            @error('HANDPHONE')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="HOMEPHONE" class="col-md-4 col-form-label text-md-end">Гэрийн утас:</label>
                        <div class="col-md-6">
                            <input id="HOMEPHONE" type="text"
                                class="form-control @error('HOMEPHONE') is-invalid @enderror" name="HOMEPHONE">
                            @error('HOMEPHONE')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="WORKPHONE" class="col-md-4 col-form-label text-md-end">Ажлын утас:</label>
                        <div class="col-md-6">
                            <input id="WORKPHONE" type="text"
                                class="form-control @error('WORKPHONE') is-invalid
