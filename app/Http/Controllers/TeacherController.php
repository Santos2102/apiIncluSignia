<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class TeacherController
 * @package App\Http\Controllers
 */
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try 
        {
            $teachers = Teacher::where('status','Active')->with('person')->get();

            return view('teacher.index', compact('teachers'));
        }
        catch(\Exception $e)
        {
            return back() -> with('error', 'Se produjo un error al procesar la solicitud');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try
        {
            return view('teacher.create');
        }
        catch(\Exception $e)
        {
            return back() -> with('error', 'Se produjo un error al procesar la solicitud');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            //request()->validate(Teacher::$rules);
            $person = new Person([
                'name' => $request->name,
                'lastName' => $request->lastname,
                'birthDate' => $request->birthDate,
                'age' => $request->age,
                'cui' => $request->cui,
            ]);
            $person->save();

            //return $person;
            $teacher = new Teacher([
                'personId' => $person->personId,
                'roleId'=>2,
            ]);
            $teacher->save();

            DB::commit();
            return redirect()->route('docentes.index')
                ->with('success', 'Docente creado éxitosamente.');
        }
        catch(\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Teacher::find($id);

        return view('teacher.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $teacher = Teacher::where('teacherId',decrypt($id))->with('person')->first();
            return view('teacher.edit', compact('teacher'));
        }
        catch(\Exception $e)
        {
            return back() -> with('error', 'Se produjo un error al procesar la solicitud');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try
        {
            $teacher = Teacher::where('teacherId',decrypt($id))->with('person')->first();
            $person = Person::find($teacher -> person -> personId);
            $person -> fill([
            'name' => $request -> name,
            'lastName' => $request -> lastname,
            'cui' => $request -> cui,
            'birthDate' => $request -> birthDate,
            'age' => $request -> age
            ]);
            $person -> save();
            DB::commit();
            return redirect()->route('docentes.index')
                ->with('success', 'Docente actualizado correctamente');
        }
        catch(\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->validator->errors())->withInput();
        }
        //request()->validate(Teacher::$rules);
        
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        try
        {
            $teacher = Teacher::find(decrypt($id))->update(['status'=>'Inactive']);

        return redirect()->route('docentes.index')
            ->with('success', 'Docente eliminado éxitosamente');
        }
        catch(\Exception $e)
        {
            return back() -> with('error', 'Se produjo un error al procesar la solicitud');
        }
    }
}
