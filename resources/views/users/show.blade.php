@extends('layouts.master')
@section('title',__('User Detail'))   
@section('content')

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        
                        <h4>{{ $user->name }}</h4>
                        <p class="tmt-3">
                            {!! $user->email !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

 @endsection     
