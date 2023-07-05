@extends('layouts.dashboard')

@section('title','Edit Role')

@section('content')

<form action="{{ route('dashboard.roles.update',$role->id) }}" method="POST" style="padding-left:110px" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <x-form.input label="Role Name" name="name" value="{{ $role->name }}" type="text"/>
    </div>

    <fieldset>
        <legend>Abilities</legend>
        @foreach (config('abilities') as $abilities_code=>$abilities_name)
            <div class="row mb-2">
                <div class="col-md-4">
                    <h5><b>{{ $abilities_name }}</b></h5>
                </div>
                <div class="col-md-2">
                    <input type="radio" name="abilities[{{ $abilities_code }}]" value="allow" @checked(($role_abilities[$abilities_code]??'')=='allow')>Allow
                </div>
                <div class="col-md-2">
                    <input type="radio" name="abilities[{{ $abilities_code }}]" value="deny" @checked(($role_abilities[$abilities_code]??'')=='deny')>Deny
                </div>
                <div class="col-md-2">
                    <input type="radio" name="abilities[{{ $abilities_code }}]" value="inherit" @checked(($role_abilities[$abilities_code]??'')=='inherit')>Inherit
                </div>
            </div>
        @endforeach
    </fieldset>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form> 

@endsection