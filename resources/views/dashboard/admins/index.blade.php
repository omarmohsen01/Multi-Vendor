@extends('layouts.dashboard')

@section('title','Admin')

@section('content')

<div class="mb-3">
    @if(Auth::user()->can('admins.create'))
        <a href="{{ route('dashboard.admins.create') }}" class="btn btn-sm btn-outline-primary ml-2">Create</a>
    @endif
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
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
            <th colspan="2"></th> 
        </tr>
    </thead>
    <tbody>
        @forelse ($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->username }}</td>
                <td>{{ $admin->email }}</td>
                <td></td>
                <td>{{ $admin->created_at }}</td>
                <td>
                    @can('admins.update')
                        <a href="{{ route('dashboard.admins.edit',$admin->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                    @endcan
                </td>
                <td>
                    @can('admins.delete')
                        <form method="POST" action="{{ route('dashboard.admins.destroy',$admin->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            @method('delete')
                        </form>
                    @endcan
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="9">No admin Found</td>
                </tr>
        @endforelse
    </tbody>        
</table>

{{ $admins->withQueryString()->links() }}

@endsection