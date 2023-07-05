@extends('layouts.dashboard')

@section('title','Edit Profile')

@section('content')

<x-alert />

<form action="{{ route('dashboard.profile.update') }}" method="POST" style="padding-left:110px" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="form-row">
        <div class="col-md-4">
            <x-form.input name="name" label="Name" :value="$user->first_name"/>
        </div>

        <div class="col-md-4">
            <x-form.input name="last_name" label="Last Name" :value="$user->last_name"/>
        </div>
    </div>


    <div class="form-row">
        <div class="col-md-6">
            <x-form.input name="birthday" label="BirthDay" type="date" :value="$user->birthday"/>
        </div>
        <div class="col-md-6">
            <x-form.radio name="gender" label="Gender" :options="['male'=>'Male','female'=>'Female']" :checked="$user->gender"/>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4">
            <x-form.input name="street_address" label="Street Address" :value="$user->street_address"/>
        </div>
        <div class="col-md-4">
            <x-form.input name="city" label="City" :value="$user->city"/>
        </div>
        <div class="col-md-4">
            <x-form.input name="state" label="State" :value="$user->state"/>
        </div>
    </div> 

    <div class="form-row">
        <div class="col-md-4">
            <x-form.input name="postal_code" label="Postal Code" :value="$user->postal_code"/>
        </div>
        <div class="col-md-4">
            <x-form.select name="country" label="Country" :options="$countries" :selected="$user->country"/>
        </div>
        <div class="col-md-4">
            <x-form.select name="locale" :options="$locales" label="Locale" :selected="$user->locale" />
        </div>
    </div> 

    <button type="submit" class="btn btn-primary">Save</button>
</form> 

@endsection