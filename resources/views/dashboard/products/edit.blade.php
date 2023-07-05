@extends('layouts.dashboard')

@section('title','Edit Product')

@section('content')

<form action="{{ route('dashboard.products.update',$product->id) }}" method="POST" style="padding-left:110px" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <x-form.input label="Product Name" name="name" value="{{ $product->name }}" type="text"/>
    </div>
    
    <div class="form-group">
        <label for="">Category</label>
        <select name="category_id" class="form-control @error('category_id')
                        is-invalid @enderror" style="width: 450px">
            <option value="">primary category</option>
            @foreach (App\Models\Category::all() as $category)
                <option value="{{ $category->id }}" @selected(old('category_id',$category->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <div class="text-danger" style="width: 450px">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <x-form.textarea label="Description" value="{{ $product->description }}" name="description" />
    </div>

    <div class="form-group">
        <x-form.input label="Image" type="file" name="image"/>
        @if($product->image)
            <img src="{{ asset('storage/'.$category->image) }}" height="70px">
        @endif
    </div>

    <div class="form-group">
        <x-form.input label="Price" name="price" value="{{ $product->price }}" />
    </div>

    <div class="form-group">
        <x-form.input label="Compare Price" name="compare_price" value="{{ $product->compare_price }}" />
    </div>

    <div class="form-group">
        <x-form.input label="Tags" name="tags" value="{{ $tags }}"/>
    </div>

    <div class="form-group">
        <x-form.radio label="Status" name="status" :checked="$product->status" :options="['active'=>'Active','draft'=>'Draft','archived'=>'Archived']"/>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form> 

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        var inputElm = document.querySelector('[name=tags]'),
        tagify = new Tagify (inputElm); 
    </script>
@endpush