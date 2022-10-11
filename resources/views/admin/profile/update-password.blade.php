@extends('admin.layout.layout', [
   'prev'=> url()->previous()
])

@section('title','Update Password')

@section('content')
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">

                    <div class="card-body overflow-auto" style="max-height: 600px">
                        <form method="POST" action="{{route('admin.update-password')}}" class="ajaxform"  >
                          @csrf
                            <div class="form-group">
                                <label for="password" class="required">Admin Email</label>
                                <input type="text" disabled class="form-control" value="{{$adminDetails['email']}}" readonly  >
                            </div>
                            <div class="form-group">
                                <label for="password" class="required">Admin Type</label>
                                <input type="text" disabled class="form-control" value="{{$adminDetails['type']}}"  readonly >
                            </div>
                            <div class="form-group">
                                <label for="current_password" class="required">Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="form-control" min="8" placeholder="Enter Current Password" required="" >
                                <span id="chkCurrentPassword"></span>
                            </div>
                            <div class="form-group">
                                <label for="new_password" class="required">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control" min="8" placeholder="Enter New Password" required="" >
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" class="required">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" min="8" placeholder="Enter Confirm Password" required="" >
                            </div>



                            <div class="form-group">
                                <button class="btn btn-primary float-right basic-btn"  >
                                    <i class="fas fa-save"> </i>
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
