<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index()
    {
        return view('invoice.index');
    }

    public function create()
    {
        return view('invoice.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('invoice.show');
    }

    public function edit($id)
    {
        return view('invoice.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
