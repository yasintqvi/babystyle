@extends('admin.layouts.app', ['title' => 'افزودن منو جدید'])

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div class="nk-block-head col-md-6">
            <div class="nk-block-head-content">
                <h4 class="title nk-block-title">افزودن منو جدید</h4>
            </div>
        </div>
        <div class="nk-block-head-sub mt-1">
            <a class="back-to" href="{{ route('admin.market.menus.index') }}"><em
                    class="icon ni ni-arrow-left"></em><span>بازگشت</span></a>
        </div>
    </div>

    <div class="card">
        <div class="card-inner">

            <form action="{{ route('admin.market.menus.store') }}" method="post" id="category-form"
                enctype="multipart/form-data" id="form" class="form-validate" novalidate="novalidate">
                @csrf
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#general">
                            <em class="icon ni ni-property"></em>
                            <span>موارد عمومی</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#seo">
                            <em class="icon ni ni-trend-up"></em>
                            <span>آدرس و سئو</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="general">
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="title">عنوان <span
                                            class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" value="{{ old('title') }}" class="form-control invalid"
                                            id="title" name="title">
                                    </div>
                                    @error('title')
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
                                    <label class="form-label" for="fv-full-name">وضعیت</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-control custom-control-lg custom-switch">
                                            <input type="checkbox" checked name="is_active" value="1"
                                                class="custom-control-input" id="is_active">
                                            <label class="custom-control-label" for="is_active">فعال</label>
                                        </div>
                                    </div>
                                    @error('is_active')
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
                                    <label class="form-label" for="fv-full-name">آدرس</label>
                                    <div class="form-control-wrap" style="position: relative">
                                        <input type="text"  class="form-control form-control-lg" style="direction:ltr" placeholder="{{ request()->getSchemeAndHttpHost() }}">
                                        <button class="btn btn-primary m-1" style="position:absolute; top:0; bottom:0">جستجو</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="seo">
                        <p>بزار ببینیم چیکار میتونیم بکنیم</p>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">ذخیره اطلاعات</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const addAttributeInput = () => {
            const attributeListElement = document.querySelector('#attribute-list');
            const inputId = attributeListElement.children.length;
            const newAttrElement = `
            <div class="form-group">
                <label class="form-label" for="input-${inputId}">نام ویژگی</label>
                <div class="form-control-wrap">
                    <input type="text" name="variations[${inputId}][name]" class="form-control variation-input" id="input-${inputId}">
                    <input type="checkbox" name="variations[${inputId}][is_color]" value="1" class="form-check-input" id="check-${inputId}">
                    <label class="form-label small text-mute" for="check-${inputId}">همراه با ورودی رنگ</label>
                </div>
            </div>
            `;

            const parentAttributeElement = document.createElement('div');
            parentAttributeElement.classList.add('col-md-3')
            parentAttributeElement.innerHTML = newAttrElement;

            attributeListElement.appendChild(parentAttributeElement);

            document.querySelector(`#input-${inputId}`).focus();
        }

        const categroyForm = document.querySelector('#category-form');

        categroyForm.addEventListener('submit', e => {
            e.preventDefault();
            const attributes = document.querySelectorAll('.variation-input');
            attributes.forEach(attribute => {
                if (attribute.value.trim() == "") {
                    const inputContainer = attribute.closest('.form-group').remove();
                }
            });

            categroyForm.submit();
        });
    </script>
@endsection
