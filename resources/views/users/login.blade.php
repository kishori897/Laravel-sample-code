@extends('layouts.master')
@section('title',__('Login'))   
@section('content')
    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('users.login') }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf

                            
                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter User email">
                            
                               
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Enter User password">
                            
                                
                                @error('password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                           

                            <button type="submit" class="btn btn-md btn-primary">Submit</button>
                           

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection   
