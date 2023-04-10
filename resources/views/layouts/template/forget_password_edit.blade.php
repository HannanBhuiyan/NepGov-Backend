
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
            <form action="{{ route('forget_password_update', $forgetPassword->id ) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                {{-- <div class="col-12">
                    <div class="form-group">
                        <label for="">Previous Logo </label><br>
                        <img src="{{ asset($forgetPassword->logo ) }}" alt="not found" width="200" height="100">
                    </div>
                </div>
                <div class="form-group">
                    <label for="logo">Logo<span class="text-warning"></span></label>
                    <input type="file" name="logo" onchange="document.getElementById('second_image').src=window.URL.createObjectURL(this.files[0])" class="form-control">
                </div> 
                <div class="form-group">
                    <img width="200" id="second_image">
                </div> --}}

                <div class="form-group">
                    <label> Title<span class="text-danger">*</span></label>
                    <input type="text" value="{{ $forgetPassword->title }}" class="form-control" id="news_title" name="title">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                    
                <div class="form-group">
                    <label> Link Text<span class="text-danger">*</span></label>
                    <input type="text" value="{{ $forgetPassword->reset_link_text }}" class="form-control" name="reset_link_text">
                    @error('reset_link_text')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
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