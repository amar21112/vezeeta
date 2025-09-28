<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Specialist;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(Request $request){
        $query = Specialist::withCount('doctors');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('special_name', 'LIKE', "%{$search}%");
        }

        $specialists = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.dashboard.specialists.index', compact('specialists'));
    }

    public function create(){
        return view('admin.dashboard.specialists.create');
    }
    public function store(Request $request){
        $request->validate([
            'special_name'=>'required|string|max:255|unique:specialists',
        ]);
        
        Specialist::create([
            'special_name' => ucwords($request->special_name)
        ]);
        
        return redirect()->route('admin.specialists.index')->with('success','Specialist created successfully');
    }

    public function showUpdateForm($id){
        $specialist = Specialist::findOrFail($id);
        return view('admin.dashboard.specialists.edit', compact('specialist'));
    }
    public function update(Request $request, $id){

        $specialist = Specialist::findOrFail($id);
        
        $request->validate([
            'special_name'=>'required|string|max:255|unique:specialists,special_name,'.$specialist->id,
        ]);
        
        $specialist->update([
            'special_name' => ucwords($request->special_name)
        ]);
        
        return redirect()->route('admin.specialists.index')->with('success','Specialist updated successfully');
    }
    public function destroy($id){
        $specialist = Specialist::findOrFail($id);
        
        // Check if specialist has doctors
        if($specialist->doctors()->count() > 0) {
            return redirect()->route('admin.specialists.index')
                ->with('error','Cannot delete specialist. It has associated doctors.');
        }
        
        $specialist->delete();
        return redirect()->route('admin.specialists.index')
            ->with('success','Specialist deleted successfully');
    }
}
