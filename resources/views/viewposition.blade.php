@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="topbar">
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav mb-0">
                <h4 class="page-title" style="margin: 10px;">Албан тушаалын бүртгэл</h4>
                <a class="btn btn-sm btn-soft-primary" href="#" style="margin: 10px; margin-top: 30px;"
                    data-toggle="modal" data-target="#AddPositionForm">+ Шинээр бүртгэх</a>
                @yield('viewpos')
                <?php
$sname = "localhost";
$unmae = "root";
$password = "";
$db_name = "dastone";
$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM ORG_POSITION";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='card-body'>";
    echo "<div class='table-rep-plugin'>";
    echo "<div class='table-responsive mb-0' data-pattern='priority-columns'>";
    echo "<table id='tech-companies-1' class='table table-striped mb-0'>
                            <thead>
                            <tr>
                                <th>Нэр</th>
                                <th>Төлөв</th>
                                <th>Эрэмбэ</th>
                                <th>Зассан</th>
                                <th>Үйлдэл</th>
                            </tr>
                            </thead>
                            <tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                                <td><span class='co-name'>" . $row["POS_NAME"] . "</span></td>
                                <td>" . $row["STATUS"] . "</td>
                                <td>" . $row["SORT_ORDER"] . "</td>
                                <td>" . $row["EDIT_DATE"] . "</td>
                                <td>
                                
                                    <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#UpdatePositionForm' data-dep-id='" . $row['POS_ID'] . "'>Засах</button>
                                    <a class='btn btn-danger' href='" . route('deleteposition', ['id' => $row['POS_ID']]) . "')>Устгах</a>
                                    
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
        const updatePlaceFormModal = document.getElementById('UpdatePositionForm');
        updatePlaceFormModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            const button = event.relatedTarget;
            // Extract info from data-* attributes
            const posId = button.getAttribute('data-dep-id');
            // Update the modal's content
            const modalDepIdInput = document.getElementById('modal-pos-id');
            modalDepIdInput.value = posId;
        });
    });

</script>
@include('modal.addposition')
@endsection