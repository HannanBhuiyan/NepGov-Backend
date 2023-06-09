
@extends('layouts.backend.backend-app')

@section('content')

<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add News</li>
            </ol>
        </nav>
        <div class="card p-3 mt-4">
            <div class="category_title my-3">
                <h3>Add News</h3>
            </div>
            <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div id="wizard1">
                    <h3>Information</h3>
                    <section>
                        <div class="form-group">
                            <label> News Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="news_title" name="title" placeholder="News Title">
                           
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label> News Slug<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="news_slug" name="slug" placeholder="News Slug">
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Choose Category<span class="text-danger">*</span> <b>(If no Category <a href="{{route('category.create')}}">Create Category</a> Here:)</b></label>
                            <select name="category_id" class="form-control">
                                <option selected>--Choose Category--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach    
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="feature_image">Feature Image <span class="text-warning">(size: 1900*466px)</span></label>
                            <input type="file" onchange="document.getElementById('second_image').src=window.URL.createObjectURL(this.files[0])"  name="feature_image"  class="form-control">
                            @error('feature_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> 
                        <div class="form-group">
                            <img width="500px" id="second_image">
                        </div>
        
                        <div class="form-group">
                            <label> News Description <span class="text-danger">*</span></label>
                            <textarea class="form-control ckeditor" name="description" placeholder="Description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </section>

                    <h3>SEO Information</h3>
                    <section>
                        <div class="form-group">
                            <label> Seo Title </label>
                            <input type="text" id="input_title" maxlength="60" class="form-control" value="{{old('seo_title')}}" name="seo_title" placeholder="SEO Title">
                            <p class="text-danger" id="div_title"></p>
                        </div>
        
                        <div class="form-group">
                            <label> Seo Description</label>
                            {{-- <input type="text" id=""> --}}
                            <textarea class="form-control" maxlength="160" rows="10" id="input_desc"  name="seo_desc" placeholder="SEO Desc">{{ old('seo_desc') }}</textarea>
                            <p class="text-danger" id="div_desc"></p>
                        </div>
        
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" value="Save">
                        </div>        
                    </section>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">


    const news_title = document.querySelector("#news_title")
    const news_slug = document.querySelector("#news_slug")
    const seo_title = document.querySelector("#seo_title")
    const seo_slug = document.querySelector("#seo_slug")
    
    news_title.addEventListener('keyup', function() {
        $('#news_slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-").replace(/\?/g, '-'));
    }) 

    seo_title.addEventListener('keyup', function() {
        $('#seo_slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-").replace(/\?/g, '-'));
    }) 


    CKEDITOR.replace('description');

</script>
@endsection