@extends('layouts.backend.backend-app')

@section('links')
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
              <li class="breadcrumb-item active" aria-current="page">Edit Topic</li>
            </ol>
        </nav>

        <div class="card p-3 mt-4"> 
            <div class="category_title my-3">
                <div class="modal-header">
                    <h2 class="modal-title">Edit Topic</h2>
                    <a href="{{route('polling_category.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
            
            <form action="{{ route('polling_sub_cat.update', $item->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label>Topic Name <span class="text-danger">*</span></label>
                    <input type="text" value="{{$item->name}}" class="form-control" name="name" placeholder="SubCategory Name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="needLive{{$item->id}}" type="checkbox" {{ $item->home_page_live == 1 ? 'checked':'' }} name="home_page_live" placeholder="">
                    <label for="needLive{{$item->id}}"> Home Page Live Status </label>
                </div> 

                <div class="form-group">
                    <input id="needReg{{$item->id}}" type="checkbox" {{ $item->need_registration==1 ? 'checked':'' }} name="need_registration" placeholder="">
                    <label for="needReg{{$item->id}}"> Need Registration ?</label>
                </div> 

                <div class="form-group">
                    <input id="needTime{{$item->id}}" type="checkbox"  {{ $item->need_specifi_time==1 ? 'checked':'' }} class="edit_need_specifi_time" name="need_specifi_time" placeholder="">
                    <label for="needTime{{$item->id}}"> Need Specific Time ?</label>
                </div>

                <div class="EditneedTimeDiv {{ $item->need_specifi_time == 0 ? 'd-none' : 'd-block' }}"> 
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label> Start Date </label>
                                    
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                        
                                    <input class="form-control" name="start_date" value="{{ \Carbon\Carbon::parse($item->start_date)->format('Y-m-d') }}"  type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                                
                                @error('start_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label> Start Time </label>
                                    
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-clock-o tx-16 lh-0 op-6"></i>
                                    </div>
                                    <input class="form-control" name="start_time" value="{{$item->start_time}}" type="time">
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
                                <label> End Date </label>
                                    
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                    <input class="form-control" name="end_date" type="date" value="{{ \Carbon\Carbon::parse($item->end_date)->format('Y-m-d') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                                
                                @error('end_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label> End Time </label>
                                    
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-clock-o tx-16 lh-0 op-6"></i>
                                    </div>
                                    <input class="form-control" name="end_time" type="time" value="{{$item->end_time}}">
                                </div>
                                
                                @error('end_time')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <h6>Publish Status</h6>
                    
                    <input type="radio" id="pause{{$item->id}}" name="is_published" value="pause" {{$item->is_published == "pause" ? 'checked' : ''}}>
                    <label for="pause{{$item->id}}" class="mr-5" style="margin-right: 20px">Pause</label>
                    <input type="radio" id="publish{{$item->id}}" name="is_published" value="publish" {{$item->is_published == "publish" ? 'checked' : ''}}>
                    <label for="publish{{$item->id}}">Publish</label><br> 
                </div> 


                <div class="form-group">
                @php
                    $selected_country = json_decode($item->country); 
                @endphp
                        <label>Country<span class="text-danger">*</span></label><br>
                    @if ($item->country == 'global')
                        <button type="button" class="btn btn-info btn-outline-dark global_button">Global</button> 
                        <button type="button" class="btn btn-outline-dark specific_button">Specific Country</button>

                        <div class="mt-3 edit_specific_country d-none"> 
                            <label  >Select Country</label>
                            <select name="country[]" class="mySelect form-control" id="mySelect__{{$item->id}}" multiple>
                                @foreach ($countries as $country)
                                    <option value="{{$country->code}}">{{ $country->name }}</option>
                                @endforeach 
                            </select>
                        </div>

                    @else
                        <button type="button" class="btn btn-outline-dark global_button">Global</button>
                        <input type="hidden" value="update_global" name="update_global">
                        <button type="button" class="btn btn-info btn-outline-dark specific_button">Specific Country</button>

                        <div class="mt-3 edit_specific_country">
                            <label  >Select Country</label> 
                            <select name="country[]" class="mySelect form-control" id="mySelect__{{$item->id}}" multiple>
                                @foreach ($selected_country as $select)
                                    @foreach ($countries as $country)
                                        <option  value="{{$country->code}}" {{ $country->code== $select? 'selected' : '' }}>{{$country->name}}</option>
                                    @endforeach
                                @endforeach 
                            </select>
                        </div>
                    @endif 
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Update">
                </div>
            </form>

        </div>
    </div>
</div>



<script type="text/javascript"> 

    const title = document.querySelector("#name")
    const slug = document.querySelector("#slug")
    
    title.addEventListener('keyup', function() {
        $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-").replace(/\?/g, '-'));
    }) 

</script>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.mySelect').select2({
                width : "100%",
                placeholder: "Select",
                allowClear: true
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){


        $('.global_button').click(function(){
            $('.mySelect').empty();
            $('.edit_specific_country').addClass('d-none')
            $('.global_button').addClass("btn-info")
            $('.specific_button').removeClass("btn-info")
        });
        $('.specific_button').click(function(){
            $('.edit_specific_country').removeClass('d-none')
            $('.specific_button').addClass("btn-info")
            $('.global_button').removeClass("btn-info")
        });
            

    });
    </script>

<script>
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
@endsection
