<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToastrTestController extends Controller
{
    public function index()
    {
        return view('admin.test.toastr');
    }

    public function success(Request $request)
    {
        return redirect()->back()->with('success', $request->input('message', 'This is a success message'));
    }

    public function error(Request $request)
    {
        return redirect()->back()->with('error', $request->input('message', 'This is an error message'));
    }

    public function info(Request $request)
    {
        return redirect()->back()->with('info', $request->input('message', 'This is an info message'));
    }

    public function warning(Request $request)
    {
        return redirect()->back()->with('warning', $request->input('message', 'This is a warning message'));
    }

    public function validation(Request $request)
    {
        return redirect()->back()->withErrors(['error1' => 'This is validation error 1', 'error2' => 'This is validation error 2']);
    }
}
