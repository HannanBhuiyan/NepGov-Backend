@extends('layouts.backend.backend-app')

@section('links')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
<style>
    .modal-title{
        margin-left: -15px;
    }
</style>
@endsection

@section('content')

<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('polling_category.index')}}">Topics</a></li>
              <li class="breadcrumb-item active" aria-current="page">Create Topic</li>
            </ol>
        </nav>

        <div class="card p-3 mt-4"> 
            <div class="category_title my-3">
                <div class="modal-header">
                    <h2 class="modal-title">Create Topic</h2>
                    <a href="{{route('polling_category.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>

            
            <form action="{{ route('polling_sub_cat.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Polling Category<span class="text-danger">*</span> (If no Category <a href="{{route('polling_category.create')}}">Create Category</a> Here:)</label>
                    <select name="category_id" class="form-control">
                        <option selected value>--Selece One--</option>
                        @foreach ($polling_category as $cat)
                            <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                        @endforeach  
                    </select>
                    @error('category_id')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label> Topics Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Slug <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug">
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="checkbox" id="need_registration" name="need_registration" placeholder="">
                    <label for="need_registration"> Need Registration ? </label>
                </div> 

                <div class="form-group">
                    <input id="mycheckedbtn"   type="checkbox" name="need_specifi_time" placeholder="" >
                    <label for="mycheckedbtn"> Need Specifice Time ? </label>
                </div> 

                <div id="needTimeDiv"> 
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label> Start Date <span class="text-danger">*</span></label>
                                    
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                    <input class="form-control" name="start_date" type="date"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                            
                                @error('start_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label> Start Time <span class="text-danger">*</span></label>
                                    
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-clock-o tx-16 lh-0 op-6"></i>
                                    </div>
                                    <input class="form-control" name="start_time" placeholder="" type="time">
                                </div>
                                
                                @error('start_time')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label> End Date <span class="text-danger">*</span></label>
                                    
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                    <input class="form-control " id="end-date" name="end_date" type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                                
                                @error('end_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label> End Time <span class="text-danger">*</span></label>
                                    
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-clock-o tx-16 lh-0 op-6"></i>
                                    </div>
                                    <input class="form-control" name="end_time" placeholder="" type="time">
                                </div>
                                
                                @error('end_time')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group" id="publishPause">
                    <h6>Publish Status </h6>
                    <input type="radio" id="publish" name="is_published" value="publish" checked>
                    <label for="publish" class="mr-5">Publish</label>
                    <input type="radio" id="pause" name="is_published" value="pause">
                    <label for="pause">Pause</label>
                </div>
                

                <div class="form-group">
                    <label>Country</label><br>
                    <button type="button" class="btn btn-outline-dark global_add_button">Global</button>
                    <button type="button" class="btn btn-outline-dark specific_add_button">Specific Country</button>
                    
                    <div class="mt-4" id="specific_country"> 
                        
                        <label>Select Country</label>
                        <select class="form-control" id="mySelect" name="country[]" multiple> 
                            @foreach ($countries as $country)
                                <option value="{{ $country->code }}">{{ $country->name }}</option>
                            @endforeach 
                        </select>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <input type="submit" class="form-control btn btn-primary" value="Save">
                </div>
            </form>

        </div>
    </div>
</div>



@endsection


@section('scripts')


<script type="text/javascript">
    const name = document.querySelector("#name")
    const slug = document.querySelector("#slug")
    
    name.addEventListener('keyup', function() {
        $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-").replace(/\?/g, '-'));
    })
</script>

<script type="text/javascript">
    $(document).ready(function(){

    $('#specific_country').hide();
    $('.global_add_button').click(function(){
        $('#mySelect').empty();
        $('#specific_country').hide()
        // $('.edit_specific_country').addClass('d-none')
        $('.global_add_button').addClass("btn-info")
        $('.specific_add_button').removeClass("btn-info")
    });
    $('.specific_add_button').click(function(){
        // $('.edit_specific_country').removeClass('d-none')
        $('#specific_country').show()
        $('.specific_add_button').addClass("btn-info")
        $('.global_add_button').removeClass("btn-info")
    });
        

});
</script>


<script>

    

    $(document).ready(function() {
        $('#mySelect').select2({
            width : "100%",
            allowClear: false
        });
    });


    $(document).ready(function(){
        $('#needTimeDiv').hide();
        $('input[name=need_specifi_time]').click(function() {
            if ($(this).is(':checked')) {
                // $('#publishPause').hide();
                $('#needTimeDiv').show();
            }
            else {
                $('#needTimeDiv').hide();
                // $('#publishPause').show();
            }
        }); 
        
        
        
        // edit settings
        $('.edit_need_specifi_time').click(function() {
            if ($(this).is(':checked')) {
                $('.EditneedTimeDiv').toggleClass('d-block') 
            }
            else {
                $('.EditneedTimeDiv').removeClass('d-block')
                $('.EditneedTimeDiv').addClass('d-none')
            }
        }); 

    })

</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script>

@endsection

