<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Models\Disability;
use App\Models\CodeControl;
use Illuminate\Support\Facades\DB;

/**
 * Class StudentController
 * @package App\Http\Controllers
 */
class StudentController extends Controller
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
            $students = student::where('status','Active')->with(['person','disability'])->get();
            return view('student.index', compact('students'));
        }
        catch(\Exception $e)
        {
            return back() -> with('error', 'Se produjo un error al procesar la solicitud');
        }
    }

    public function getStudents(){
        try 
        {
            $students = student::where('status','Active')->with(['person','disability'])->get();
            return response()->json($students);
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
            $disability = Disability::all();
            return view('student.create', compact('disability'));
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
            $request->validate([
                'cui'=> 'required|unique:persons|string|min:15|max:15'
            ]);
            $person = new Person([
                'name' => $request->name,
                'lastName' => $request->lastname,
                'birthDate' => $request->birthDate,
                'age' => $request->age,
                'cui' => $request->cui,
            ]);
            $person->save();

            $disabilityId = decrypt($request -> disability);

            $student = new Student([
                'personId' => $person->personId,
                'disabilityId' => $disabilityId,
                'grade' => $request -> grade,
                'code' => $this -> setCode($disabilityId)
            ]);
            $student->save();

            DB::commit();
            $this -> deleteCode($disabilityId);
            return redirect()->route('estudiantes.index')
                ->with('success', 'Estudiante creado éxitosamente.');
        }
        catch(\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }

    private function setCode($disabilityId){
        if( $disabilityId == 1){
            $code = CodeControl::where('disabilityId',$disabilityId)->min('code');
            if($code == null){
                $studentsAudio = Student::where('disabilityId',1) -> max('code');
                if($studentsAudio != null){
                    $lastCode = $studentsAudio;
                    $code =  'A'.$this -> generateCode($lastCode);
                }else{
                    $code = 'A1';
                }
            }
        }else{
            $code = CodeControl::where('disabilityId',$disabilityId)->min('code');
            if($code == null){
                $studentsVisual = Student::where('disabilityId',2) -> max('code');
                if($studentsVisual != null){
                    $lastCode = $studentsVisual;
                    $code =  'V'.$this -> generateCode($lastCode);

                }else{
                    $code = 'V1';
                }
            }
        }
        return $code;
    }

    private function generateCode($lastCode){
        $lastNumber = substr($lastCode,1,strlen($lastCode));
        $codeNumber = $lastNumber+1;
        return $codeNumber;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);

        return view('student.show', compact('student'));
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
            $student = Student::find(decrypt($id));
            $disability = Disability::all();
            return view('student.edit', compact('student','disability'));
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
     * @param  Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try
        {
            $student = Student::where('studentId',decrypt($id))->with(['person', 'disability'])->first();
            $disabilityId = decrypt($request -> disability);
            $code = $student -> code;
            if($student -> disabilityId != $disabilityId){
                $deletedCode = new CodeControl(['code' => $code, 'disabilityId' => $student -> disabilityId]);
                $deletedCode -> save();
                $code =  $this -> setCode($disabilityId);
                $this -> deleteCode($disabilityId);
            }

            $student -> fill([
                'code' =>  $code,
                'grade' => $request -> grade,
                'disabilityId' => $disabilityId
            ]);

            $person = Person::find($student -> person -> personId);
            $person -> fill([
            'name' => $request -> name,
            'lastName' => $request -> lastname,
            'cui' => $request -> cui,
            'birthDate' => $request -> birthDate,
            'age' => $request -> age
            ]);
            $person -> save();
            $student -> save();
            DB::commit();
            
            return redirect()->route('estudiantes.index')
                ->with('success', 'Estudiante actualizado correctamente');
        }
        catch(\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }

    private function deleteCode($disabilityId){
        $deleteCodeId = CodeControl::where('code', $this -> setCode($disabilityId))->first();
            if($deleteCodeId != null){
                $deleteCode = CodeControl::find($deleteCodeId -> controlId);
                $deleteCode -> delete();
            }
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
            $student = Student::find(decrypt($id))->update(['status'=>'Inactive']);

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante eliminado éxitosamente');
        }
        catch(\Exception $e)
        {
            return back() -> with('error', 'Se produjo un error al procesar la solicitud');
        }
    }

    public function getStudentCodeMobile(Request $request){
        $student = Student::where('code',$request->code)->first();
        if($student!=null){
            return response()->json(['message'=>'Correct'],201);
        }
        else{
            return response()->json(['message'=>'Incorrect'],201);
        }
    }
}
