@extends('admin.layouts.app', ['title' => 'ویرایش دسته '])

@section('content')
    {{-- help modal --}}
    <div class="modal fade zoom" tabindex="-1" id="modalZoom">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">راهنما</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="بستن">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>
                        ویژگی هایی که منجر به تنوع یا اختلاف این دسته از محصولات می شوند را انتخاب کنید برای مثال ویژگی رنگ
                        میتواند روی قیمت و موجودی یک محصول تاثیر بگذارد.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-inner">

            <form action="{{ route('admin.market.categories.update', $category->id) }}" method="post"
                enctype="multipart/form-data" class="form-validate" id="category-form" novalidate="novalidate">
                @csrf
                @method('PUT')
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#general">
                            <em class="icon ni ni-property"></em>
                            <span>موارد عمومی</span>
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
                                        <input type="text" value="{{ old('title', $category->title) }}"
                                            class="form-control invalid" id="title" name="title">
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
                                            <input type="checkbox" name="is_active" value="1"
                                                class="custom-control-input" @checked(old('is_active', $category->is_active)) id="is_active">
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

                            <div class="form-group ">
                                <label class="form-label" for="fv-full-name">انتخاب ویژگی ها</label>
                                <a href="javascript:void(0)" class="d-block" data-bs-toggle="modal"
                                    data-bs-target="#modalZoom">
                                    <small><em class="icon ni ni-question"></em>
                                        راهنما</small>
                                </a>
                                <div>
                                    <button type="button" class="btn btn-sm btn-success my-2" onclick="addAttributeInput()" >
                                        ویژگی جدید
                                    </button>
                                </div>
                                <div class="row g-4 mt-2" id="attribute-list">
                                    @php
                                        $variations = $category->variations->map(function ($item) {
                                            return ['id' => $item['id'] ,'name' => $item['name'], 'is_color' => $item['is_color']];
                                        });
                                    @endphp
                                    @foreach (old('variations', $variations) as $key => $variation)
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="input-{{ $key }}">نام ویژگی</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control variation-input"
                                                        name="variations[{{ $key }}][name]"
                                                        value="{{ $variation['name'] }}" id="input-{{ $key }}">
                                                    <input type="checkbox" name="variations[{{ $key }}][is_color]"
                                                        value="1" @checked($variation['is_color'] ?? false) class="form-check-input"
                                                        id="check-{{ $key }}">
                                                    <label class="form-label small text-mute"
                                                        for="check-{{ $key }}">همراه
                                                        با ورودی رنگ</label>
                                                    @if (isset($variation['id']))
                                                    <input type="hidden" name="variations[{{ $key }}][variation_id]" value="{{ $variation['id'] }}">
                                                    @endempty
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
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
