<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Company\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $companies = Company::all();
        return view('admin::companies.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin::companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        Company::create([
            'name'=>$request->name
        ]);
        return redirect()->back()->with('success','company created successfully !') ;
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id) ;
        return view('admin::companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        Company::findOrFail($id)->update([
            'name'=>$request->name
        ]);
        return redirect()->back()->with('success','company updated successfully !') ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        Company::findOrFail($id)->delete();
        return redirect()->back()->with('success','company deleted successfully !') ;

    }
}
