<div class="modal fade" id="AddEmployeeForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="form-container" style='position: absolute; top: 10%; z-index: 1; background-color: white' id="formContainer">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form id="registrationForm" method="POST" action="{{ route('addformemployee') }}">
        @csrf
            <label class="form-label" for="last_name">Эцэг/эхийн нэр:</label>
            <input class="form-control" type="text" id="last_name" name="last_name" required>
       
            <label class="form-label" for="first_name">Өөрийн нэр:</label>
            <input class="form-control" type="text" id="first_name" name="first_name" required>
       
            <label class="form-label" for="reg_number">Регистрийн дугаар:</label>
            <input class="form-control" type="text" id="reg_number" name="reg_number" required>

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
      
            <label class="form-label" for="email">И-мэйл:</label>
            <input class="form-control" type="email" id="email" name="email" required>
        
            <label class="form-label" for="phone_number">Гар утасны дугаар:</label>
            <input class="form-control" type="text" id="phone_number" name="phone_number" required>
       
            <label class="form-label" for="gender">Хүйс:</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="male">Эрэгтэй</option>
                <option value="female">Эмэгтэй</option>
            </select>
      
            <label class="form-label" for="birth_date">Төрсөн өдөр:</label>
            <input class="form-control" type="date" id="birth_date" name="birth_date" required>
      
            <label class="form-label" for="start_date">Ажилд орсон өдөр:</label>
            <input class="form-control" type="date" id="start_date" name="start_date" required>
        
            <label class="form-label" for="home_number">Гэрийн утасны дугаар:</label>
            <input class="form-control" type="text" id="home_number" name="home_number">
        
            <label class="form-label" for="work_number">Ажлын утасны дугаар:</label>
            <input class="form-control" type="text" id="work_number" name="work_number">
      
            <label class="form-label" for="photo">Зураг:</label>
            <input class="form-control" type="file" id="photo" name="photo">
       
            <label class="form-label" for="state">Төлөв:</label>
            <select class="form-control" id="state" name="state" required>
                <option value="inactive">Идэвхгүй</option>
                <option value="active">Идэвхтэй</option>
            </select>
            <button class="btn btn-primary" type="submit" name="submit">Хадгалах</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
    </form>
</div> 
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->

<!-- addplace.blade.php -->
<div class="modal fade" id="UpdateEmployeeForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="form-container" style='position: absolute; top: 10%; z-index: 1; background-color: white' id="formContainer">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('updateemployee') }}">
            @csrf
            <input type="hidden" name="EMP_ID" id="modal-emp-id">
            <label class="form-label" for="last_name">Эцэг/эхийн нэр:</label>
            <input class="form-control" type="text" id="last_name" name="last_name" required>
       
            <label class="form-label" for="first_name">Өөрийн нэр:</label>
            <input class="form-control" type="text" id="first_name" name="first_name" required>
       
            <label class="form-label" for="reg_number">Регистрийн дугаар:</label>
            <input class="form-control" type="text" id="reg_number" name="reg_number" required>

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
      
            <label class="form-label" for="email">И-мэйл:</label>
            <input class="form-control" type="email" id="email" name="email" required>
        
            <label class="form-label" for="phone_number">Гар утасны дугаар:</label>
            <input class="form-control" type="text" id="phone_number" name="phone_number" required>
       
            <label class="form-label" for="gender">Хүйс:</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="male">Эрэгтэй</option>
                <option value="female">Эмэгтэй</option>
            </select>
      
            <label class="form-label" for="birth_date">Төрсөн өдөр:</label>
            <input class="form-control" type="date" id="birth_date" name="birth_date" required>
      
            <label class="form-label" for="start_date">Ажилд орсон өдөр:</label>
            <input class="form-control" type="date" id="start_date" name="start_date" required>
        
            <label class="form-label" for="home_number">Гэрийн утасны дугаар:</label>
            <input class="form-control" type="text" id="home_number" name="home_number">
        
            <label class="form-label" for="work_number">Ажлын утасны дугаар:</label>
            <input class="form-control" type="text" id="work_number" name="work_number">
      
            <label class="form-label" for="photo">Зураг:</label>
            <input class="form-control" type="file" id="photo" name="photo">
       
            <label class="form-label" for="state">Төлөв:</label>
            <select class="form-control" id="state" name="state" required>
                <option value="inactive">Идэвхгүй</option>
                <option value="active">Идэвхтэй</option>
            </select>
            <button class="btn btn-primary" type="submit" name="submit">Засах</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Хаах</button>
    </form>
</div> 
        </div>
    </div>
</div>

