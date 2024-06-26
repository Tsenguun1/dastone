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
            ->where('ORG_DEPARTMENT.STATUS', '!=', 'D')
            ->orderBy('ORG_DEPARTMENT.SORT_ORDER')
            ->get();
    
        foreach ($departments as $department) {
            $department->DIRECTOR = $department->DIRECTOR_FIRSTNAME . ' ' . $department->DIRECTOR_LASTNAME;
            $department->STATUSVALUE = $department->STATUS == 'A' ? 'Идэвхитэй' : ($department->STATUS == 'N' ? 'Идэвхгүй' : 'Unknown Status');
        }
    
        $flattenedTree = [];
        $this->flattenTreeWithIndentation($departments->toArray(), null, 0, $flattenedTree);
    
        return DataTables::of($flattenedTree)
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" class="btn btn-success btn-xs btn-custom edit-button" data-id="' . $row->DEP_ID . '">Засах</button>
                    <form action="' . route('deleteplace', $row->DEP_ID) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-xs btn-custom" style="margin-left: 5px;">Устгах</button>
                    </form>';
            })
            ->addColumn('DIRECTOR', function ($row) {
                return !empty($row->DIRECTOR) ? $row->DIRECTOR : 'Director Not Assigned';
            })
            ->rawColumns(['DEP_NAME', 'action'])
            ->make(true);
    }
    
    private function flattenTreeWithIndentation(array $elements, $parentId, $level, &$flattenedTree)
    {
        foreach ($elements as $element) {
            if ($element->PARENT_DEPID == $parentId) {
                $indent = '<span style="display:inline-block; width:' . ($level * 40) . 'px;"></span>';
                $element->DEP_NAME = $indent . htmlspecialchars($element->DEP_NAME, ENT_QUOTES, 'UTF-8');
                $element->indent_level = $level;
    
                $flattenedTree[] = $element;
                $this->flattenTreeWithIndentation($elements, $element->DEP_ID, $level + 1, $flattenedTree);
            }
        }
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
        if ($request->isMethod('post')) {
            $request->validate([
                'depName' => 'required|string|max:255',
                'status' => 'required|string|max:10',
                'sortOrder' => 'nullable|integer', // Make sure 'sortOrder' can be nullable if not required
                'parentDepId' => 'required|integer',
                'directorEmpId' => 'required|integer',
            ]);

            $department = new OrgDepartment();
            $department->dep_name = $request->depName;
            $department->status = $request->status;
            $department->sort_order = $request->sortOrder ?? 0; // Default to 0 if not provided
            $department->parent_depid = $request->parentDepId;
            $department->director_empid = $request->directorEmpId;
            $department->approve_empid = '9999';
            $department->edit_empid = '6666';
            $department->edit_date = now();

            $department->save();

            return redirect()->route('viewplace');
        }

        // Load necessary data for the form if needed
        $departments = OrgDepartment::all();
        $employees = OrgEmployee::all();

        return view('addForm', compact('departments', 'employees'));
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