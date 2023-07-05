@extends('layouts.dashboard')

@section('title','Create Category')

@section('content')

<form action="{{ route('dashboard.categories.store') }}" method="POST" style="padding-left:110px">
    @csrf
    <div class="form-group">
        <x-form.input label="Category Name" name="name" value="" type="text"/>   
    </div>

    <div class="form-group">
        <label for="">Category Parent</label>
        <select name="parent_id"  class="form-control" style="width: 450px">
            <option value="">primary category</option>
            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
            @endforeach
        </select>
        @error('parent_id')
             <div class="text-danger" style="width: 450px">{{ $message }}</div>
        @enderror   
    </div>

    <div class="form-group">
        <x-form.textarea label="Description" name="description" />
    </div>

    <div class="form-group">
        <x-form.radio label="Status" name="status" :options="['active'=>'Active','archived'=>'Archived']"/>
    </div>

    <div class="form-group">
        <x-form.input label="Image" type="file" name="image"/>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form> 

@endsection