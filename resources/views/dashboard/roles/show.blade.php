@extends('layouts.dashboard')

@section('title',$role->name)

@section('content')
 

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @php
            $products=$role->products()->with('store')->paginate(10); 
        @endphp
        @forelse ($products as $product)
        <tr>
            <td><img src="{{ asset('storage/'.$product->image) }}" height="70px"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->store->name }}</td>
            <td>{{ $product->status }}</td>
            <td>{{ $product->created_at }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="9">No product Found</td>
        </tr>
        @endforelse
    </tbody>
</table>
{{ $products->links() }}


@endsection