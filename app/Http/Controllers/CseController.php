<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        $reader->setSheetIndex(0);
        $catalogPath = Storage::disk('public')->path('templates\cse_items.csv');
        $spreadsheet = $reader->load($catalogPath);

        dd($spreadsheet->getActiveSheet()->toArray());
    }
}
