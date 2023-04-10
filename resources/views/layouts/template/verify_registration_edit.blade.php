
@extends('layouts.backend.backend-app')


@section('content')

<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Edit </li>
            </ol>
        </nav>
        <div class="card p-3 mt-4">
            <div class="category_title my-3">
                <h3>Edit </h3>
            </div>
            <form action="{{ route('verify_register_update', $verifyRegister->id ) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                {{-- <div class="col-12">
                    <div class="form-group">
                        <label for="">Previous Logo </label><br>
                        <img src="{{ asset($verifyRegister->logo ) }}" alt="not found" width="200" height="100">
                    </div>
                </div>
                <div class="form-group">
                    <label for="logo">Logo<span class="text-warning"></span></label>
                    <input type="file" name="logo" onchange="document.getElementById('second_image').src=window.URL.createObjectURL(this.files[0])" class="form-control">
                </div> 
                <div class="form-group">
                    <img width="200" id="second_image">
                </div> --}}

                {{-- <div class="col-12">
                    <div class="form-group">
                        <label for="">Previous Image </label><br>
                        <img src="{{ asset($verifyRegister->image ) }}" alt="not found" width="300" height="300">
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Image<span class="text-warning"></span></label>
                    <input type="file" name="image" onchange="document.getElementById('first_image').src=window.URL.createObjectURL(this.files[0])" class="form-control">
                </div> 
                <div class="form-group">
                    <img width="300" id="first_image">
                </div> --}}

                <div class="form-group">
                    <label> Title<span class="text-danger">*</span></label>
                    <input type="text" value="{{ $verifyRegister->title }}" class="form-control" id="news_title" name="title">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                    
                <div class="form-group">
                    <label> Token</label>
                    <input type="text" value="{{ $verifyRegister->token_name }}" class="form-control" name="token_name">
                </div>
                <div class="form-group">
                    <label> Link Text</label>
                    <input type="text" value="{{ $verifyRegister->link_text }}" class="form-control" name="link_text">
                </div>
                <div class="form-group">
                    <label> Link </label>
                    <input type="text" value="{{ $verifyRegister->link }}" class="form-control" name="link">
                </div>
                <div class="form-group">
                    <label> Ignore Message </label>
                    <input type="text" value="{{ $verifyRegister->ignore_message }}" class="form-control" name="ignore_message">
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection