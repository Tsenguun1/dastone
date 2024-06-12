<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrgDepartment;

class NewController extends Controller
{
    public function viewemployee()
    {
        return view('viewemployee');
    }

    public function addemployee()
    {
        return view('addemployee');
    }

    public function addFormemployee()
    {
        $conn = $this->db_conn(); 

        if (isset($_POST['submit'])) {
            $Last_Name = $_POST['last_name'];
            $First_Name = $_POST['first_name'];
            $Register = $_POST['reg_number'];
            $Position = $_POST['position'];
            $Email = $_POST['email'];
            $HandPhone = $_POST['phone_number'];
            $Gender = $_POST['gender'];
            $Register = $_POST['reg_number'];
            $BirthDate = $_POST['birth_date'];
            $StartDate = $_POST['start_date'];
            $HomePhone = $_POST['home_number'];
            $WorkPhone = $_POST['work_number'];
            $Photo = $_POST['photo'];
            $Status = $_POST['state'];
            $editEmpId = '6666';
            $DepId = $_POST['place'];
            $Pass = 'pass';
            $editDate = date('Y-m-d');
            $finger = '12345678';
            $Pass_Date = date('Y-m-d');
            $PASS_EXPIRE_TERM = '3';

            $sql = "INSERT INTO ORG_EMPLOYEE (REGISTER,	FIRSTNAME,	LASTNAME,	POS_ID,	DEP_ID,	EMAIL,	PASS,	WORK_DATE,	STATUS,	BIRTHDATE,	HANDPHONE,	HOMEPHONE,	WORKPHONE,	FINGERID,	SEX,	PICTURE_LINK,	EDIT_DATE,	EDIT_EMPID,	PASS_DATE,	PASS_EXPIRE_TERM,	PASS_ENDDATE,	PASS_WRONG,	LAST_LOGINDATE	) 
                    VALUES ('$Register', '$First_Name', '$Last_Name','$Position','$DepId','$Email','$Pass','$StartDate','$Status','$BirthDate','$HandPhone','$HomePhone','$WorkPhone','$finger','$Gender','$Photo','$editDate','$editEmpId','$Pass_Date','$PASS_EXPIRE_TERM','$editDate','$PASS_EXPIRE_TERM','$editDate')";

            if (mysqli_query($conn, $sql)) {
                return view('viewemployee');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    public function deleteemployee($id)
    {
        $conn = $this->db_conn(); 

        $sql = "DELETE FROM ORG_EMPLOYEE WHERE EMP_ID='$id'";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            return redirect()->route('viewemployee');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public function updateemployee(Request $request, $id)
{
    $conn = $this->db_conn(); 

    if ($request->isMethod('post')) {
        $Last_Name = $request->input('last_name');
        $First_Name = $request->input('first_name');
        $Register = $request->input('reg_number');
        $Position = $request->input('position');
        $Email = $request->input('email');
        $HandPhone = $request->input('phone_number');
        $Gender = $request->input('gender');
        $BirthDate = $request->input('birth_date');
        $StartDate = $request->input('start_date');
        $HomePhone = $request->input('home_number');
        $WorkPhone = $request->input('work_number');
        $Photo = $request->input('photo');  // Handle file uploads separately if applicable
        $Status = $request->input('state');
        $editEmpId = '6666';
        $DepId = $_POST['place'];
        $Pass = 'pass';
        $editDate = date('Y-m-d');
        $finger = '12345678';
        $Pass_Date = date('Y-m-d');
        $PASS_EXPIRE_TERM = '3';

        $sql = "UPDATE ORG_EMPLOYEE SET 
                REGISTER='$Register', 
                FIRSTNAME='$First_Name', 
                LASTNAME='$Last_Name', 
                POS_ID='$Position', 
                DEP_ID='$DepId', 
                EMAIL='$Email', 
                PASS='$Pass', 
                WORK_DATE='$StartDate', 
                STATUS='$Status', 
                BIRTHDATE='$BirthDate', 
                HANDPHONE='$HandPhone', 
                HOMEPHONE='$HomePhone', 
                WORKPHONE='$WorkPhone', 
                FINGERID='$finger', 
                SEX='$Gender', 
                PICTURE_LINK='$Photo', 
                EDIT_DATE='$editDate', 
                EDIT_EMPID='$editEmpId', 
                PASS_DATE='$Pass_Date', 
                PASS_EXPIRE_TERM='$PASS_EXPIRE_TERM', 
                PASS_ENDDATE='$editDate', 
                PASS_WRONG='$PASS_EXPIRE_TERM', 
                LAST_LOGINDATE='$editDate'
                WHERE EMP_ID='$id'";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            return redirect()->route('viewemployee');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        $sql = "SELECT * FROM ORG_EMPLOYEE WHERE EMP_ID='$id'";
        $result = mysqli_query($conn, $sql);
        $place = mysqli_fetch_assoc($result);

        mysqli_close($conn);

        return view('updateemployee', compact('place'));
    }
}










    public function viewposition()
    {
        return view('viewposition');
    }

    public function addposition()
    {
        return view('addposition');
    }

    public function addFormpos()
    {
        $conn = $this->db_conn(); 

        if (isset($_POST['submit'])) {
            $posName = $_POST['posName'];
            $status = $_POST['status'];
            $sortOrder = $_POST['sortOrder'];
            $editEmpId = '6666';
            $editDate = date('Y-m-d');

            $sql = "INSERT INTO ORG_POSITION (POS_NAME, STATUS, EDIT_DATE, EDIT_EMPID, SORT_ORDER) 
                    VALUES ('$posName', '$status', '$editDate', '$editEmpId','$sortOrder')";

            if (mysqli_query($conn, $sql)) {
                return view('viewposition');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    public function deleteposition($id)
    {
        $conn = $this->db_conn(); 

        $sql = "DELETE FROM ORG_POSITION WHERE POS_ID='$id'";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            return redirect()->route('viewposition');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public function updateposition(Request $request, $id)
    {
        $conn = $this->db_conn(); 
    
        if ($request->isMethod('post')) {
            $posName = $request->input('posName');
            $status = $request->input('status');
            $sortOrder = $request->input('sortOrder');
            $editEmpId = '6666';
            $editDate = date('Y-m-d');
    
            $sql = "UPDATE ORG_POSITION SET 
                        POS_NAME='$posName', 
                        STATUS='$status', 
                        EDIT_DATE='$editDate', 
                        EDIT_EMPID='$editEmpId', 
                        SORT_ORDER='$sortOrder'
                    WHERE POS_ID='$id'";
    
            if (mysqli_query($conn, $sql)) {
                mysqli_close($conn);
                return redirect()->route('viewposition');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    
        $sql = "SELECT * FROM ORG_POSITION WHERE POS_ID='$id'";
        $result = mysqli_query($conn, $sql);
        $place = mysqli_fetch_assoc($result);
    
        mysqli_close($conn);
    
        return view('updateposition', compact('place'));
    }
    



    public function viewplace()
    {
        return view('viewplace');
    }

    public function addplace()
    {
        return view('addplace');
    }

    private function db_conn()
    {
        $sname = "localhost";
        $uname = "root"; 
        $password = "";
        $db_name = "dastone";

        $conn = mysqli_connect($sname, $uname, $password, $db_name); 

        if (!$conn) {
            echo "Connection failed!";
        } else {
            return $conn;
        }
    }

    public function addForm()
    {
        $conn = $this->db_conn(); 

        if (isset($_POST['submit'])) {
            $depName = $_POST['depName'];
            $status = $_POST['status'];
            $sortOrder = $_POST['sortOrder'];
            $parentDepId = $_POST['parentDepId'];
            $directorEmpId = $_POST['directorEmpId'];
            $approveEmpId = '9999';
            $editEmpId = '6666';
            $editDate = date('Y-m-d');

            $sql = "INSERT INTO ORG_DEPARTMENT (DEP_NAME, STATUS, SORT_ORDER, PARENT_DEPID, DIRECTOR_EMPID, APPROVE_EMPID, EDIT_EMPID, EDIT_DATE) 
                    VALUES ('$depName', '$status', '$sortOrder', '$parentDepId', '$directorEmpId', '$approveEmpId', '$editEmpId', '$editDate')";

            if (mysqli_query($conn, $sql)) {
                header("Location: " . route('viewplace'));
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                header("Location: " . route('viewplace'));
                exit();
            }
        }
    }

    public function deleteplace($id)
    {
        $conn = $this->db_conn(); 

        $sql = "DELETE FROM ORG_DEPARTMENT WHERE DEP_ID='$id'";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            return redirect()->route('viewplace');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    public function updateplace(Request $request, $id)
    {
        $conn = $this->db_conn(); 

        if ($request->isMethod('post')) {
            $depName = $request->input('depName');
            $status = $request->input('status');
            $sortOrder = $request->input('sortOrder');
            $parentDepId = $request->input('parentDepId');
            $directorEmpId = $request->input('directorEmpId');
            $approveEmpId = '9999';
            $editEmpId = '6666';
            $editDate = date('Y-m-d');

            $sql = "UPDATE ORG_DEPARTMENT SET 
                        DEP_NAME='$depName', 
                        STATUS='$status', 
                        SORT_ORDER='$sortOrder', 
                        PARENT_DEPID='$parentDepId', 
                        DIRECTOR_EMPID='$directorEmpId', 
                        APPROVE_EMPID='$approveEmpId', 
                        EDIT_EMPID='$editEmpId', 
                        EDIT_DATE='$editDate' 
                    WHERE DEP_ID='$id'";

            if (mysqli_query($conn, $sql)) {
                mysqli_close($conn);
                return redirect()->route('viewplace');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        $sql = "SELECT * FROM ORG_DEPARTMENT WHERE DEP_ID='$id'";
        $result = mysqli_query($conn, $sql);
        $place = mysqli_fetch_assoc($result);

        mysqli_close($conn);

        return view('updateplace', compact('place'));
    }


}
