<?php
namespace App\Http\Controllers;

use App\Models\OrgEmployee;
use App\Models\OrgPosition;
use Illuminate\Http\Request;
use App\Models\OrgDepartment;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class EmployeeController extends Controller
{
    public function index()
    {
        $departments = DB::table('ORG_DEPARTMENT')->get();
        $positions = DB::table('ORG_POSITION')->get();

        return view('viewemployee', compact('departments', 'positions'));
    }

    public function employeeListTable(Request $request)
    {
        $query = DB::table('ORG_EMPLOYEE')
            ->join('ORG_POSITION', 'ORG_EMPLOYEE.POS_ID', '=', 'ORG_POSITION.POS_ID')
            ->join('ORG_DEPARTMENT', 'ORG_EMPLOYEE.DEP_ID', '=', 'ORG_DEPARTMENT.DEP_ID')
            ->select([
                'ORG_EMPLOYEE.EMP_ID as id',
                'ORG_EMPLOYEE.PICTURE_LINK as picture',
                'ORG_EMPLOYEE.LASTNAME as lastname',
                'ORG_EMPLOYEE.FIRSTNAME as firstname',
                'ORG_DEPARTMENT.DEP_NAME as department',
                'ORG_POSITION.POS_NAME as position',
                'ORG_EMPLOYEE.REGISTER as register',
                'ORG_EMPLOYEE.SEX as sex',
                'ORG_EMPLOYEE.EMAIL as email',
                'ORG_EMPLOYEE.BIRTHDATE as birthdate',
                'ORG_EMPLOYEE.HANDPHONE as handphone',
                'ORG_EMPLOYEE.WORKPHONE as workphone',
                'ORG_EMPLOYEE.STATUS as status'
            ]);

        return DataTables::of($query)
            ->addColumn('action', function($row) {
                $editBtn = '<a href="/editemployee/'.$row->id.'" class="btn btn-primary btn-xs">Засах</a>';
                $deleteBtn = '<form action="/deleteemployee/'.$row->id.'" method="POST" style="display:inline;">'.
                             csrf_field().
                             method_field('DELETE').
                             '<button type="submit" class="btn btn-danger btn-xs">Устгах</button>'.
                             '</form>';
                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'REGISTER' => 'required|string|regex:/^[A-Za-z]{2}[0-9]{8}$/|max:10',
            'FIRSTNAME' => 'required|string|regex:/^[^0-9]*$/|max:255',
            'LASTNAME' => 'required|string|regex:/^[^0-9]*$/|max:255',
            'POS_ID' => 'required|integer',
            'DEP_ID' => 'required|integer',
            'EMAIL' => 'required|string|email|max:255',
            'WORK_DATE' => 'required|date',
            'STATUS' => 'required|string|max:1',
            'BIRTHDATE' => 'required|date',
            'HANDPHONE' => 'required|string|regex:/^[6-9][0-9]{7}$/|max:8',
            'HOMEPHONE' => 'nullable|string|regex:/^[6-9][0-9]{7}$/|max:8',
            'WORKPHONE' => 'nullable|string|regex:/^[6-9][0-9]{7}$/|max:8',
            'SEX' => 'required|string|in:male,female',
            'PICTURE_LINK' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $employee = new OrgEmployee();
        $employee->fill($validatedData);
        $employee->PASS = bcrypt('default_password');
        $employee->FINGERID = 0;

        if ($request->hasFile('PICTURE_LINK')) {
            $file = $request->file('PICTURE_LINK');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('pictures', $filename, 'public');
            $employee->PICTURE_LINK = '/storage/' . $path;
        }

        $employee->save();

        return redirect()->back()->with('success', 'Employee added successfully');
    }

    public function edit($id)
    {
        $employee = OrgEmployee::findOrFail($id);

        if (request()->ajax()) {
            $departments = OrgDepartment::all();
            $positions = OrgPosition::all();

            return view('partials.editemployeeform', compact('employee', 'departments', 'positions'));
        }

        return redirect()->route('viewemployee')->with('error', 'Invalid request.');
    }

    public function update(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'EMP_ID' => 'required|integer',
            'REGISTER' => 'required|string|max:255',
            'FIRSTNAME' => 'required|string|max:255',
            'LASTNAME' => 'required|string|max:255',
            'POS_ID' => 'required|integer',
            'DEP_ID' => 'required|integer',
            'EMAIL' => 'required|string|email|max:255',
            'WORK_DATE' => 'required|date',
            'STATUS' => 'required|string|max:255',
            'BIRTHDATE' => 'required|date',
            'HANDPHONE' => 'required|string|max:255',
            'HOMEPHONE' => 'nullable|string|max:255',
            'WORKPHONE' => 'nullable|string|max:255',
            'SEX' => 'required|string|max:255',
            'PICTURE_LINK' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the employee by ID
        $employee = OrgEmployee::findOrFail($validatedData['EMP_ID']);

        // Update the employee's details
        $employee->REGISTER = $validatedData['REGISTER'];
        $employee->FIRSTNAME = $validatedData['FIRSTNAME'];
        $employee->LASTNAME = $validatedData['LASTNAME'];
        $employee->POS_ID = $validatedData['POS_ID'];
        $employee->DEP_ID = $validatedData['DEP_ID'];
        $employee->EMAIL = $validatedData['EMAIL'];
        $employee->WORK_DATE = $validatedData['WORK_DATE'];
        $employee->STATUS = $validatedData['STATUS'];
        $employee->BIRTHDATE = $validatedData['BIRTHDATE'];
        $employee->HANDPHONE = $validatedData['HANDPHONE'];
        $employee->HOMEPHONE = $validatedData['HOMEPHONE'];
        $employee->WORKPHONE = $validatedData['WORKPHONE'];
        $employee->SEX = $validatedData['SEX'];
        $employee->FINGERID = $request->input('FINGERID'); // Assuming FINGERID is part of the request

        // Handle the picture upload if provided
        if ($request->hasFile('PICTURE_LINK')) {
            $file = $request->file('PICTURE_LINK');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('pictures', $filename, 'public');
            $employee->PICTURE_LINK = '/storage/' . $path;
        }

        // Save the updated employee details
        $employee->save();

        // Redirect back with a success message
        return redirect()->back();
    }

    public function destroy($id)
    {
        DB::table('ORG_EMPLOYEE')->where('EMP_ID', $id)->delete();
        return redirect()->route('viewemployee')->with('success', 'Employee deleted successfully.');
    }
}