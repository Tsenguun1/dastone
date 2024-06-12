@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="topbar">
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav mb-0">
                <h4 class="page-title" style="margin: 10px;">Газар нэгжийн бүртгэл</h4>
                <button type="button" class="btn btn-sm btn-soft-primary" style="margin: 10px; margin-top: 30px;"
                    data-bs-toggle="modal" data-bs-target="#AddPlaceForm">+ Шинээр бүртгэх</button>

                <?php
$sname = "localhost";
$unmae = "root";
$password = "";
$db_name = "dastone";
$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM ORG_DEPARTMENT";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='card-body'>";
    echo "<div class='table-rep-plugin'>";
    echo "<div class='table-responsive mb-0' data-pattern='priority-columns'>";
    echo "<table id='tech-companies-1' class='table table-striped mb-0'>
                            <thead>
                            <tr>
                                <th>Нэр</th>
                                <th>Захирал</th>
                                <th>Төлөв</th>
                                <th>Эрэмбэ</th>
                                <th>Зассан</th>
                                <th>Үйлдэл</th>
                            </tr>
                            </thead>
                            <tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                                <td><span class='co-name'>" . $row["DEP_NAME"] . "</span></td>
                                <td>" . $row["DIRECTOR_EMPID"] . "</td>
                                <td>" . $row["STATUS"] . "</td>
                                <td>" . $row["SORT_ORDER"] . "</td>
                                <td>" . $row["EDIT_DATE"] . "</td>
                                <td>
                                <!-- viewplace.blade.php -->
                                    <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#UpdatePlaceForm' data-dep-id='" . $row['DEP_ID'] . "'>Засах</button>
                                    <a class='btn btn-danger' href='" . route('deleteplace', ['id' => $row['DEP_ID']]) . "'>Устгах</a>
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

<script>
    // In viewplace.blade.php or a separate JS file
    document.addEventListener('DOMContentLoaded', (event) => {
        const updatePlaceFormModal = document.getElementById('UpdatePlaceForm');
        updatePlaceFormModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            const button = event.relatedTarget;
            // Extract info from data-* attributes
            const depId = button.getAttribute('data-dep-id');
            // Update the modal's content
            const modalDepIdInput = document.getElementById('modal-dep-id');
            modalDepIdInput.value = depId;
        });
    });

</script>
@include('modal.addplace')
@endsection