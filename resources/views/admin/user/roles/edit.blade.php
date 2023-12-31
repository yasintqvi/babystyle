@extends('admin.layouts.app', ['title' => 'ویرایش نقش'])

@section('content')
    <ul class="breadcrumb breadcrumb-arrow">
        <li class="breadcrumb-item"><a href="#">صفحه اصلی</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.user.roles.index') }}">نقش ها</a></li>
        <li class="breadcrumb-item active">ویرایش نقش </li>
    </ul>

    <!-- .nk-block-head-content -->
    <div class="nk-block-between mb-4 mt-2">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">ایجاد نقش </h3>
        </div>
        <!-- .nk-block-head-content -->
        <a href="{{ route('admin.user.roles.index') }}" class="btn btn-success">بازگشت</a>
        <!-- .nk-block-head-content -->
    </div>



    <div class="nk-block">
        <form class="row g-gs" action="{{ route('admin.user.roles.update' , $role->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <!-- .col -->
            <div class="col-lg-12 col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-inner">
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="fv-first-name">نام نقش :</label>
                                    <div class="form-control-wrap">
                                        <input type="text" placeholder="مثال : نویسنده" class="form-control" id="fv-first-name" name="name"
                                            value="{{ old('name' , $role->name) }}">
                                    </div>
                                    @error('name')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="fv-last-name">توضیحات نقش:</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="fv-last-name" name="description"
                                            value="{{ old('description',$role->description) }}">
                                    </div>
                                    @error('description')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            @php
                                $permissionsAraay = $role->permissions->pluck('id')->toArray();
                            @endphp
                            <div class="align-center flex-wrap mb-4">
                                @foreach($permissions as $permission)
                                    <div class="g col-md-2 mt-2 ">
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input type="checkbox" @if(in_array($permission->id, $permissionsAraay)) checked @endif class="custom-control-input" value="{{ $permission->id}}" name="permissions[]" id="{{ $permission->id }}">
                                            <label class="custom-control-label" for="{{ $permission->id }}">{{ $permission->key }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-md-6 justify-content-start">
                                <div class="form-group d-flex ">
                                    <button type="submit" class="btn btn-lg btn-primary">ذخیره اطلاعات</button>
                                </div>
                            </div>

                        </div>


                    </div>
                    <!-- .card-inner -->

                </div>
                <!-- .card -->
                <div style="display: none;" id="myDiv" class="card">
                    <div class="card-inner">
                        یشس
                    </div>
                </div>

            </div>
            <!-- .col -->
        </form>
        <!-- .row -->
    </div>

@endsection


