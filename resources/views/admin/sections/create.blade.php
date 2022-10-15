@extends('admin.layout.layout',[
    'prev' => route('admin.sections.index')
])

@section('title', 'Add New Section')

@section('content')
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">

                    <div class="card-body overflow-auto" style="max-height: 600px">
                        <form method="POST" action="{{route('admin.sections.store')}}" class="ajaxform_with_reset"  >
                            @csrf
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Name') }} </label>
                                <input type="text"  name="name" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="password" class="required">{{ __('Status') }}</label>
                                <select name="status" class="form-control">
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('Inactive') }}</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <button class="btn btn-primary float-right basic-btn"  >
                                    <i class="fas fa-save"> </i>
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

