<?php

namespace App\Http\Controllers;

use App\Models\OrgEmployee;
use App\Models\OrgDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PlaceController extends Controller
{
    public function viewPlaces()
    {
        $departments = DB::table('ORG_DEPARTMENT')
            ->leftJoin('ORG_EMPLOYEE', 'ORG_DEPARTMENT.DIRECTOR_EMPID', '=', 'ORG_EMPLOYEE.EMP_ID')
            ->select(
                'ORG_DEPARTMENT.DEP_ID',
                'ORG_DEPARTMENT.DEP_NAME',
                'ORG_DEPARTMENT.STATUS',
                'ORG_DEPARTMENT.SORT_ORDER',
                'ORG_DEPARTMENT.PARENT_DEPID',
                'ORG_DEPARTMENT.DIRECTOR_EMPID',
                'ORG_DEPARTMENT.EDIT_DATE',
                'ORG_EMPLOYEE.FIRSTNAME as DIRECTOR_FIRSTNAME',
                'ORG_EMPLOYEE.LASTNAME as DIRECTOR_LASTNAME'
            )
            ->where('ORG_DEPARTMENT.STATUS', '!=', 'D') // Exclude deleted departments
            ->orderBy('ORG_DEPARTMENT.SORT_ORDER')
            ->get()
            ->toArray();

        foreach ($departments as $department) {
            $department->DIRECTOR = $department->DIRECTOR_FIRSTNAME . ' ' . $department->DIRECTOR_LASTNAME;
            if ($department->STATUS == 'A') {
                $department->STATUSVALUE = 'Идэвхитэй';
            } elseif ($department->STATUS == 'N') {
                $department->STATUSVALUE = 'Идэвхгүй';
            } else {
                $department->STATUSVALUE = 'Unknown Status';
            }
        }

        $departmentTree = $this->buildTree($departments);

        // Fetch employees
        $employees = DB::table('ORG_EMPLOYEE')
            ->select(
                'EMP_ID',
                DB::raw("CONCAT(FIRSTNAME, ' ', LASTNAME) AS EMPNAME"),
                'ORG_POSITION.POS_NAME',
                'ORG_DEPARTMENT.DEP_NAME'
            )
            ->join('ORG_DEPARTMENT', 'ORG_EMPLOYEE.DEP_ID', '=', 'ORG_DEPARTMENT.DEP_ID')
            ->join('ORG_POSITION', 'ORG_EMPLOYEE.POS_ID', '=', 'ORG_POSITION.POS_ID')
            ->where('ORG_EMPLOYEE.STATUS', '!=', 'D')
            ->get();

        return view('viewplace', [
            'departmentTree' => $departmentTree,
            'departments' => $departments,
            'employees' => $employees, // Pass employees to the view
        ]);
    }

    public function placeListTable(Request $request)
    {
        $query = DB::table('ORG_DEPARTMENT')
            ->leftJoin('ORG_EMPLOYEE', 'ORG_DEPARTMENT.DIRECTOR_EMPID', '=', 'ORG_EMPLOYEE.EMP_ID')
            ->select(
                'ORG_DEPARTMENT.DEP_ID',
                'ORG_DEPARTMENT.DEP_NAME',
                DB::raw("CONCAT(ORG_EMPLOYEE.FIRSTNAME, ' ', ORG_EMPLOYEE.LASTNAME) AS DIRECTOR"),
                'ORG_DEPARTMENT.STATUS',
                'ORG_DEPARTMENT.SORT_ORDER',
                'ORG_DEPARTMENT.EDIT_DATE',
                DB::raw("CASE 
                            WHEN ORG_DEPARTMENT.STATUS = 'A' THEN 'Идэвхитэй' 
                            WHEN ORG_DEPARTMENT.STATUS = 'N' THEN 'Идэвхгүй' 
                            ELSE 'Unknown Status' 
                         END AS STATUSVALUE")
            )
            ->where('ORG_DEPARTMENT.STATUS', '!=', 'D')
            ->orderBy('ORG_DEPARTMENT.SORT_ORDER');

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" class="btn btn-success btn-xs btn-custom edit-button" data-id="' . $row->DEP_ID . '">Засах</button>
                    <form action="' . route('deleteplace', $row->DEP_ID) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-xs btn-custom" style="margin-left: 5px;">Устгах</button>
                    </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    private function buildTree(array $elements, $parentId = null)
    {
        $branch = [];
        foreach ($elements as $element) {
            if ($element->PARENT_DEPID == $parentId) {
                $children = $this->buildTree($elements, $element->DEP_ID);
                if ($children) {
                    $element->children = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

    public function addPlace(Request $request)
    {
        $request->validate([
            'depName' => 'required|string|max:255',
            'status' => 'required|string|max:10',
            'sortOrder' => 'required|integer',
            'parentDepId' => 'required|integer',
            'directorEmpId' => 'required|integer',
        ]);

        OrgDepartment::create([
            'DEP_NAME' => $request->depName,
            'STATUS' => $request->status,
            'SORT_ORDER' => $request->sortOrder,
            'PARENT_DEPID' => $request->parentDepId,
            'DIRECTOR_EMPID' => $request->directorEmpId,
            'APPROVE_EMPID' => '9999',  // You can change these values as needed
            'EDIT_EMPID' => '6666',
            'EDIT_DATE' => now(),
        ]);

        return redirect()->route('viewplace')->with('success', 'Department added successfully.');
    }


    public function editplace($id)
    {
        $place = OrgDepartment::findOrFail($id);

        if (request()->ajax()) {
            $departments = DB::table('ORG_DEPARTMENT')
                ->select('DEP_ID', 'DEP_NAME')
                ->where('STATUS', '!=', 'D')
                ->get();

            $employees = DB::table('ORG_EMPLOYEE')
                ->select(
                    'EMP_ID',
                    DB::raw("CONCAT(FIRSTNAME, '.', LEFT(LASTNAME, 1)) AS EMPNAME"),
                    'ORG_POSITION.POS_NAME',
                    'ORG_DEPARTMENT.DEP_NAME'
                )
                ->join('ORG_DEPARTMENT', 'ORG_EMPLOYEE.DEP_ID', '=', 'ORG_DEPARTMENT.DEP_ID')
                ->join('ORG_POSITION', 'ORG_EMPLOYEE.POS_ID', '=', 'ORG_POSITION.POS_ID')
                ->where('ORG_EMPLOYEE.STATUS', '!=', 'D')
                ->get();

            return view('partials.editplaceform', compact('place', 'departments', 'employees'));
        }

        return redirect()->route('viewplace')->with('error', 'Invalid request.');
    }

    public function updateplace(Request $request, $id)
    {
        $place = OrgDepartment::findOrFail($id);

        $request->validate([
            'depName' => 'required|string|max:255',
            'status' => 'required|string|max:10',
            'sortOrder' => 'required|integer',
            'parentDepId' => 'required|integer',
            'directorEmpId' => 'required|integer',
        ]);

        $place->DEP_NAME = $request->depName;
        $place->STATUS = $request->status;
        $place->SORT_ORDER = $request->sortOrder;
        $place->PARENT_DEPID = $request->parentDepId;
        $place->DIRECTOR_EMPID = $request->directorEmpId;
        $place->APPROVE_EMPID = '9999';
        $place->EDIT_EMPID = '6666';
        $place->EDIT_DATE = now();

        $place->save();

        return redirect()->route('viewplace')->with('success', 'Department updated successfully!');
    }

    public function deleteplace($id)
    {
        $place = OrgDepartment::findOrFail($id);
        $place->STATUS = 'D'; // Assuming 'D' represents deleted or deactivated status
        $place->save();

        return redirect()->route('viewplace');
    }
}
