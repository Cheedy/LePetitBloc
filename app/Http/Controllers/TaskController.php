<?php

namespace App\Http\Controllers;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('search') !== null)
        {
            $userId = Auth::id();
            $tasks['data'] = Task::where('name', 'like', '%' . request('search') . '%')->where('user_id', '=', $userId)->get();
            return response()->json($tasks);
    
        }
        else
        {
            return $this->refresh();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // fonction Store, qui va prendre la requête du modal "ajout" et l'ajouter dans la table tasks
        $task = Task::create($request->all());


        if($task)
        {
            return $this->refresh();
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

        // fonction edit qui va aller récuperer l'id de la tâche pour pouvoir l'éditer

        $task = Task::find($id);

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        // fonction update, qui va aller récupérer la requête "name" (donc la tache) et la mettre à jour

        $task = Task::find($id);
        $task->name = request('name');
        $task->save();

        if($task)
        {
            return $this->refresh();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        
        // fonction destroy, qui va supprimer la tâche

        if($task->delete())
        {
            
            return $this->refresh();
        }
        else
        {
            return response()->json(['error', 'Erreur lors de la suppression'], 425);
        }

    }

    private function refresh()
    {

        // fonction refresh, qui va mettre à jour la liste des tâches

        $userId = Auth::id();
        $tasks = Task::where('user_id', '=', $userId)->Orderby('created_at', 'DESC')->paginate(5);

        //SELECT * FROM `tasks` WHERE `user_id` = 1 ORDER BY `created_at`

        return response()->json($tasks);
    }

    public function GetUserId()
    {
        // fonction GetUserId, qui va nous permettre de récupérer l'id de l'utilisateur connecté

        $UserId = Auth::id();

        return response()->json($UserId);
    }

}
