<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Pokemon;
use App\Favorite;
use App\Species;
use App\Type;
use App\SubType;
use App\Abilities;
use App\Hidden;
use Image;
use DB;
use Auth;
use File;
class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        return view('index',array('user' => Auth::user()));
    }

    public function bodyindex()
    {
        $poke = Pokemon::paginate(8);
        $view = view('ajax.ajaxindex',compact('poke'), array('user' => Auth::user()))->render();
        return response()->json(['html'=>$view]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $spe = Species::all();
            $type = Type::all();
            $stype = SubType::all();
            $abi = Abilities::all();
            $hid = Hidden::all();
            return view('pokemon.add',compact('spe','type','stype','abi','hid'));
        }else{
            return Redirect::route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $rules = [
                'poke_name' => 'required|max:60',
                'poke_content' => 'required|max:300',
                'poke_pic' => 'required|file|image|max:1024',
                'spe_id' => 'required',
                'type_id' => 'required',
                'abi_id' => 'required',
                'hid_id' => 'required',
                'gender' => 'required',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
            ];
            $this->validate($request,$rules);
            DB::beginTransaction();
            $val = new Pokemon;
            $val->poke_name = $request->poke_name;
            $val->poke_content = $request->poke_content;
            if($request->hasFile('poke_pic')){
                $avatar = $request->file('poke_pic');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/pokemons/' . $filename ) );
                $val->poke_pic = $filename;
            }
            $val->spe_id = $request->spe_id;
            $val->type_id = $request->type_id;
            $val->stype_id = $request->stype_id;
            $val->abi_id= $request->abi_id;
            $val->hid_id = $request->hid_id;
            $val->gender = $request->gender;
            $val->height = $request->height;
            $val->weight = $request->weight;
            $savetran =  $val->save();
            if ($savetran){
                DB::commit();
                return back()->with("success", "Save successfully");
            }else {
                DB::rollback();
                return back()->with("error", "Incorrect information");
            }
        }else{
            return Redirect::route('login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)  //แสดงข้อมูล
    {
        $value = Pokemon::find($id);
        return view('pokemon.detail',compact('value'), array('user' => Auth::user()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)  //หน้าแก้ข้อมูล
    {
        if (Auth::check()) {
            $spe = Species::all();
            $type = Type::all();
            $stype = SubType::all();
            $abi = Abilities::all();
            $hid = Hidden::all();
            $value = Pokemon::find($id);
            return view('pokemon.edit',compact('value','spe','type','stype','abi','hid'));
        }else{
            return Redirect::route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)  //อัพเดทข้อมูล
    {
        if (Auth::check()) {
            $rules = [
                'poke_name' => 'required|max:60',
                'poke_content' => 'required|max:300',
                'poke_pic' => 'image|max:1024',
                'spe_id' => 'required',
                'type_id' => 'required',
                'abi_id' => 'required',
                'hid_id' => 'required',
                'gender' => 'required',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
            ];
            $this->validate($request,$rules);
            DB::beginTransaction();
            $val = Pokemon::find($id);
            $val->poke_name = $request->poke_name;
            $val->poke_content = $request->poke_content;
            if($request->hasFile('poke_pic')){
                $avatar = $request->file('poke_pic');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/pokemons/' . $filename ) );
                File::delete(public_path('/uploads/pokemons/'. $val->poke_pic ));
                $val->poke_pic = $filename;
            }
            $val->spe_id = $request->spe_id;
            $val->type_id = $request->type_id;
            $val->stype_id = $request->stype_id;
            $val->abi_id= $request->abi_id;
            $val->hid_id = $request->hid_id;
            $val->gender = $request->gender;
            $val->height = $request->height;
            $val->weight = $request->weight;
            $savetran = $val->push();
            if ($savetran){
                DB::commit();
                return back()->with("success", "Save successfully");
            }else {
                DB::rollback();
                return back()->with("error", "Incorrect information");
            }
        }else{
            return Redirect::route('login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //ลบข้อมูล
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
            return redirect('pokemon');
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
