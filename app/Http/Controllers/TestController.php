<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Student;
use Illuminate\Http\Request;

/**
 * Class TestController
 * @package App\Http\Controllers
 */
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $tests = Student::with('person')->get();
            return view('test.index', compact('tests'));
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Se produjo un error al procesar la solicitud');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('test.create');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Se produjo un error al procesar la solicitud');
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
        try{
            $request->validate([
                'code'=>'required|string|min:10|max:10',
                'score'=>'required',
                'level'=>'required'
            ]);
            $student = Student::where('code',$request->code)->first();
            if($student==null){
                return redirect()->back()->with('error','El código ingresado es inválido');
            }
            else{
                if ($student->status=='Inactive'){
                    return redirect()->back()->with('error','El estudiante ya no forma parte de la institución');
                }
                $studentId = $student->studentId;
            }
            $test = new Test([
                'level' => $request->level,
                'score' => $request->score,
                'studentId' => $studentId
            ]);
            $test->save();
            return redirect()->route('evaluaciones.show', ['evaluacione' => encrypt($studentId)])->with('success', 'Evaluación actualizada exitosamente');
        }
        catch(\Illuminate\Validation\ValidationException $e) {
            //DB::rollBack();
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
        try{
            $tests = Test::where('studentId',decrypt($id))->get();
            $student = Student::where('studentId',decrypt($id))->with('person')->first();
            return view('test.show', compact('tests','student'));
        }
        catch(\Exception $e){
            return redirect()->back()->with('error','Se produjo un error al procesar la solicitud');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $test = Test::find(decrypt($id));
            $student = Student::find($test->studentId);
            return view('test.edit', compact('test','student'));
        }
        catch(\Exception $e){
            return redirect()->back()->with('error','Se produjo un error al procesar la solicitud');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Test $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'code'=>'required|string|min:10|max:10',
                'level'=>'required',
                'score'=>'required'
            ]);
            $test = Test::where('testId',decrypt($id))->with('student')->first();
            $studentId = $test->student->studentId;
            if($request->code!=$test->student->code){
                $student = Student::where('code',$request->code)->first();
                if($student==null){
                    return redirect()->back()->with('error','El código ingresado es inválido');
                }
                else{
                    if ($student->status=='Inactive'){
                        return redirect()->back()->with('error','El estudiante ya no forma parte de la institución');
                    }
                    $studentId = $student->studentId;
                } 
            }
            $testFinal = Test::find(decrypt($id));
            $testFinal->fill([
                'level' => $request->level,
                'score' => $request->score,
                'studentId' => $studentId
            ]);
            $testFinal->save();
            return redirect()->route('evaluaciones.show', ['evaluacione' => encrypt($studentId)])->with('success', 'Evaluación actualizada exitosamente');
        }
        catch(\Illuminate\Validation\ValidationException $e) {
            //DB::rollBack();
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $test = Test::find($id)->delete();

        return redirect()->route('tests.index')
            ->with('success', 'Test deleted successfully');
    }
}
