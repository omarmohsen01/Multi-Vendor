@extends('layouts.dashboard')

@section('title','Trashed Category')

@section('content')

<div class="mb-3">
    <a href="{{ route('dashboard.categories.index') }}" class="btn btn-sm btn-outline-primary">Back</a>
</div>

<x-alert/>
<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4" style="margin-left: 10px">
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
            <th>Status</th>
            <th>Deleted At</th>
            <th colspan="2"></th> 
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
            <tr>
                <td><img src="{{ asset('storage/'.$category->image) }}" height="70px"></td>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->status }}</td>
                <td>{{ $category->deleted_at }}</td>
                <td>
                    <form method="POST" action="{{ route('dashboard.categories.restore',$category->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-info">Restore</button>
                        @method('put')
                    </form>                
                </td>
                <td>
                    <form method="POST" action="{{ route('dashboard.categories.forceDelete',$category->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        @method('delete')
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="7">No Category Found</td>
                </tr>
        @endforelse
    </tbody>        
</table>

{{ $categories->withQueryString()->links() }}

@endsection