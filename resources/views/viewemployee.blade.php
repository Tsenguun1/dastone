@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="topbar">
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav mb-0">
                <h4 class="page-title" style="margin: 10px;">Ажилтны бүртгэл</h4>
                <a class="btn btn-sm btn-soft-primary" href="#" style="margin: 10px; margin-top: 30px;"
                    data-toggle="modal" data-target="#AddEmployeeForm">+ Шинээр бүртгэх</a>
                @yield('viewform')
                <?php
$sname = "localhost";
$unmae = "root";
$password = "";
$db_name = "dastone";
$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM ORG_EMPLOYEE";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='card-body'>";
    echo "<div class='table-rep-plugin'>";
    echo "<div class='table-responsive mb-0' data-pattern='priority-columns'>";
    echo "<table id='tech-companies-1' class='table table-striped mb-0'>
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
                            <tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                                <td><span class='co-name'>" . $row["PICTURE_LINK"] . "</span></td>
                                <td>" . $row["FIRSTNAME"] . "</td>
                                <td>" . $row["LASTNAME"] . "</td>
                                <td>" . $row["DEP_ID"] . "</td>
                                <td>" . $row["POS_ID"] . "</td>
                                <td>" . $row["REGISTER"] . "</td>
                                <td>" . $row["SEX"] . "</td>
                                <td>" . $row["EMAIL"] . "</td>
                                <td>" . $row["BIRTHDATE"] . "</td>
                                <td>" . $row["HANDPHONE"] . "</td>
                                <td>" . $row["WORKPHONE"] . "</td>
                                <td>" . $row["STATUS"] . "</td>
                                <td>
                                    <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#UpdateEmployeeForm' data-dep-id='" . $row['EMP_ID'] . "'>Засах</button>
                                    <a class='btn btn-danger' href='" . route('deleteemployee', ['id' => $row['EMP_ID']]) . "')>Устгах</a>
                                </td>
                            </tr>";
    }
    echo "</tbody></table>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} else {
    echo "0 results";
}

mysqli_free_result($result);
mysqli_close($conn);
                ?>
            </ul>
        </nav>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // In viewplace.blade.php or a separate JS file
    document.addEventListener('DOMContentLoaded', (event) => {
        const updatePlaceFormModal = document.getElementById('UpdateEmployeeForm');
        updatePlaceFormModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            const button = event.relatedTarget;
            // Extract info from data-* attributes
            const empId = button.getAttribute('data-dep-id');
            // Update the modal's content
            const modalDepIdInput = document.getElementById('modal-emp-id');
            modalDepIdInput.value = empId;
        });
    });

</script>
@include('modal.addemployee')
@endsection