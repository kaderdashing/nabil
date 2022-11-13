<?php

namespace App\Http\Controllers;

use App\Models\secretaires;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;


class SecretaireContoller extends Controller
{

    
    public function login() {

        return view('secretaire.login') ;

    }

    public function guard() 
    {
        return Auth::guard('secretaires') ;
    }

    public function authenticate(Request $request) {
        $request->validate([
            'email' => ['required' , 'email'] ,
            'password' => ['required']
        ]) ;

 
      /** @var secretaires $model */
   // renvoie a la page si l'eamil n'est pas valide 
   if((secretaires::query()->where('email', $request->get('email'))->first())== NULL)
   {
    return back()->withInput() ;
   }

   // taipinter le model ( faire la quiry pour faire $model= email si valide (tjr valide)
    $model = secretaires::query()->where('email', $request->get('email'))->first();
 

      //  return Redirect::back()->withErrors(['errors' => 'The Message']);
    
           //  return Redirect::to('secretaire.login');


//dd($model->password) ;
            if(!Hash::check($request->get('password'),$model->password)){
                
                return back()->withInput()->with('error','Login failed, please try again!') ;
            }

            if(Auth::guard('secretaires')->attempt($request->only('email','password'))){
                //Authentication passed...
               /* $kader=Auth::guard('secretaires') ;
                dd($kader) ; */
                return redirect()->route('fethi') ;
                 
               /* return redirect()->route('dashboard') 
                    ->with('status','You are Logged in as secretaire!'); */
            }
     //  dd(  Auth::login($model) ) ;
           dd(Auth::guard('secretaires')->login($model)  );
            
     

        } 
}
