<?php

namespace App\Http\Controllers\Staff;

use App\Exports\SalesReportExport;
use App\Http\Controllers\Controller;
use App\Models\Laundry;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function reportView(Request $request)
    {
        $reports = Laundry::query()->whereHas('orders', function ($q) {
            $q->where('status', 2);
        })->whereHas('user', function ($q) use ($request) {
            $q->when($request->userSearch, function ($user) use ($request) {
                $user->where('name', 'LIKE', '%' . $request->userSearch . '%');
            });
        })->paginate(5);

        return view('staff.reports', compact('reports'));
    }

    public function reportGenerate(Request $request)
    {
        return Excel::download(new SalesReportExport($request), 'SalesReport-' . date("m-d-Y") . '.xlsx');
    }
}
