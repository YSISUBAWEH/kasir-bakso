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
    //menu
    public function show_menu(){
        $data = Menu::latest()->get();
        $kate = Kategori::all();
        //dd($product,$cate);
        return view('manager.menu.index')->with([
            'data' => $data,
            'kate' => $kate,
        ]);
    }
    public function create_menu(){
        $data = Menu::with('kate')->get();
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
    public function edit_menu($id){
        $data = Menu::find($id)->load('kate');
        $kate = Kategori::all();
        //dd($product,$cate);
        return view('manager.menu.edit')->with([
            'data' => $data,
            'kate' => $kate,
        ]);
    }
    public function p_e_menu(Request $update,$id)
    {
        $this->validate($update, [
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
         $file = $update->file('foto');
 
        $nama_file = time()."_".$file->getClientOriginalName();
 
                // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'images/menu_img';
        $file->move($tujuan_upload,$nama_file);
        $motor1 = Menu::find($id);
        $motor1->update([
                'foto' => $nama_file,
                'nama' => $update->name,
                'harga'=>$update->harga,
                'kategori_menu_id'=>$update->kategori_menu,
        ]);
        if($motor1){
        return redirect()->route('manager.menu')->with(['update' => 'Successfully updated data']);}
        else{
            return back()->withInput()->withErrors([
            'error' => 'gagal menambah data',
        ])->with(['gagal' => 'Failure updated data!!']);
            // return redirect()->route('productView')->with(['error' => 'Failure added data']);
        }
    }
    public function D_menu($id)
    {
        $delete = Menu::find($id);
        // Storage::delete('public/post/'.$post->image);
        $delete->delete();
        return redirect()->route('manager.menu');
    }

        //kategori
    public function show_kategori_menu(){
        $data = Kategori::latest()->get();
        //dd($product,$cate);
        return view('manager.kategori_menu.index')->with([
            'data' => $data,
        ]);
    }
    public function create_kategori_menu(){
        $data = Kategori::latest()->get();
        //dd($product,$cate);
        return view('manager.kategori_menu.create')->with([
            'data' => $data,
        ]);
    }
    public function p_c_kategori_menu(Request $store){
        // dd($store->all());
        //validation
        $this->validate($store, [
            'name' => 'required|min:4|max:20',
        ]);
        $message=[
            'name.required'=>'Please fill in the fields correctly!',
        ];
        $menu=Kategori::create([
                'nama' => $store->name,
        ]);
        if($menu){
        return redirect()->route('manager.kategori_menu')->with(['add' => 'Successfully added data']);}
        else{
            return back()->withInput()->withErrors([
            'hhh' => 'gagal menambah data',
        ])->with(['gagal' => 'Failure added data!!']);
            // return redirect()->route('productView')->with(['error' => 'Failure added data']);
        }
    }
    public function edit_kategori_menu($id){
        $data = Kategori::find($id);
        //dd($product,$cate);
        return view('manager.kategori_menu.edit')->with([
            'data' => $data,
        ]);
    }
    public function p_e_kategori_menu(Request $update,$id)
    {
        $this->validate($update, [
            'name' => 'required|min:4|max:20',
        ]);
        $message=[
            'name.required'=>'Please fill in the fields correctly!',
        ];
        
        $motor1 = Kategori::find($id);
        $motor1->update([
                'nama' => $update->name,
        ]);
        if($motor1){
        return redirect()->route('manager.kategori_menu')->with(['update' => 'Successfully updated data']);}
        else{
            return back()->withInput()->withErrors([
            'error' => 'gagal menambah data',
        ])->with(['gagal' => 'Failure updated data!!']);
            // return redirect()->route('productView')->with(['error' => 'Failure added data']);
        }
    }
    public function D_kategori_menu($id)
    {
        $delete = Kategori::find($id);
        // Storage::delete('public/post/'.$post->image);
        $delete->delete();
        return redirect()->route('manager.menu');
    }
}
