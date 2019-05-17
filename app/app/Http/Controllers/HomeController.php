<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pokemon;
use App\Favorite;
use Redirect;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {

    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function autocomplete(Request $request)
    {
        $search = $request->get('term');
        $data = Pokemon::select('poke_name')->where('poke_name', 'LIKE', '%'. $search. '%')->get();
        return response()->json($data);
    }

    public function search(Request $request)
    {
        if($request->ajax()){
            $input = $request->search;
            if ($input != ''){
                $poke = Pokemon::where('poke_name','LIKE','%'.$input.'%')->paginate(8);
            }else {
                $poke = Pokemon::paginate(8);
            }
            if ($poke->count() > 0){
                $view = view('ajax.ajaxindex',compact('poke'), array('user' => Auth::user()))->render();
                return response()->json(['html'=>$view]);
            }
        }
    }

    public function like(Request $request)
    {
        if (Auth::check()) {
            $id = $request->id;
            $user = Auth::user();
            $check = DB::table('Favorites')->select('id')->where('user_id',$user->id)->where('poke_no',$id)->first();
            if (!is_null($check)){
                $fav = Favorite::find($check->id);
                $fav->delete();
            }else{
                DB::beginTransaction();
                $fav = new Favorite;
                $fav->user_id = $user->id;
                $fav->poke_no = $id;
                $savetran =  $fav->save();
                if ($savetran){
                    DB::commit();
                }else {
                    DB::rollback();
                }
            }
            $fav = Favorite::where('user_id',$user)->paginate(6);
            $view = view('ajax.ajaxfavorite',compact('fav'), array('user' => Auth::user()))->render();
            return response()->json(['html'=>$view]);
        }else{
            return Redirect::route('login');
        }
    }
    public static function myCustomFav($id){
        $user = Auth::user();
        $check = DB::table('Favorites')->select('id')->where('user_id',$user->id)->where('poke_no',$id)->first();
        if (!is_null($check)){
            return true;
        }else{
            return false;
        }
    }
}
