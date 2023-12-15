<?php

namespace App\Exports;

use App\Models\Laundry;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalesReportExport implements FromCollection
{

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $request = $this->request;

        return Laundry::whereHas('orders', function ($q) {
            $q->where('status', 2);
        })->whereHas('user', function ($q) use ($request) {
            $q->when($request->userSearch, function ($user) use ($request) {
                $user->where('name', 'LIKE', '%' . $request->userSearch . '%');
            });
        })->get();
    }
}
