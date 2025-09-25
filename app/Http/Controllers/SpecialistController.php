<?php

namespace App\Http\Controllers;

use App\Models\Specialist;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function index(){
        $specialists = Specialist::all();
//        return view('specialists.index', compact('specialists'));
        return $specialists;
    }

    public function create(){
        return view('specialist.create');
    }
    public function store(Request $request){
        $validate = $request->validate([
            'special_name'=>'required|string|max:255|unique:specialists',
        ]);
        if($validate){
            $specialist = Specialist::create($validate);
        }
//        return redirect()->route('specialist.index')->with('success','Specialist created successfully');
        return $specialist;
    }

    public function update(Request $request, $id){

        $special = Specialist::where('id',$id)->first();
        if($special){

            $validate = $request->validate([
                'special_name'=>'required|string|max:255|unique:specialists,special_name,'.$special->id,
            ]);

            if($validate){
                $special->update($validate);
                $special->save();
                return redirect()->route('specialist.index')->with('success','Specialist updated successfully');
            }
            return redirect()->route('specialist.index')->with('error','Specialist update failed');
        }
        return redirect()->route('specialist.index')->with('error','Specialist not found');
    }
    public function destroy($id){
        $special = Specialist::where('id',$id)->first();
        if($special) {
            $special->delete();
            return redirect()->route('specialist.index')->with('success','Specialist deleted successfully');
        }else{
            return redirect()->route('specialist.index')->with('error','Specialist not found');
        }
    }
}
