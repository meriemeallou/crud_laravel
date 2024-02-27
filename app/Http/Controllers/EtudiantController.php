<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;

class EtudiantController extends Controller
{
    public function liste_etudiant(){
        $etudiants = Etudiant::all();
        return view('etudiant.liste',compact('etudiants'));
    }
    public function ajouter_etudiant(){
        return view('etudiant.ajouter');
    }
    public function ajouter_etudiant_traitement(Request $request){
        $request->validate([
            'nom' =>'required',
            'prenom' =>'required',
            'classe' =>'required',

        ]);

        $etudiant = new Etudiant();
        $etudiant->nom =$request->nom;
        $etudiant->prenom =$request->prenom;
        $etudiant->classe =$request->classe;
        $etudiant->save();
        
        return redirect('/ajouter')->with('status', 'Etudiant a bien ete ajoute avec succes');
    }
    public function update_etudiant($id){
        $etudiants = Etudiant::findOrFail($id);
        return view('etudiant.update', compact('etudiants'));
    }
    public function update_etudiant_traitement(Request $request, $id){
        $request->validate([
            'nom' =>'required',
            'prenom' =>'required',
            'classe' =>'required',

        ]);

        $etudiant =Etudiant::findOrFail($request->id);
        $etudiant->nom =$request->nom;
        $etudiant->prenom =$request->prenom;
        $etudiant->classe =$request->classe;
        $etudiant->update();

        return redirect('/etudiant')->with('status', 'Etudiant a bien ete modifie avec succes');
    }
}
