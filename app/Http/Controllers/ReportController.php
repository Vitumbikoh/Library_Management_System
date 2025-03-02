<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generateNew()
    {
        // Logic for generating the report
        // For example, you might create and save a new report to the database

        // Redirect back with a success message
        return redirect()->route('admin.reports.index')->with('success', 'New report generated successfully!');
    }
}
