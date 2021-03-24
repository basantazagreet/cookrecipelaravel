<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipesController extends Controller
{
    //

    public function create(Request $request){

        $recipe = new Recipe;
        $recipe->user_id = Auth::user()->id;
        //Recipe description ho
        $recipe->title = $request->title;
        $recipe->desc = $request->desc;
        $recipe->ingredients = $request->ingredients;
        $recipe->steps = $request->steps;
        $recipe->readyin = $request->readyin;
        $recipe->origin = $request->origin;
        $recipe->category = $request->category;



        //check if post has photo
        if($request->photo != ''){
            //choose a unique name for photo
            $photo = time().'.jpg';
            file_put_contents('storage/recipes/'.$photo,base64_decode($request->photo));
            $recipe->photo = $photo;
        }
        
        $recipe->save();
        $recipe->user;
        return response()->json([
            'success' => true,
            'message' => 'recipe posted',
            'recipe' => $recipe
        ]);
    }

    public function update(Request $request){
        $recipe = Recipe::find($request->id);
        // check if user is editing his own post
        // we need to check user id with post user id
        if(Auth::user()->id != $recipe->user_id){
            return response()->json([
                'success' => false,
                'message' => 'unauthorized access'
            ]);
        }
        $recipe->title = $request->title;
        $recipe->desc = $request->desc;
        $recipe->ingredients = $request->ingredients;
        $recipe->steps = $request->steps;
        $recipe->readyin = $request->readyin;
        $recipe->origin= $request->origin;
        $recipe->category = $request->category;


        $recipe->update();
        return response()->json([
            'success' => true,
            'message' => 'recipe edited'
        ]);
    }


    
    public function delete(Request $request){
        $recipe = Recipe::find($request->id);
        // check if user is editing his own post
        if(Auth::user()->id !=$recipe->user_id){
            return response()->json([
                'success' => false,
                'message' => 'unauthorized access'
            ]);
        }
        
        //check if post has photo to delete
        if($post->photo != ''){
            Storage::delete('public/recipes/'.$recipe->photo);
        }
        $recipe->delete();
        return response()->json([
            'success' => true,
            'message' => 'recipe deleted'
        ]);
    }

    public function recipes(){
        $recipes = Recipe::orderBy('id','desc')->get();
        foreach($recipes as $recipe){
            //get user of post
            $recipe->user;
            //comments count
            $recipe['commentsCount'] = count($recipe->comments);
            //likes count
            $recipe['likesCount'] = count($recipe->likes);
            //check if users liked his own post
            $recipe['selfLike'] = false;
            foreach($recipe->likes as $like){
                if($like->user_id == Auth::user()->id){
                    $recipe['selfLike'] = true;
                }
            }

        }

        return response()->json([
            'success' => true,
            'recipes' => $recipes
        ]);



    }

    public function addRecipe(Request $request){

        $recipe = new Recipe;
        $recipe->user_id = $request->uid;
        //Recipe description ho
        
        $recipe->title = $request->title;
        $recipe->desc = $request->desc;
        $recipe->ingredients = $request->ingredients;
        $recipe->steps = $request->steps;
        $recipe->readyin = $request->readyin;
        $recipe->origin = $request->origin;
        $recipe->category = $request->category;



        //check if post has photo
        if($request->photo != ''){
            //choose a unique name for photo
            $photo = time().'.jpg';
            file_put_contents('storage/recipes/'.$photo,base64_decode($request->photo));
            $recipe->photo = $photo;
        }
        
        $recipe->save();
        $recipe->user;
        return response()->json([
            'success' => true,
            'message' => 'recipe posted',
            'recipe' => $recipe
        ]);
    }




}
