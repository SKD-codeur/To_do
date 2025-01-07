<?php

namespace App\Http\Controllers\Taches;

use App\Models\Tache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TacheController extends Controller
{
        public function listTache(){

            $tache = Tache::with('user')->get();

            return response()->json([
                'message' => $tache,
            ]);
        }


        public function storeTache(Request $request)
        {
           $request->validate([
                'titre' => 'required|string|max:100',
                'description' => 'required|string|max:225',
                'date' => 'required|date|after_or_equal:today',
                'heures' => 'required|date_format:H:i:s',
            ]);

           // dd($data);
            Tache::create([
                'titre' => $request->titre,
                'description' => $request->description,
                'date' => $request->date,
                'heures' => $request->heures,
                'user_id' => Auth::user()->id,
            ]);

            return response()->json([
                'message' => 'Tâche enregistrée !'
            ],201);
        }

        public function editTache(Request $request, $id)
        {

            $data = $request->validate([
                'titre' => 'required|string|max:100',
                'description' => 'required|string|max:225',
                'date' => 'required|date|after_or_equal:today',
                'heures' => 'required|date_format:Y-m-d H:i:s',
            ]);


            $tache = Tache::find($id);

            dd($tache);

            $tache->update([
                'titre' => $data['titre'],
                'description' => $data['description'],
                'date' => $data['date'],
                'heures' => $data['heures'],
            ]);

            return response()->json([
                'message' => 'Tâche modifiée avec succès !',
                'tache' => $tache,
            ], 200);
        }


        public function deleteTache($id)
        {
            $tache = Tache::find($id);
            $tache->delete();
            return response()->json([
                'message' => 'Tâche supprimée !'
            ]);
        }


}
