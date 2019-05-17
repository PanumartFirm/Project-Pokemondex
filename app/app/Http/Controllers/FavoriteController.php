<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use Redirect;
use Auth;
use DB;
use App\Pokemon;
use App\Species;
use App\Type;
use App\SubType;
use App\Abilities;
use App\Hidden;
use Image;
use File;

class FavoriteController extends Controller

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

    public function index()
    {
        return view('user.favorite');
    }

    public function bodyindex()
    {
        $user = Auth::user()->id;
        $fav = Favorite::where('user_id',$user)->paginate(8);
        $view = view('ajax.ajaxfavorite',compact('fav'), array('user' => Auth::user()))->render();
        return response()->json(['html'=>$view]);
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


        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $check = DB::table('Favorites')->select('id')->where('poke_no',$id)->first();
            if (!is_null($check)){
                $fav = Favorite::where('poke_no',$id);
                $fav->delete();
            }
            $poke = Pokemon::find($id);
            File::delete(public_path('/uploads/pokemons/'. $poke->poke_pic ));
            $poke->delete();
            return redirect('favorite');
        }else{
            return Redirect::route('login');
        }
    }

    public function delete(Request $request)
    {
        if (Auth::check()) {
            $id = $request->id;
            $user = Auth::user();
            $check = DB::table('Favorites')->select('id')->where('poke_no',$id)->first();
            if (!is_null($check)){
                $fav = Favorite::where('poke_no',$id);
                $fav->delete();
            }
            $poke = Pokemon::find($id);
            File::delete(public_path('/uploads/pokemons/'. $poke->poke_pic ));
            $poke->delete();
            return $this->bodyindex();
        }else{
            return Redirect::route('login');
        }
    }
}
