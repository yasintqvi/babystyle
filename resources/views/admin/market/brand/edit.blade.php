@extends('admin.layouts.app', ['title' => 'ویرایش برند'])

@section('content')

<ul class="breadcrumb breadcrumb-arrow">
    <li class="breadcrumb-item"><a href="#">صفحه اصلی</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.market.brands.index')}}">برندها</a></li>
    <li class="breadcrumb-item active">ویرایش برند </li>
</ul>
 <!-- .nk-block-head-content -->
 <div class="nk-block-between mb-4 mt-2">
    <div class="nk-block-head-content">
        <h3 class="nk-block-title page-title">برند {{ $brand->persian_name}}</h3>
    </div>
    <!-- .nk-block-head-content -->
    <div class="nk-block-head-content">
        <div class="toggle-wrap nk-block-tools-toggle">
            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
            <div class="toggle-expand-content" data-content="pageMenu">
                <ul class="nk-block-tools g-3">
                    <li class="nk-block-tools-opt">
                        <a href="#" 
                            class="toggle btn btn-icon btn-primary d-md-none"><em
                                class="icon ni ni-plus"></em></a>
                        <a href="{{ route('admin.market.brands.index') }}" type=""
                            class="btn btn-success d-none d-md-inline-flex"><em
                                ></em><span>بازگشت</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- .nk-block-head-content -->
</div>

<div class="card">
    <div class="card-inner">
        <form action="{{ route('admin.market.brands.update' , $brand->id)}}" method="post" enctype="multipart/form-data" id="form" class="form-validate" novalidate="novalidate">
            @csrf
            {{ method_field('put') }}
            <div class="row g-gs">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="fv-full-name">نام فارسی برند</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="fv-full-name" name="persian_name" value="{{old('persian_name' , $brand->persian_name)}}">
                        </div>
                        @error('persian_name')
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
                        <label class="form-label" for="fv-full-name">نام اصلی برند</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="fv-full-name" name="original_name" value="{{old('original_name' , $brand->original_name)}}">
                        </div>
                        @error('original_name')
                            <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                <strong>
                                  {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="form-label" for="customFileLabel">تصویر برند</label>
                    <div class="form-control-wrap">
                        <div class="form-file">
                            <input type="file" name="logo" class="form-file-input" id="customFile">
                            <label class="form-file-label" for="customFile">انتخاب عکس</label>
                        </div>
                        @error('logo')
                            <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                <strong>
                                  {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="form-label" for="customFileLabel">تگ ها</label>
                    <input type="hidden" class="form-control form-control-sm"  name="tags" id="tags" value="{{old('tags' , $brand->original_name ) }}">
                    <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                    </select>
                    @error('tags')
                            <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                <strong>
                                  {{ $message }}
                                </strong>
                            </span>
                        @enderror
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

@section('script')

<script>
    $(document).ready(function () {
        var tags_input = $('#tags');
        var select_tags = $('#select_tags');
        var default_tags = tags_input.val();
        var default_data = null;

        if(tags_input.val() !== null && tags_input.val().length > 0)
        {
            default_data = default_tags.split(',');
        }

        select_tags.select2({
            placeholder : 'لطفا تگ های خود را وارد نمایید',
            tags: true,
            data: default_data,
            dir: 'rtl'
            
        });
        select_tags.children('option').attr('selected', true).trigger('change');
        $('#form').submit(function ( event ){
            if(select_tags.val() !== null && select_tags.val().length > 0){
                var selectedSource = select_tags.val().join(',');
                tags_input.val(selectedSource)
            }
        })
    })
</script>


@endsection