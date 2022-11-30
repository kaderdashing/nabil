<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patients;
use Illuminate\Http\JsonResponse;
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

    public function search(Request $request ) :JsonResponse
     {
        $q = $request->input('q') ;
        $patients = Patients::where('name' , 'like' , '%' . $q . '%')
        ->orWhere('serie' , 'like' , '%' . $q . '%')
        ->get() ;
        return response()->json([
            'patients'=>$patients
        ]) ;
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
        $patient = Patients::latest()->first()->serie;
        $anne_courante=date("Y");
        $rest = substr($anne_courante, -2);    // "22"
        $ABCD=substr($patient, 2, 1);       // A B C D
        //dd($ABCD) ;

        $serie_num= substr($patient, -3) + 1 ;    //942
        $suivant=strval($serie_num) ;
       // dd($serie_num) ;
        // faire le if strlen(suivant<3) .........
        //$suivant="00".$suivant ;  //concatenation en 3 => 003
        
        if(strlen($suivant)<3){
            if(strlen($suivant)==2){
                dd(78);
                $suivant="0".$suivant ;
            }
            elseif(strlen($suivant)==1){
                
                $suivant="00".$suivant ;
                
            }
        }

       

      
       //dd($ABCD) ;
       //changer de "A" a "B" grace au code ascii
        if($suivant==="1000")
        {
           $ABCD=ord($ABCD);
            $ABCD+=1 ;
            $suivant="001" ;
            $ABCD=chr($ABCD) ;
           // dd($ABCD) ;
        }
        
        
       

       
  

        return view('Patients.create')->with([
            'rest'=>$rest ,
            'ABCD'=>$ABCD ,
            'suivant' =>$suivant
        ]) ;
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
       
       /////////////////////remplacer le "+" par le choix  "X" "Y"////////////////
       $tyupe=$request->get('choices');
        $nouv=$request->get('serie');
       $plus=substr($nouv, 3, 1);
       $kader=str_replace($plus,$tyupe,$nouv) ;
        //////////////////////////////////////////////////////////////////////////
        $patients = new Patients([
            "choices" => $request->get('choices'),
            "name" => $request->get('nom'),
            "age" => $request->get('AGE'),
            "type" => $request->get('TYPE'),
            "num" => $request->get('phone'),
            "serie" => $kader,
            "paye" => $request->get('paye'),
            "reste" => $request->get('reste'),
            
        ]);

        $patients->save(); // Finally, save the record.
    
        Session::flash('kader',"le patient a bien été créé - voulez vous créé un autre ?") ;
       return redirect('/Patients/create');
        //return view('Patients.create');

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
