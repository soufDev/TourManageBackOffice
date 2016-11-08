<?php

namespace App\Http\Controllers;
use App\Secteur;
use App\Wilaya;
use App\Commune;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SecteurController extends Controller
{
    //
    public function index()
    {
        $secteurs = Secteur::all();
        $communes=Commune::all();

        return view('pages.ListeSecteur', compact('secteurs','communes'));
    }

    public function ajouterSecteur()
    {
        $wilayas = Wilaya::all();
        $communes = Commune::orderBy('nomcommune', 'ASC')->get();

        return view('pages.AjouterSecteur', compact('wilayas', 'communes'));
    }


    public function supprimerSecteur($id)
    {
        Secteur::where('id', '=', $id)->delete();
        Commune::where('idSecteur', '=', $id)->update(array('idSecteur' => 0));

        return redirect('secteur');

    }

    public function insererSecteur(Request $request)
    {
        $validation =Validator::make($request->all(), ['nomSecteur' => 'required|min:4|max:11', 'wilaya' => 'required']);


        if($validation->fails())
        {
            return back()->withInput()->withErrors($validation);
        }

        $nomSecteur = $request->input('nomSecteur');
        $wilaya=  $request->input('wilaya');



        Secteur::create( array('nomsecteur' => $nomSecteur , 'idwilaya' => $wilaya));

        $newID=Secteur::where('nomSecteur', 'like', $nomSecteur)->where('idwilaya', '=', $wilaya)->get();



        for($i=1 ; $i <= Commune::count() ; $i++)
        {
            if($request->input('name'.$i)!=null)
            {
                $commune=Commune::where('id', '=', $i);
                $commune->update(array('idSecteur' => $newID->lists('id')[0]));
            }
        }

        return redirect('secteur');
    }

    public function ModifierSecteur($id)
    {
        $secteur = Secteur::find($id);
        $wilayas = Wilaya::all();
        $communes = Commune::orderBy('nomcommune', 'ASC')->get();

        return view('pages.ModifierSecteur', compact('secteur', 'wilayas', 'communes'));
    }

    public function SauvegarderModification($id,Request $request)
    {
        $validation =Validator::make($request->all(), ['nomSecteur' => 'required|min:4', 'wilaya' => 'required']);

        if($validation->fails())
        {
            return back()->withInput()->withErrors($validation);
        }

        $nomSecteur = $request->input('nomSecteur');
        $wilaya=  $request->input('wilaya');


        $secteur = Secteur::find($id);
        $secteur->update(array('nomsecteur' => $nomSecteur , 'idwilaya' => $wilaya));

        $communes = Commune::where('idSecteur', '=', $id);

        $communes->update(array('idSecteur' => 0));

        //mise à jour de la table ville
        for($i=1 ; $i <= Commune::count() ; $i++)
        {
            if($request->input('name'.$i)!=null)
            {
                $commune=Commune::where('id', '=', $i);
                $commune->update(array('idSecteur' => $id));
            }
        }

        //retourner la page index secteur
        return redirect('secteur');
    }

}
