@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="topbar">
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav mb-0">
                <h4 class="page-title" style="margin: 10px;">Газар нэгжийн бүртгэл</h4>
                <button class="btn btn-sm btn-soft-primary" onclick="window.location='{{ route('addplace') }}'" style="margin: 10px; margin-top: 30px;">+ Шинээр бүртгэх</button>
                @yield('viewform')
                <?php
                $sname = "localhost";
                $unmae = "root";
                $password = "";
                $db_name = "trans_database";
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
                                    <a class='btn btn-success' href='" . route('updateplace', ['id' => $row['DEP_ID']]) . "'>Засах</a>
                                    <a class='btn btn-danger' href='" . route('deleteplace', ['id' => $row['DEP_ID']]) . "')>Устгах</a>
                                    
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
@endsection
