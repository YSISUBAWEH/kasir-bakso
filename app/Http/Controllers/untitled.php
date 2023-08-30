<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{
    public function index(){
        $data= Menu::all();
        return view('manager.index')->with([
            'data' => $data,
        ]);
    }
    public function show_menu(){
        $data = Menu::with('kate')->latest()->paginate(10);
        $kate = Kategori::all();
        //dd($product,$cate);
        return view('manager.menu.index')->with([
            'data' => $data,
            'kate' => $kate,
        ]);
    }
    public function create_menu(){
        $data = Menu::with('kate')->latest()->paginate(10);
        $kate = Kategori::all();
        //dd($product,$cate);
        return view('manager.menu.create')->with([
            'data' => $data,
            'kate' => $kate,
        ]);
    }
    public function p_c_menu(Request $store){
        // dd($store->all());
        //validation
        $this->validate($store, [
            'foto' => 'required|file|image|mimes:jpg,png,jpeg,webp|max:2048',
            'name' => 'required|min:4|max:20',
            'harga' => 'required|max:10',
            'kategori_menu'   => 'required',
        ]);
        $message=[
            'name.required'=>'Please fill in the fields correctly!',
            'harga.required'=>'Please fill in the fields correctly!',
            'foto.required'=>'Please fill in the fields correctly!',
            'kategori_menu.required'=>'Please fill in the fields correctly!',
        ];
        //saving data
         $file = $store->file('foto');
 
        $nama_file = time()."_".$file->getClientOriginalName();
 
                // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'images/menu_img';
        $file->move($tujuan_upload,$nama_file);
        $menu=Menu::create([
                'foto' => $nama_file,
                'nama' => $store->name,
                'harga'=>$store->harga,
                'kategori_menu_id'=>$store->kategori_menu,
        ]);
        if($menu){
        return redirect()->route('manager.menu')->with(['add' => 'Successfully added data']);}
        else{
            return back()->withInput()->withErrors([
            'hhh' => 'gagal menambah data',
        ])->with(['gagal' => 'Failure added data!!']);
            // return redirect()->route('productView')->with(['error' => 'Failure added data']);
        }
    }
}
