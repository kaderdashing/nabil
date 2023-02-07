<?php

namespace App\Http\Controllers;

use App\Models\Biopsie;
use App\Models\Cyto;
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
        $user = Auth::user()->admin;
        return response()->json([
            'patients'=>$patients ,
            'user'=>$user
        ]) ;
     }

        public function index()
        {
            $patients = Patients::orderBy('created_at', 'DESC')->paginate(30);
            return view('Patients.home')->with([
              
                'patients'=>$patients
            ]) ;
        }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // recuperer l'URL de post si c'est cyto ou biopsie
        $url = url()->previous() ;
        $path= parse_url($url, PHP_URL_PATH);
        $route_post = pathinfo($path,PATHINFO_BASENAME);
        $H = $route_post == "cyto" ? "Y" : "X";
      //  dd($H) ;
       $kader= $request->validate([
            'nom' => 'required',
            'AGE' => '',
            'TYPE' => 'required',
            'phone' => '',
            'prescripteur' => '',
            
            'serie' => 'required',
            'paye' => 'required',
            'reste' => 'required',
        ]);
        //dd($kader) ;
       // dd(1);
       /////////////////////remplacer le "+" par le choix  "X" "Y"////////////////
    /*   $tyupe=$request->get('choices');
        $nouv=$request->get('serie');
       $plus=substr($nouv, 3, 1);
       $kader=str_replace($plus,$tyupe,$nouv) ; */
        //////////////////////////////////////////////////////////////////////////
        
        $patients = new Patients([
            "choices" => $H,
            "name" => $request->get('nom'),
            "age" => $request->get('AGE'),
            "type" => $request->get('TYPE'),
            "num" => $request->get('phone'),
            "prescripteur" => $request->get('prescripteur'),
            "serie" => $request->get('serie'),
            "paye" => $request->get('paye'),
            "reste" => $request->get('reste'),
            
        ]);
        $patients->save(); // Finally, save the record.
        

        if($H === "X"){
          //  dd("biopsie") ;
            $biopsie = new Biopsie([
                "choices" => $H,
                "name" => $request->get('nom'),
                "age" => $request->get('AGE'),
                "type" => $request->get('TYPE'),
                "num" => $request->get('phone'),
                "prescripteur" => $request->get('prescripteur'),
                "serie" => $request->get('serie'),
                "paye" => $request->get('paye'),
                "reste" => $request->get('reste'),
                
            ]);
            
            $biopsie->save(); 
            Session::flash('kader',"le patient a bien été créé - voulez vous créé un autre ?") ;
            return redirect('/Patients/biopsie');
        } else {
            $cyto = new Cyto([
                "choices" => $H,
                "name" => $request->get('nom'),
                "age" => $request->get('AGE'),
                "type" => $request->get('TYPE'),
                "num" => $request->get('phone'),
                "prescripteur" => $request->get('prescripteur'),
                "serie" => $request->get('serie'),
                "paye" => $request->get('paye'),
                "reste" => $request->get('reste'),
                
            ]);
            $cyto->save(); 
            Session::flash('kader',"le patient a bien été créé - voulez vous créé un autre ?") ;
            return redirect('/Patients/cyto');
        }
        

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
            
            'nom' => 'required',
            'AGE' => '',
            'TYPE' => 'required',
            'phone' => '',
            'prescripteur' => '',
            'paye' => 'required',
            'reste' => 'required',
            'description' =>''
            
        ]);

        $kader= [
            
            "name" => $request->get('nom'),
            "age" => $request->get('AGE'),
            "type" => $request->get('TYPE'),
            "num" => $request->get('phone'),
            "prescripteur" => $request->get('prescripteur'),

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

    public function biopsie() {
        $patient = Biopsie::latest()->first()->serie;
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
        
        $X="X" ;
       
        $R=$rest.$ABCD.$X.$suivant ;
       

        return view('Patients.biopsie')->with([
            'R'=>$R ,

        ]) ;

    }

    public function cyto() {
        $patient = Cyto::latest()->first()->serie;
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
        
        $X="Y" ;
       
        $R=$rest.$ABCD.$X.$suivant ;
       

        return view('Patients.cyto')->with([
            'R'=>$R ,

        ]) ;
    }

    public function print($id) {
  
        //$kader = $request->query() ;   // recuperer la query
        // $id= key($kader) ;
       // array_keys($kader) ; recuperer tt les clé du tebleau

       $patient = Patients::findOrFail($id);
       //dd($patient) ;

       $kader= [
        "fini" => 1,
    ] ;
    
         Patients::whereId($id)->update($kader);
         $date = date("d/m/Y");
        // dd($date) ;
         return view('Patients.print')->with(
            ['patient'=> $patient ,
            'date'=> $date]
        
        );
       // ['var1' => $var1, 'var2' => $var2]
    }


}
