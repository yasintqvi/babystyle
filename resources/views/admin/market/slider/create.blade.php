@extends('admin.layouts.app', ['title' => 'ایجاد اسلایدر'])

@section('content')

<ul class="breadcrumb breadcrumb-arrow">
    <li class="breadcrumb-item"><a href="#">صفحه اصلی</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.market.sliders.index')}}">اسلایدر</a></li>
    <li class="breadcrumb-item active">ایحاد اسلایدر </li>
</ul>

     <!-- .nk-block-head-content -->
            <div class="nk-block-between mb-4 mt-2">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">ایجاد اسلایدر </h3>
                </div>
                <!-- .nk-block-head-content -->
                <a href="{{ route('admin.market.sliders.index') }}" class="btn btn-success">بازگشت</a>

                <!-- .nk-block-head-content -->
            </div>



<div class="card">
    <div class="card-inner">
        <form action="{{ route('admin.market.sliders.store')}}" method="post" enctype="multipart/form-data" id="form" class="form-validate" novalidate="novalidate">
            @csrf
            <div class="row g-gs">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="fv-full-name">alt تصویر</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="fv-full-name" name="alt" value="{{ old('alt') }}">
                        </div>
                        @error('alt')
                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                            <strong>
                              {{ $message }}
                            </strong>
                        </span>
                    @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="form-label" for="fv-full-name">آدرس اسلایدر</label>
                        <div class="form-control-wrap">
                            <input type="text" value="{{ old('url', request('url') ?? URL::to('/')) }}" class="form-control" id="fv-full-name" name="url" >
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="form-label" for="customFileLabel">تصویر اسلایدر</label>
                    <div class="form-control-wrap">
                        <div class="form-file">
                            <input type="file" name="image" class="form-file-input" id="customFile">
                            <label class="form-file-label" for="customFile">انتخاب عکس</label>
                        </div>
                        @error('image')
                            <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                <strong>
                                  {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="form-label" for="is_active">وضعیت</label>
                    <div class="form-control-wrap" >
                        <select class="form-select js-select2 select2-hidden-accessible" id="is_active"  name="is_active">
                            <option value="1" @if(old('is_active') == 1) selected @endif>فعال</option>
                            <option value="0" @if(old('is_active') == 0) selected @endif>غیر فعال</option>
                        </select>
                    </div>
                </div>

             

                                                                
                                                                
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">ذخیره اطلاعات</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
