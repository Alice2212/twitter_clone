<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IdeaController extends Controller
{

    // show 1 idea
    public function show(Idea $idea){

        // without compact
        // return view("ideas.show", [
        //     'idea' => $idea
        // ]);

        // with compact since key and vale is same name
        return view("ideas.show", compact('idea'));
    }

    // edit 1 idea
    public function edit(Idea $idea){

        
        if(auth()->id() !== $idea->user_id){
            abort(404);
        }

        $editing = true;
        return view("ideas.show", compact('idea', 'editing'));
    }

    // update 1 idea
    public function update(Idea $idea){

        
        if(auth()->id() !== $idea->user_id){
            abort(404);
        }

       $validated = request()->validate([
            'content' => 'required|min:5|max:240'
        ]);

        // $idea->content = request()->get('content', ''); -> method one
        // $idea->content = $validated; ->method 2
        // $idea->Idea::create($validated); //method 3
        // $idea->save();

        $idea->update($validated);

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Ideas updated successfully !');
    }

    // store
    public function store(Request $request){

       $validated = request()->validate([
            'content' => 'required|min:5|max:240'
        ]);

        $validated['user_id'] = auth()->id();

    //    $idea = Idea::create(
    //     [
    //     'content' => request()->get('idea-message', ''),
    //      ]
    //     );


        // $idea->content = $request->content;
        // $idea->save();
        Idea::create($validated);


        return redirect()->route('dashboard')->with('success', 'Ideas created successfully !');
    }

    // delete
    public function destroy(Idea $idea){

        if(auth()->id() !== $idea->user_id){
            abort(404);
        }

        // delete normal way
        // $idea = Idea::where('id', $id)->firstOrFail()->delete();

        // delete with route model binding
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Ideas deleted successfully !');

    }
}
