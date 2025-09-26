<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
        return view('dashboard.specialist.create');
    }
    public function store(Request $request){
        $validate = $request->validate([
            'special_name'=>'required|string|max:255|unique:specialists',
        ]);
        if($validate){
            $data=[];
            $data['special_name'] = strtolower($validate['special_name']);
            $specialist = Specialist::create($data);
        }
//        return redirect()->route('specialist.index')->with('success','Specialist created successfully');
        return $specialist;
    }

    public function showUpdateForm($id){
        $special = Specialist::where('id',$id)->first();
        if($special){
            return view('dashboard.specialist.update',compact('special'));
        }
        return redirect()->route('specialists.index');
    }
    public function update(Request $request, $id){

        $special = Specialist::where('id',$id)->first();
        if($special){

            $validate = $request->validate([
                'special_name'=>'required|string|max:255|unique:specialists,special_name,'.$special->id,
            ]);

            if($validate){
                $data=[];
                $data['special_name'] = strtolower($validate['special_name']);
                $special->update($data);
                $special->save();
                return redirect()->route('specialists.index')->with('success','Specialist updated successfully');
            }
            return redirect()->route('specialists.index')->with('error','Specialist update failed');
        }
        return redirect()->route('specialists.index')->with('error','Specialist not found');
    }
    public function destroy($id){
        $special = Specialist::where('id',$id)->first();
        if($special) {
            $special->doctors()->detach();
            $special->delete();
            return redirect()->route('specialists.index')->with('success','Specialist deleted successfully');
        }else{
            return redirect()->route('specialists.index')->with('error','Specialist not found');
        }
    }
}
