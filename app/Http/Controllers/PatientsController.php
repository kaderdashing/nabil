<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function __construct()
    {
       $this->middleware('auth');

        
    }

    public function search() {
        //dd(1);
    }

        public function index()
        {
            $patients = Patients::orderBy('created_at', 'DESC')->get(); ;
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
            'AGE' => '',
            'TYPE' => 'required',
            'phone' => '',
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
            "num" => $request->get('phone'),
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
        $patient = Patients::findOrFail($id);
        
        return view('Patients.show')
        ->with('patient', $patient);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
      /*  dd(Gate::allows('destroye-edit')) ;
        si le user a le droit de edition le dd return true sinon false
      */
        $patient = Patients::findOrFail($id); 

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
       // dd($request) ;
     Patients::findOrFail($id);
       
        $validatedData = $request->validate([
            'choices' => 'required',
            'nom' => 'required',
            'AGE' => '',
            'TYPE' => 'required',
            'phone' => '',
            'paye' => 'required',
            'reste' => 'required',
            'description' =>''
            
        ]);

        $kader= [
            "choices" => $request->get('choices'),
            "name" => $request->get('nom'),
            "age" => $request->get('AGE'),
            "type" => $request->get('TYPE'),
            "num" => $request->get('phone'),
            "paye" => $request->get('paye'),
            "reste" => $request->get('reste'),
            "description" => $request->get('description'),
        ] ;
        
       $kade = Patients::whereId($id)->update($kader);

       Session::flash('editer',"le patient a bien été modifier - voulez vous autre chose ?") ;
       return Redirect::to('Patients') ;
       // return redirect()->route('Patients');
     //  return view('Patients.home');
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
