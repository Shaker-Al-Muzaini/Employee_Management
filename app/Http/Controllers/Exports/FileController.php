<?php

namespace App\Http\Controllers\Exports;

use App\Exports\WorkerExport;
use App\Http\Controllers\Controller;
use App\Imports\WorkerImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FileController extends Controller
{
    public function export(){
        return Excel::download(new WorkerExport, 'worker.xlsx');
    }

    public function import()
    {
        return Excel::import(new WorkerImport, request()->file('exl'),null,\Maatwebsite\Excel\Excel::XLSX);

    }
}
