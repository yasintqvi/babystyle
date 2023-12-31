@extends('admin.layouts.app', ['title' => 'کامنت ها'])

@section('content')
    <ul class="breadcrumb breadcrumb-arrow">
        <li class="breadcrumb-item"><a href="#">صفحه اصلی</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.market.comments.index') }}">کامنت ها</a></li>
        <li class="breadcrumb-item active">نمایش کامنت</li>
    </ul>

    <!-- .nk-block-head-content -->
    <div class="nk-block-between mb-4 mt-2">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">نمایش کامنت</h3>
        </div>
        <!-- .nk-block-head-content -->
        <a href="{{ route('admin.market.comments.index') }}" class="btn btn-success">بازگشت</a>

        <!-- .nk-block-head-content -->
    </div>



    <div class="card">
        <div class="card-inner">
            <form action="#" method="post" enctype="multipart/form-data"
                id="form" class="form-validate" novalidate="novalidate">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">نام کاربر</label>
                            <div class="form-control-wrap">
                                <input type="text" disabled class="form-control" id="fv-full-name" name="question"
                                    value="{{ $comment->user->full_name }}">
                            </div>
                
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">نام محصول</label>
                            <div class="form-control-wrap">
                                <input type="text" disabled class="form-control" id="fv-full-name" name="question"
                                    value="">
                            </div>
                
                        </div>
                    </div>
                    

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">وضعیت</label>
                            <div class="form-control-wrap">
                                <input type="text" disabled class="form-control" id="fv-full-name" name="question"
                                    value="{{ $comment->is_approved }}">
                            </div>
                
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label" for="fv-full-name">تاریخ ایجاد</label>
                            <div class="form-control-wrap">
                                <input type="text" disabled class="form-control" id="fv-full-name" name="question"
                                    value="{{ $comment->getCreateAtShamsi() }}">
                            </div>
                
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-textarea">متن کامنت</label>
                        <div class="form-control-wrap">
                            <textarea class="form-control no-resize" disabled id="default-textarea">{{ $comment->description }}</textarea>
                        </div>
                    </div>

                    
                    <div class="col-md-12">
                        <div class="form-group">
                            @if ($comment->getRawOriginal('is_approved'))
                            <a href="{{ route('admin.market.comments.change-approved' , $comment->id) }}" type="submit" class="btn btn-danger">عدم تایید</a>
                                @else
                            <a href="{{ route('admin.market.comments.change-approved' , $comment->id) }}" type="submit" class="btn btn-success">تایید</a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
