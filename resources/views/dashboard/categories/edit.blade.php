@extends('layouts.dashboard')

@section('title','Edit Category')

@section('content')

<form action="{{ route('dashboard.categories.update',$category->id) }}" method="POST" style="padding-left:110px" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <x-form.input label="Category Name" name="name" value="{{ $category->name }}" type="text"/>
    </div>
    
    <div class="form-group">
        <label for="">Category Parent</label>
        <select name="parent_id" class="form-control @error('parent_id')
                        is-invalid @enderror" style="width: 450px">
            <option value="">primary category</option>
            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}" @selected(old('parent_id',$category->parent_id) == $parent->id)>{{ $parent->name }}</option>
            @endforeach
        </select>
        @error('parent_id')
            <div class="text-danger" style="width: 450px">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <x-form.textarea label="Description" value="{{ $category->description }}" name="description" />
    </div>

    <div class="form-group">
        <x-form.radio label="Status" name="status" :checked="$category->status" :options="['active'=>'Active','archived'=>'Archived']"/>
        
    </div>

    <div class="form-group">
        <x-form.input label="Image" type="file" name="image"/>
        @if($category->image)
            <img src="{{ asset('storage/'.$category->image) }}" height="70px">
        @endif
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form> 

@endsection