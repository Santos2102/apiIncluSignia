<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


/**
 * Class DiagnosticController
 * @package App\Http\Controllers
 */
class DiagnosticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $students = Student::with('person')->get();
            return view('diagnostic.index', compact('students'));
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
            $date = Carbon::now()->format('Y-m-d');
            return view('diagnostic.create',compact('date'));
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
                'diagnostic'=>'required|string',
                'date'=>'required'
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
            $diagnostic = new Diagnostic([
                'diagnostic' => $request->diagnostic,
                'date' => $request->date,
                'studentId' => $studentId
            ]);
            $diagnostic->save();
            return redirect()->route('practicas.index')
            ->with('success', 'Diagnóstico creado exitosamente.');
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
            $diagnostics = Diagnostic::where('studentId',decrypt($id))->get();
            return view('diagnostic.show', compact('diagnostics'));
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
            $diagnostic = Diagnostic::find(decrypt($id));
            $student = Student::find($diagnostic->studentId);
            return view('diagnostic.edit', compact('diagnostic','student'));
        }
        catch(\Exception $e){
            return redirect()->back()->with('error','Se produjo un error al procesar la solicitud');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Diagnostic $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'code'=>'required|string|min:10|max:10',
                'diagnostic'=>'required|string',
                'date'=>'required'
            ]);
            $diagnostic = Diagnostic::where('diagnosticsId',decrypt($id))->with('student')->first();
            $studentId = $diagnostic->student->studentId;
            if($request->code!=$diagnostic->student->code){
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
            $diagnosticFinal = Diagnostic::find(decrypt($id));
            $diagnosticFinal->fill([
                'diagnostic' => $request->diagnostic,
                'date' => $request->date,
                'studentId' => $studentId
            ]);
            $diagnosticFinal->save();
            return redirect()->route('practicas.index')
            ->with('success', 'Diagnóstico actualizado exitosamente');
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
        $diagnostic = Diagnostic::find($id)->delete();

        return redirect()->route('diagnostics.index')
            ->with('success', 'Diagnostic deleted successfully');
    }
}
