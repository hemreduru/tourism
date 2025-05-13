<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class ToastrTestController extends Controller
{
    public function index()
    {
        return view('admin.test.toastr');
    }

    public function success(Request $request)
    {
        ToastMagic::success($request->input('message', 'This is a success message'));
        return redirect()->back();
    }

    public function error(Request $request)
    {
        ToastMagic::error($request->input('message', 'This is an error message'));
        return redirect()->back();
    }

    public function info(Request $request)
    {
        ToastMagic::info($request->input('message', 'This is an info message'));
        return redirect()->back();
    }

    public function warning(Request $request)
    {
        ToastMagic::warning($request->input('message', 'This is a warning message'));
        return redirect()->back();
    }

    public function validation(Request $request)
    {
        ToastMagic::error('This is validation error 1');
        ToastMagic::error('This is validation error 2');
        return redirect()->back();
    }
}
