@extends('layouts.backend.backend-app')

@section('content')
 
<div class="row mt-5">
    <div class="col-md-12 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active">Templates</li> 
            </ol>
          </nav>
        <div class="card p-3 mt-4"> 
            <div class="category_title my-3 d-flex justify-content-between">
               <div class="left">
                    <h3>Templates</h3>
               </div>
              
            </div>
           <div class="table-responsive">
            <table class="text-center table table-bordered table-fixed border-bottom">
                <thead>
                  <tr>
                    <th scope="col">SL NO</th>
                    <th scope="col">Template</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><h4>Verify Registration Template</h4></td>
                        <td> 
                            <a href="{{route('verify_register_edit')}}" class="btn btn-success">Edit</a>
                            <a href="{{route('verify_registration_view')}}" class="btn btn-info">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><h4>User Survay Template</h4></td>
                        <td> 
                            <a href="{{route('user_survay_edit')}}" class="btn btn-success">Edit</a>
                            <a href="{{route('user_survay_view')}}" class="btn btn-info">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><h4>Forget Password Template</h4></td>
                        <td> 
                            <a href="{{route('forget_password_edit')}}" class="btn btn-success">Edit</a>
                            <a href="{{route('forget_password_view')}}" class="btn btn-info">View</a>
                        </td>
                    </tr>
                </tbody>
            </table>
           </div>
        </div>
    </div>
</div>





@endsection


