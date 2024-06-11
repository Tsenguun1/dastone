@extends('viewemployee')
@section('viewform')
<div class="form-container-update" style='position: absolute; top: 10%; z-index: 1; background-color: white' id="formContainerUpdate">
    <form method="POST" action="{{ route('updateemployee', ['id' => $place['EMP_ID']]) }}">
        @csrf
        <label class="form-label" for="last_name">Эцэг/эхийн нэр:</label>
        <input class="form-control" type="text" id="last_name" name="last_name" value="{{ $place['LASTNAME'] }}" required>

        <label class="form-label" for="first_name">Өөрийн нэр:</label>
        <input class="form-control" type="text" id="first_name" name="first_name" value="{{ $place['FIRSTNAME'] }}" required>

        <label class="form-label" for="reg_number">Регистрийн дугаар:</label>
        <input class="form-control" type="text" id="reg_number" name="reg_number" value="{{ $place['REGISTER'] }}" required>

        <label class="form-label" for="place">Газар нэгж:</label>
            <select class="form-control" id="place" name="place" required>
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

        <label class="form-label" for="position">Албан тушаал:</label>
        <select class="form-control" id="position" name="position" required>
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
                    $sql = "SELECT POS_ID, POS_NAME FROM ORG_POSITION";

                    $stmt = mysqli_query($conn, $sql);
                    if($stmt) {
                        while($row = mysqli_fetch_assoc($stmt)) {
                            ?>
                            <option value="<?= $row["POS_ID"] ?>">
                                <?= $row["POS_NAME"] ?>
                            </option>
                            <?php
                        }
                    }
                    mysqli_close($conn); // Close the connection when done
                }
                ?>
            </select>
        </select>

        <label class="form-label" for="email">И-мэйл:</label>
        <input class="form-control" type="email" id="email" name="email" value="{{ $place['EMAIL'] }}" required>

        <label class="form-label" for="phone_number">Гар утасны дугаар:</label>
        <input class="form-control" type="text" id="phone_number" name="phone_number" value="{{ $place['HANDPHONE'] }}" required>

        <label class="form-label" for="gender">Хүйс:</label>
        <select class="form-control" id="gender" name="gender" required>
            <option value="male" @if ($place['SEX'] == 'male') selected @endif>Эрэгтэй</option>
            <option value="female" @if ($place['SEX'] == 'female') selected @endif>Эмэгтэй</option>
        </select>

        <label class="form-label" for="birth_date">Төрсөн өдөр:</label>
        <input class="form-control" type="date" id="birth_date" name="birth_date" value="{{ $place['BIRTHDATE'] }}" required>

        <label class="form-label" for="start_date">Ажилд орсон өдөр:</label>
        <input class="form-control" type="date" id="start_date" name="start_date" value="{{ $place['WORK_DATE'] }}" required>

        <label class="form-label" for="home_number">Гэрийн утасны дугаар:</label>
        <input class="form-control" type="text" id="home_number" name="home_number" value="{{ $place['HOMEPHONE'] }}">

        <label class="form-label" for="work_number">Ажлын утасны дугаар:</label>
        <input class="form-control" type="text" id="work_number" name="work_number" value="{{ $place['WORKPHONE'] }}">

        <label class="form-label" for="photo">Зураг:</label>
        <input class="form-control" type="file" id="photo" name="photo">

        <label class="form-label" for="state">Төлөв:</label>
        <select class="form-control" id="state" name="state" required>
            <option value="inactive" @if ($place['STATUS'] == 'inactive') selected @endif>Идэвхгүй</option>
            <option value="active" @if ($place['STATUS'] == 'active') selected @endif>Идэвхтэй</option>
        </select>

        <button class="btn btn-primary" type="submit">Засах</button>
        <button class="btn btn-danger" type="button" onclick="window.location='{{ route('viewemployee') }}'">Буцах</button>
    </form>
</div>
@endsection
