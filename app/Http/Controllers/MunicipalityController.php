<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipality;
use App\Models\Department;
use App\Http\Controllers\MunicipalityController;

class MunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $municipality = Municipality::where('status','Active')->with('departments')->get();
        //return $municipality;
        return view('configuration.municipalities.index', compact('municipality'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $department = Department::where('status','Active')->get(['departmentId','departmentName']);
        return view('configuration.municipalities.create', compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $munipality = new Municipality();
        $munipality->municipalityName = $request->municipalityName;
        $munipality->departmentId = decrypt ($request -> departmentId);  

        $munipality->save();
        return redirect()->action([MunicipalityController::class,'index'])->with('success','Municipio creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
