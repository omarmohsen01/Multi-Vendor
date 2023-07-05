@extends('layouts.dashboard')

@section('title','Product')

@section('content')

<div class="mb-3">
    @can('products.create')
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-sm btn-outline-primary ml-2">Create</a>
    @endcan
</div>

<x-alert />
<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mbl-4 ml-10">
    <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
    <select name="status" class="form-control mx-2">
        <option value="">All</option>
        <option value="active" @selected(request('status')=='active' )>Active</option>
        <option value="archived" @selected(request('status')=='archived' )>Archived</option>
    </select>
    <button class="btn btn-dark mx-2">Filter</button>
</form>

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
        <tr>
            <td><img src="{{ asset('storage/'.$product->image) }}" height="70px"></td>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->store->name }}</td>
            <td>{{ $product->status }}</td>
            <td>{{ $product->created_at }}</td>
            @can('products.update')
                <td>
                    <a href="{{ route('dashboard.products.edit',$product->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
            @endcan
            @can('products.delete')
                <td>
                    <form method="POST" action="{{ route('dashboard.products.destroy',$product->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        @method('delete')
                    </form>
                </td>
            @endcan
        </tr>
        @empty
        <tr>
            <td colspan="9">No product Found</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $products->withQueryString()->links() }}

@endsection