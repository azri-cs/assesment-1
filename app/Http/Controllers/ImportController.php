<?php

namespace App\Http\Controllers;

use App\Imports\DebtNotificationImport;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function import(Request $request): RedirectResponse
    {
        if ($request->hasFile('excel_file')){
            Excel::import(new DebtNotificationImport(), $request->file('excel_file'));

            return to_route('dashboard')->with('success', __("Excel file is being imported in the background, we'll notify via email upon on the import status."));
        }

        return to_route('dashboard')->with('error', __('Something went wrong on file upload.'));
    }
}
