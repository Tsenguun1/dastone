<?php
namespace App\Http\Controllers;

use App\Models\OrgPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    public function viewpositions()
    {
        return view('viewposition');

    }

    public function positionListTable(Request $request)
    {
        $columns = [
            'POS_ID',
            'POS_NAME',
            'STATUS',
            'SORT_ORDER',
            'EDIT_DATE'
        ];

        $query = DB::table('ORG_POSITION')
            ->where('STATUS', '!=', 'D')
            ->select($columns);

        if ($request->has('order') && $request->has('columns')) {
            $orderByColumn = $columns[$request->input('order.0.column')];
            $orderByDirection = $request->input('order.0.dir');
            $query->orderBy($orderByColumn, $orderByDirection);
        }

        return DataTables::of($query)
            ->editColumn('STATUS', function ($row) {
                if ($row->STATUS == 'A') {
                    return 'Идэвхитэй';
                } elseif ($row->STATUS == 'N') {
                    return 'Идэвхигүй';
                } else {
                    return 'Unknown Status';
                }
            })
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" class="btn btn-success btn-xs" data-bs-toggle="modal" data-bs-target="#editPositionModal" data-id="' . $row->POS_ID . '">Засах</button>
                    <form action="' . route('deleteposition', $row->POS_ID) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-xs" style="margin-left: 5px;">Устгах</button>
                    </form>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function addFormpos(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'posName' => 'required|string|max:255',
                'status' => 'required|string|max:10',
                'sortOrder' => 'required|integer',
            ]);

            $position = new OrgPosition();
            $position->POS_NAME = $request->posName;
            $position->STATUS = $request->status;
            $position->SORT_ORDER = $request->sortOrder;
            $position->EDIT_DATE = now()->addHours(12);
            $position->EDIT_EMPID = '6666';

            $position->save();

            return redirect()->route('viewposition');
        }

        return view('addposition');
    }

    public function deleteposition($id)
    {
        $position = OrgPosition::findOrFail($id);
        $position->status = 'D';
        $position->save();

        return redirect()->route('viewposition');
    }

    public function editposition($id)
    {
        $position = OrgPosition::findOrFail($id);

        if (request()->ajax()) {
            $positions = DB::table('ORG_POSITION')
                ->select('POS_ID', 'POS_NAME')
                ->where('STATUS', '!=', 'D')
                ->get();

            return view('partials.editpositionform', [
                'position' => $position,
                'positions' => $positions
            ]);
        }
        return redirect()->route('viewposition')->with('error', 'Invalid request.');
    }

    public function updateposition(Request $request, $id)
    {
        $position = OrgPosition::findOrFail($id);

        $request->validate([
            'posName' => 'required|string|max:255',
            'status' => 'required|string|max:10',
            'sortOrder' => 'required|integer',
        ]);

        $position->POS_NAME = $request->posName;
        $position->STATUS = $request->status;
        $position->SORT_ORDER = $request->sortOrder;
        $position->EDIT_DATE = now();
        $position->EDIT_EMPID = '6666';

        $position->save();

        return redirect()->route('viewposition')->with('success', 'Position updated successfully!');
    }
}
