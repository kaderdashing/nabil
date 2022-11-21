<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function __construct()
    {
      //  $this->middleware('isdoyen')->only(['create', 'store', 'edit','destroy' ]);

        
    }

        public function index()
        {
            $patients = Patients::all() ;
            return view('Patients.home')->with([
              
                'patients'=>$patients
            ]) ;
        }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
                 // Valider les inputs
       $kader= $request->validate([
            'choices' => 'required',
            'nom' => 'required',
            'AGE' => 'required',
            'TYPE' => 'required',
            'phone' => 'required',
            'serie' => 'required',
            'paye' => 'required',
            'reste' => 'required',
        ]);
       // dd($kader) ;

        $patients = new Patients([
            "choices" => $request->get('choices'),
            "name" => $request->get('nom'),
            "age" => $request->get('AGE'),
            "type" => $request->get('TYPE'),
            "num" => $request->get('nom'),
            "serie" => $request->get('serie'),
            "paye" => $request->get('paye'),
            "reste" => $request->get('reste'),
            
        ]);
       /* $kader=$request->get('serie') ;
       dd($kader);*/
        $patients->save(); // Finally, save the record.
    
        Session::flash('kader',"le patient a bien été créé - voulez vous créé un autre ?") ;
    return view('Patients.create');

}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patients::find($id);
         //   dd($patient) ;
            // show the edit form and pass the patient
            return view('Patients.edit')
                ->with('patient', $patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
