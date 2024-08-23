@extends('layouts.master')
@section('title',__('Change Password'))   
@section('content')

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        
                        <form action="{{ route('users.change-password', $id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            
                            <div class="form-group">
                                <label class="font-weight-bold">Old Password</label>
                                <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" value="{{ old('old_password') }}" placeholder="Enter Old password">
                            
                                
                                @error('old_password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">New Password</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" value="{{ old('new_password') }}" placeholder="Enter New password">
                            
                                
                                @error('new_password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Confirm Password</label>
                                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" value="{{ old('confirm_password') }}" placeholder="Enter New password ">
                            
                                
                                @error('confirm_password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            

                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

 @endsection  