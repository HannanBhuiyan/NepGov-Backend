@extends('layouts.backend.backend-app')

@section('links')
    
@endsection
@section('content')
<style>
    .groupBtn{
        width: 120px; 
    }
    .close_btn{
        width: 120px;
        position: absolute;
        bottom: 10px;
        right: 20px;
    }
</style>
<div class="row mt-5">
    <div class="col-md-12 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active">Users</li>  
            </ol>
        </nav>
        
        <form action="{{route('assign_users_group')}}" method="POST">
            @csrf
            <div class="card p-5 mt-4"> 
                <div class="category_title my-3 d-flex justify-content-between">
                   <div class="left">
                        <h3>Users List</h3>
                        <div id="down_btn"></div>
                   </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable" >
                        <thead>
                          <tr>
                            <th scope="col">SL NO</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Political Support</th>
                            <th scope="col">Ethnicity</th>
                            <th scope="col">Qualification</th>
                            <th scope="col">Age</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            @php
                                $user_infos = App\Models\SurvayAnswer::where('user_id', $user->id)->first();
                            @endphp
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td >
                                    <input id="userCheck-{{$user->id}}" type="checkbox" name="check[]" value="{{ $user->id }}">
                                    <label for="userCheck-{{$user->id}}" style="cursor: pointer">
                                    @if ($user->first_name || $user->last_name )
                                        {{ $user->first_name }} {{ $user->last_name}}
                                    @else
                                      {{ "N/A" }}
                                    @endif
                                    </label>
                                </td>
                                <td>{{ $user->email ?? '' }}</td>
                                <td>{{ Str::headline($user_infos->which_political_party_do_you_support ?? 'N/A') }}</td>
                                <td>{{ Str::headline($user_infos->what_is_your_ethnicity ?? 'N/A') }}</td>
                                <td>{{ Str::headline($user_infos->highest_educational_qualification_you_have ?? 'N/A') }}</td>
                                <td>
                                    @if ($user->date_of_birth)
                                        {{ date("Y") - $user->date_of_birth }} Yesrs
                                    @else
                                        N/A
                                    @endif
                                </td>
                                
                                <td>
                                    {{-- <a data-bs-toggle="modal" data-bs-target="#modalassign8__{{$user->id}}" class="btn btn-info">Assign Role</a> --}}
                                    @can('user edit')
                                    <a href="{{route('admin_edit_user', $user->id) }}" class="btn btn-info">Edit</a>
                                    @endcan
                                    @can('user view')
                                    <a href="{{route('admin_view_user', $user->id) }}" class="btn btn-primary">View</a>
                                    @endcan
                                    @can('user delete')
                                    <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modaldemo8__{{$user->id}}">Delete</a>
                                    @endcan
                                </td>
                            </tr> 
        
                            <!-- MODAL EFFECTS -->
                            <div class="modal fade" id="modaldemo8__{{$user->id}}">
                              <div class="modal-dialog modal-dialog-centered text-center" role="document">
                                  <div class="modal-content modal-content-demo">
                                      <div class="card-body text-center">
                                          <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="60" width="60" viewBox="0 0 24 24"><path fill="#f07f8f" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z"/><circle cx="12" cy="17" r="1" fill="#e62a45"/><path fill="#e62a45" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z"/></svg></span>
                                          <h4 class="h4 mb-0 mt-3">Warning</h4>
                                          <p class="card-text">Are you sure you want to delete data?</p>
                                          <strong class="card-text text-red">Once deleted, you will not be able to recover this data!</strong>
                                      </div>
                                      <div class="card-footer text-center border-0 pt-0">
                                          <div class="row">
                                              <div class="text-center pt-3">
                                                  <a href="javascript:void(0)" class="btn btn-dark me-2" data-bs-dismiss="modal">Cancel</a>
                                                  <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger">Delete</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
    
                          
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    @can('user group assign')
                    <button type="button" class="btn btn-success groupBtn m-3" data-bs-toggle="modal" data-bs-target="#modaldForGroup">Assign Group</button>
                    @endcan
                    @can('user group create')
                    <button type="button" class="btn btn-info groupBtn m-3" data-bs-toggle="modal" data-bs-target="#modaldAssign">Create Group</button>
                    @endcan
                </div>
                
                {{-- assign group modal --}}
                <div class="modal fade" id="modaldForGroup">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="card-body">
                               <div class="assign">
                                    <h4 class="h4 mt-4 mb-3">Assign Group</h4>
                                    <select name="group_id" class="form-control">
                                        <option disabled selected value>--Select Group--</option>
                                        @foreach ($user_groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                        @endforeach    
                                    </select>
                               </div>
                               <div class="category">
                                    <h4 class="h4 mt-4 mb-3">Select Category</h4>
                                    <select name="category_id" class="form-control">
                                        <option disabled selected value>--Select Group--</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach    
                                    </select>
                               </div>
                            </div>
                            
                            <div class="card-footer border-0 pt-0">
                                <div class="row">
                                    <div class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-danger me-2" data-bs-dismiss="modal">Cancel</a>
                                        <button class="btn btn-success" type="submit">Assign</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>
</div>

{{-- create group --}}
@push('modals')
    <form action="{{route('create_new_group')}}" method="post">
        @csrf
        <div class="modal fade" id="modaldAssign">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="card-body">
                        <h4 class="h4 mb-0 m-3">Groupe Name</h4>
                        <input type="text" name="group_name" class="form-control" placeholder="Group Name">
                    </div>
                    <div class="card-footer text-center border-0 pt-0">
                        <div class="row">
                            <div class="text-center">
                                <a href="javascript:void(0)" class="btn btn-danger me-2" data-bs-dismiss="modal">Cancel</a>
                                <button class="btn btn-success" type="submit">Create Group</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
@endpush

@endsection

@section('scripts')

@endsection
