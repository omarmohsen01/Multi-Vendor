@extends('layouts.dashboard')

@section('title','Category')

@section('content')

<div class="mb-3">
    @if(Auth::user()->can('dashboard.categories.create'))
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary ml-2">Create</a>
    @endif
    <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-primary ml-2">Trash</a>
</div>

<x-alert/>
<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mbl-4 ml-10">
    <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')"/>
    <select name="status" class="form-control mx-2">
        <option value="">All</option>
        <option value="active" @selected(request('status')=='active')>Active</option>
        <option value="archived" @selected(request('status')=='archived')>Archived</option>
    </select>
    <button class="btn btn-dark mx-2">Filter</button>
</form>

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Product #</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspan="2"></th> 
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
            <tr>
                <td><img src="{{ asset('storage/'.$category->image) }}" height="70px"></td>
                <td>{{ $category->id }}</td>
                <td><a href="{{ route('dashboard.categories.show',$category->id) }}"> {{ $category->name }}</a></td>
                <td>{{ $category->parent->name }}</td>
                <td>{{ $category->products_count }}</td>
                <td>{{ $category->status }}</td>
                <td>{{ $category->created_at }}</td>
                <td>
                    @can('categories.update')
                        <a href="{{ route('dashboard.categories.edit',$category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                    @endcan
                </td>
                <td>
                    @can('categories.delete')
                        <form method="POST" action="{{ route('dashboard.categories.destroy',$category->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            @method('delete')
                        </form>
                    @endcan
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="9">No Category Found</td>
                </tr>
        @endforelse
    </tbody>        
</table>

{{ $categories->withQueryString()->links() }}

@endsection