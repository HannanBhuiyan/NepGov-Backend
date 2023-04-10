@extends('layouts.backend.backend-app')

@section('links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        .close_btn{
            width: 120px;
            position: absolute;
            bottom: 10px;
            right: 20px;
        }

        .modal-open .ui-datepicker {
            top: 400px !important;
        }
       
        @media screen and (max-width: 768px) {
            a.btn{
                margin-bottom: 17px !important;
            }
            a.btn.btn-outline-primary {
                margin-top: 20px;
            }
        }
       
    </style>
@endsection

@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="row mt-5">
    <div class="col-md-12 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4">
            <div class="category_title my-3 d-flex justify-content-between">
               <div class="left">
                    <h3>Category List</h3>
               </div>
               <div class="right">
                @can('live topic create')
                <a class="btn btn-primary" href="{{route('polling_topic_create')}}">Add Topics</a>
                @endcan
                @can('live category create')
                <a class="btn btn-primary" href="" data-toggle="modal" data-target="#addcategorymodal_03">Add Category</a>
                @endcan
               </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-fixed text-center border-bottom" id="">
                    <thead>
                    <tr>
                        <th scope="col">SL No</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Topics</th>
                        <th class="">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($polling_category as $cat)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $cat->category_name }}</td>
                            <td  style="width: 1100px !important">
                                @foreach ($cat->poll_sub_cat as $item)
                                    {{-- <li> --}}
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <a href="" data-toggle="modal" data-target="#Modalview__{{$item->id}}">
                                                {{Str::headline($item->name)}}
                                            </a> <span class="text-danger">{{$item->home_page_live == 1 ? '(LIVE)' : ''}}</span>
                                        </div> 
                                        <div class="col-lg-4">
                                            @can('live question create')
                                            <a class="btn btn-outline-primary" href="" data-toggle="modal" data-target="#addquestionindividual_{{$item->id}}">Add Question</a>
                                            @endcan
                                            @can('live topic edit')
                                            <a href="{{route('polling_sub_category_edit', $item->id)}}"  class=" mx-3 btn btn-outline-success">Edit</a>                                                    
                                            @endcan
                                            @can('live topic delete')
                                            <a href="" data-toggle="modal" data-target="#modaldelsub__{{$item->id}}" class=" btn btn-outline-danger">Delete</a>
                                            @endcan
                                        </div> 
                                    </div>
                                    @if (!$loop->last) <hr> @endif
                                    {{-- </li> --}}
                               
                                    <!-- Modal sub cateogry view-->
                                    @push('modals')
                                        <div class="modal reloadModal fade" id="Modalview__{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="Modal__{{$item->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content pb-5">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="Modal__{{$item->id}}">Topic</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3>{{Str::upper($item->name)}}</h3>
                                                        <table class="table table-bordered border-width-3" id="example">
                                                            <tr>
                                                                <th> Name</th>
                                                                <td>{{ $item->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Need Registration</th>
                                                                <td>{{ $item->need_registration == 0 ?'NO' : 'YES' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Status</th>
                                                                <td>{{ $item->status }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Publish Status</th>
                                                                <td>{{ $item->is_published ?? '' }}</td>
                                                            </tr>
                                                            @if ($item->need_specifi_time == 1)
                                                                <tr>
                                                                    <th>Start Time</th>
                                                                    <td>{{ $item->start_date ?? '' }} -- {{ $item->start_time ?? '' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>End Time</th>
                                                                    <td>{{ $item->end_date ?? '' }} -- {{ $item->end_time ?? '' }}</td>
                                                                </tr>
                                                            @endif
                                                            <tr>
                                                                @php
                                                                    $con = json_decode($item->country);
                                                                @endphp 
                                                                <th>Country</th>
                                                                <td>
                                                                    @if ($item->country == 'global')
                                                                        {{$item->country}}
                                                                    @else
                                                                        @foreach ($con as $data)
                                                                        @php
                                                                            $coun_name=App\Models\Country::where('code',$data)->get()
                                                                        @endphp
                                                                            @foreach ($coun_name as $cont)
                                                                                {{ $cont->name }}
                                                                            @endforeach
                                                                            @if (!$loop->last) , @endif
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                @php
                                                                    $ques = App\Models\PollingQuestion::where('sub_category_id',$item->id)->get();
                                                                @endphp
                                                                <th>Questions</th>
                                                                <td> 
                                                                    @foreach ($ques as $que)
                                                                        @php
                                                                            $question_count = App\Models\PollingReview::where('question_id',$que->id)->get();
                                                                        @endphp
                                                                        <li>
                                                                            {{ $que->question }}<br>
                                                                            @php
                                                                                $chart_datas =  $que->poll_options->map(function($polling_item) use($question_count){
                                                                                    $chart_option_count = App\Models\PollingReview::where('polling_option_id',$polling_item->id)->get();
                                                                                    if($question_count->count()>0){
                                                                                        $xyz =  "['".$polling_item->option."',".round($chart_option_count->count()/$question_count->count()*100, 1)."],";
                                                                                        return $xyz;
                                                                                    }
                                                                                });
                                                                                $charts = json_decode($chart_datas);
                                                                            @endphp
 
                                                                                {{-- charts --}} 
                                                                                @push('script')
                                                                                <script type="text/javascript">
                                                                                    google.charts.load('current', {'packages':['corechart']})
                                                                                    google.charts.setOnLoadCallback(drawChart)
                                                                                
                                                                                    function drawChart() { 
                                                                                        var data = google.visualization.arrayToDataTable([
                                                                                            ['Topic', 'Question with Vote'],
                                                                                            @php 
                                                                                                foreach($charts as $chart ){
                                                                                                    echo $chart;
                                                                                                }
                                                                                            @endphp
                                                                                        ]);
                                                                                        var options = {
                                                                                        'title': 'Voting Reviews',
                                                                                        'width':500,
                                                                                        'height':500
                                                                                        }
                                                                                        var chart = new google.visualization.PieChart(document.getElementById('googlepiechart__{{ $que->id }}'))
                                                                                
                                                                                        chart.draw(data, options);
                                                                                    }
                                                                                </script>
                                                                                @endpush


                                                                            @foreach ($que->poll_options as $poll)
                                                                                @php
                                                                                    $opt_count=App\Models\PollingReview::where('polling_option_id',$poll->id)->get();
                                                                                @endphp
                                                                                <ol>--{{ $poll->option }}
                                                                                    @if ($question_count->count()>0)
                                                                                    <span  class="badge badge-light">({{ round($opt_count->count()/$question_count->count()*100, 2) }}%)</span>
                                                                                    @endif 
                                                                                </ol> 
                                                                            @endforeach

                                                                    
                                                                            @if ($question_count->count() > 0)
                                                                                <div class="card">
                                                                                    <div id="googlepiechart__{{ $que->id }}"></div>
                                                                                </div>    
                                                                            @endif 

                                                                        </li>
                                                                    @endforeach
                                                                </td>    
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <a href="" class="close_btn btn btn-danger" data-dismiss="modal">Close</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endpush
                                    
                                    <!-- sub cateogry/topic edit Modal  -->
                                    
                                    <!--Delete MODAL Sub CAT -->
                                    @push('modals')
                                        @php
                                            $count =  App\Models\PollingQuestion::where('sub_category_id', $cat->id)->count();
                                        @endphp
                                        <div class="modal fade" id="modaldelsub__{{$item->id}}">
                                            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="card-body text-center">
                                                        <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="60" width="60" viewBox="0 0 24 24">
                                                        <path fill="#f07f8f" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z"/><circle cx="12" cy="17" r="1" fill="#e62a45"/><path fill="#e62a45" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z"/></svg></span>
                                                        <h4 class="h4 mb-0 mt-3">Warning</h4>
                                                        @if ($count > 0)
                                                            <strong class="card-text text-red">Questions r available in this category, please delete those first</strong>
                                                        @else
                                                            <p class="card-text">Are you sure you want to delete data?</p>
                                                            <strong class="card-text text-red">Once deleted, you will not be able to recover this data!</strong>
                                                        @endif
                                                    </div>
                                                    <div class="card-footer text-center border-0 pt-0">
                                                        <div class="row">
                                                            <div class="text-center pt-3">
                                                                <a href="" id="cancel_id" class="btn btn-dark me-2" data-dismiss="modal">Cancel</a>
                                                                <a href="{{ route('polling_sub_cat.delete', $item->id) }}" class="btn btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpush

                                    <!-- Modal Add Question-->
                                    <div class="modal reloadModal fade" id="addquestionindividual_{{$item->id}}"  aria-labelledby="addquestionindividual_{{$item->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content pb-5">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Question</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('polling_question.store') }}" method="post" enctype="multipart/form-data" class="text-start">
                                                        @csrf
                                                        <input type="hidden" name="polling_category_id" value="{{$cat->id}}">
                                                        <input type="hidden" name="sub_category_id" value="{{$item->id}}">
                                                        <div class="form-group">
                                                            <label>Question <span class="text-danger">*</span></label>
                                                            <input type="text" class="question form-control" name="question" placeholder="Question">
                                                            @error('question')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        
                                                        {{-- <div class="form-group">
                                                            <label> Question Slug <span class="text-danger">*</span></label>
                                                            <input type="text" class="question_slug form-control" name="slug" placeholder="Slug">
                                                            @error('slug')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div> --}}
                                        
                                                        <div class="form-group">
                                                            <label> Options <span class="text-danger">*</span></label>
                                                            <div class="row new_properties mb-1">
                                                                <div class="col-10">
                                                                    <input type="text" class="form-control" name="option[]" placeholder="Options">
                                                                </div>
                                                                <div class="col-2">
                                                                    <button type="button" class="close remove--new_properties">
                                                                        <span>&times;</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="properties-container"></div>
                                                            <div class="btn btn-info mt-1 add_more">Add More</div>
                                                        </div>
                                        
                                                        <div class="form-group">
                                                            <input type="submit" class="form-control btn btn-primary" value="Add Question">
                                                        </div>
                                                    </form>
                                                </div>
                                                <a href="" class="close_btn btn btn-danger" data-dismiss="modal">Close</a>
                                            </div>
                                        </div>
                                    </div> 
                                    

                                @endforeach
                            </td> 
                            <td>
                                @can('live category edit')
                                <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaledit__{{$cat->id}}">Edit</a>
                                @endcan
                                @can('live category delete')   
                                <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modaldemo8__{{$cat->id}}">Delete</a>
                                @endcan
                            </td>
                        </tr>
                        @php
                            $count_sub =  App\Models\PollingSubCategory::where('category_id', $cat->id)->count();
                        @endphp
                        @push('modals')
                        <!--Edit Category MODAL EFFECTS -->
                        <div class="modal reloadModal fade" id="modaledit__{{$cat->id}}">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="card-body">
                                        <form action="{{ route('polling_category.update', $cat->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method("PUT")
                                            <div class="modal-header" style="padding: 0 !important;
                                            padding-bottom: 15px !important;">
                                                <h5 class="modal-title">Category Name</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" value="{{$cat->category_name}}" class="form-control" id="category_name" name="category_name" placeholder="Category Name">
                                                @error('category_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                            
                                            <div class="form-group mb-2">
                                                <input type="submit" class="form-control btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$cat->id}}" value="Update">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Delete MODAL EFFECTS -->
                        <div class="modal fade" id="modaldemo8__{{$cat->id}}">
                            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="card-body text-center">
                                        <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="60" width="60" viewBox="0 0 24 24">
                                        <path fill="#f07f8f" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z"/><circle cx="12" cy="17" r="1" fill="#e62a45"/><path fill="#e62a45" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z"/></svg></span>
                                        <h4 class="h4 mb-0 mt-3">Warning</h4>
                                        @if ($count_sub > 0)
                                            <strong class="card-text text-red">Topics are available in this category, please delete those first</strong>
                                        @else
                                            <p class="card-text">Are you sure you want to delete data?</p>
                                            <strong class="card-text text-red">Once deleted, you will not be able to recover this data!</strong>
                                        @endif
                                    </div>
                                    <div class="card-footer text-center border-0 pt-0">
                                        <div class="row">
                                            <div class="text-center p-3">
                                                <a href="javascript:void(0)" class="btn btn-dark me-2" data-bs-dismiss="modal">Cancel</a>
                                                <a href="{{ route('polling_category.delete', $cat->id) }}" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endpush
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    @push('modals')
   
    @endpush
</div>


 <!-- Modal Add Category-->
 <div class="modal reloadModal fade" id="addcategorymodal_03"  aria-labelledby="addcategorymodal_03" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content pb-5">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="{{ route('polling_category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label> Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name">
                        @error('category_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label> Category Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="cat_slug" name="slug" placeholder="Category Slug">
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
            {{-- <div class="properties-container"></div> --}}
            <a href="" class="close_btn btn btn-danger" data-dismiss="modal">Close</a>
        </div>
    </div>
</div>

<!-- Modal add Sub Category/Topic-->



@endsection


@section('scripts')


<script type="text/javascript">

        const category_name = document.querySelector("#category_name")
        const cat_slug = document.querySelector("#cat_slug")

        category_name.addEventListener('keyup', function() {
            $('#cat_slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-").replace(/\?/g, '-'));
        })
        

        // const question = document.querySelector(".question")
        // const question_slug = document.querySelector(".question_slug")
        
        // question.addEventListener('keyup', function() {
        //     console.log('odskfok');
        //     $('.question_slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-").replace(/\?/g, '-'));
        // })
    </script>
 
    <script type="text/javascript"> 

        $(document).ready(function(){
            $('#poll_cat').change(function(){
                let cat_id = $(this).val()

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('category_dropdown') }}",
                    type: "POST",
                    data: {
                        cat_id : cat_id,
                    },
                    success: function(data){
                        $('#sub_cat_dropdown').html(data)
                    },
                });
            }); 
        });


        $(document).ready(function () {
            $('.add_more').click(function (){
                // alert('hi');
                let new_properties_html =
                `<div class="row new_properties">
                    <div class="col-10">
                        <input type="text" name="option[]" placeholder="Options" class="form-control mb-1">
                    </div>
                    <div class="col-2">
                    <button type="button" class="close remove--new_properties">
                        <span>&times;</span>
                    </button>
                    </div>
                </div>`;
                $('.properties-container').append(new_properties_html);
            });
            $(document).on('click', '.remove--new_properties', function(){
                $(this).closest(".new_properties").remove();
            }); 
        });
        
    </script>

 

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script>

@endsection
 
