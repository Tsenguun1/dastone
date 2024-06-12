@extends('viewplace')
@section('viewform')
<div class="form-container-update" style='position: absolute; top: 10%; z-index: 1; background-color: white' id="formContainerUpdate">
    <form method="POST" action="{{ route('updateplace', ['id' => $place['DEP_ID']]) }}">
        @csrf
        <label for="depName" class="form-check-label">Газар нэгжийн нэршил:</label>
        <input type="text" id="depName" name="depName" class="form-check-input" value="{{ $place['DEP_NAME'] }}" required><br>

        <label for="status" class="form-check-label">Төлөв:</label>
        <select id="status" name="status" required>
            <option value="A" @if ($place['STATUS'] == 'A') selected @endif>Идэвхитэй</option>
            <option value="N" @if ($place['STATUS'] == 'N') selected @endif>Идэвхгүй</option>
        </select><br>

        <label for="sortOrder" class="form-check-label">Эрэмбэ:</label>
        <input type="text" class="form-check-input" id="sortOrder" name="sortOrder" value="{{ $place['SORT_ORDER'] }}"><br>

        <label for="parentDepId" class="form-check-label">Эцэг газар нэгж</label>
        <select id="parentDepId" name="parentDepId" required>
            <option value="">[Сонгоно уу]</option>
            <?php
            $sname = "localhost";
            $uname = "root"; 
            $password = "";
            $db_name = "dastone";

            $conn = mysqli_connect($sname, $uname, $password, $db_name); 

            // Check connection
            if (!$conn) {
                echo "Connection failed!";
            } else {
                $sql = "SELECT DEP_ID, DEP_NAME FROM ORG_DEPARTMENT";

                $stmt = mysqli_query($conn, $sql);
                if($stmt) {
                    while($row = mysqli_fetch_assoc($stmt)) {
                        ?>
                        <option value="<?= $row["DEP_ID"] ?>">
                            <?= $row["DEP_NAME"] ?>
                        </option>
                        <?php
                    }
                }
                mysqli_close($conn); // Close the connection when done
            }
            ?>
        </select>

        <label for="directorEmpId" class="form-check-label">Захирал</label>
        <select id="directorEmpId" name="directorEmpId" required>
        <option value="">[Сонгоно уу]</option>
            <?php
            $sname = "localhost";
            $uname = "root"; 
            $password = "";
            $db_name = "dastone";

            $conn = mysqli_connect($sname, $uname, $password, $db_name); 

            // Check connection
            if (!$conn) {
                echo "Connection failed!";
            } else {
                $sql = "select E.EMP_ID,
								E.FIRSTNAME||'.'||substr(E.LASTNAME,0,1) EMPNAME,
								P.POS_NAME,
								D.DEP_NAME
							from ORG_EMPLOYEE e
							left join ORG_DEPARTMENT d on D.DEP_ID=E.DEP_ID
							left join ORG_POSITION p on P.POS_ID=E.POS_ID
							where E.STATUS!='D'
							order by E.DEP_ID, E.FIRSTNAME";

                $stmt = mysqli_query($conn, $sql);
                if($stmt) {
                    while($row = mysqli_fetch_assoc($stmt)) {
                        ?>
                            <option value="<?= $row["EMP_ID"] ?>">
                            <?=$row["EMPNAME"]?> (<?=$row["DEP_NAME"]?> - <?=$row["POS_NAME"]?>)
                            </option>
                        <?php
                    }
                }
                mysqli_close($conn); // Close the connection when done
            }
            ?>
        </select>

        <button class="btn btn-primary" type="submit">Засах</button>
        <button class="btn btn-danger" type="button" onclick="window.location='{{ route('viewplace') }}'">Буцах</button>
    </form>
</div>
@endsection