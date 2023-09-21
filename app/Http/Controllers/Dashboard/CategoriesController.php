<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Rules\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(Gate::denies('categories.view')){
            abort(403);
        }
        $categories=Category::
        /*leftJoin('categories as parent','parent.id','=','categories.parent_id')
        ->select([
            'categories.*',
            'parent.name as parent_name'
        ])*/
        with('parent')
        // ->select('categories.*')
        // ->selectRaw('(SELECT COUNT(*) FROM products WHERE category_id=categories.id) as products_count')
        ->withCount('products as products_count')
        ->filter($request->query())
        ->paginate(5);
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::denies('categories.create')){
            abort(403);
        }
        $parents=Category::all();
        return view('dashboard.categories.create',compact('parents'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Gate::authorize('categories.create');
        $request->merge([
            'slug'=> Str::slug($request->post('name'))
        ]);
        $data=$request->except('image');

        if($request->hasFile('image')){
            $file=$request->file('image');
            $path=$file->store('uploads',['disk'=>'public']);
            $data['image']=$path;
        }

        Category::create($data);
        return redirect()->route('dashboard.categories.index')
                ->with('success','Category Created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('categories.update');
        $category=Category::findorfail($id);
        //select * from categories where id <> $id
        //AND (parent_id IS NULL OR parent_id <> $id)
        $parents=Category::where('id','<>',$id)
        ->where(function($query) use ($id){
            $query->whereNull('parent_id')
                  ->orWhere('parent_id','<>',$id);
        })->get();

        return view('dashboard.categories.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        Gate::authorize('categories.update');
        $category=Category::find($id);
        $data=$request->except('image');
        $old_image=$category->image;

        if($request->hasFile('image')){
            $file=$request->file('image');
            $path=$file->store('uploads',['disk'=>'public']);
            $data['image']=$path;
        }

        $category->update($data);

        if($old_image && isset($date['image'])){
            Storage::disk('public')->delete($old_image);
        }
        return redirect()->route('dashboard.categories.index')
                ->with('success','Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('categories.delete');

        $category=Category::findOrFail($id);
        $category->delete();
        return Redirect::route('dashboard.categories.index')
            ->with('success','category deleted');
    }

    public function trash()
    {
        Gate::authorize('categories.delete');

        $categories=Category::onlyTrashed()->paginate(3);
        return view('dashboard.categories.trash',compact('categories'));
    }

    public function restore(Request $request,$id)
    {
        Gate::authorize('categories.delete');

        $category=Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('dashboard.categories.trash')
        ->with('success','Caregory Restored');
    }

    public function forceDelete($id)
    {
        Gate::authorize('categories.delete');

        $category=Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if($category->image){
            Storage::disk('public')->delete($category->image);
        }

        return redirect()->route('dashboard.categories.trash')
        ->with('success','Caregory Deleted');
    }

    public function show(Category $category)
    {
        Gate::authorize('categories.view');
        return view('dashboard.categories.show',[
            'category'=>$category
        ]);
    }
}
