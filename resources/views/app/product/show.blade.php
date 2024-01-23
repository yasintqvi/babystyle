@extends('app.layouts.app', ['title' => $product->title])

@section('head-tag')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <section>
        <div class="container flex my-8 gap-8 flex-wrap md:flex-nowrap">
            <div class="md:w-2/5 w-full">
                <div class="md:hidden font-medium text-base text-gray-600">
                    <a class="hover:text-blue-600" href="{{ route('home') }}">صفحه اصلی </a>
                    /
                    <a class="hover:text-blue-600" href="{{ route('products.index') }}">محصولات</a>
                    /
                    <a class="hover:text-blue-600" href="#">{{ $product->category->title }} </a>
                </div>
                <div class="md:hidden py-8">
                    <span class="text-lg font-bold">{{ $product->title }}</span>
                </div>

                <div class="swiper productPageSwiper2 z-0">

                    <div class="flex justify-between absolute top-1/2 -translate-y-1/2 z-20 w-full px-4 items-center">
                        <button type="button"
                            class="productPage-swiper-button-prev rotate-180 md:bg-primary w-10 h-10 py-2 px-2 md:mr-2 mb-2 flex items-center text-xs font-medium focus:outline-none rounded-xl hover:bg-primary focus:z-10 md:focus:ring-2 focus:ring-yellow-600 group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="w-20 h-20 text-yellow-900 md:text-white group-hover:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>

                        <button type="button"
                            class="productPage-swiper-button-next rotate-180 md:bg-primary w-10 h-10 py-2 px-2 md:mr-2 mb-2 flex items-center text-xs font-medium focus:outline-none rounded-xl hover:bg-primary focus:z-10 md:focus:ring-2 focus:ring-yellow-600 group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="w-20 h-20 text-yellow-900 md:text-white group-hover:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>
                    <div class="swiper-wrapper z-0">
                        @foreach ($product->images as $image)
                            <div class="swiper-slide z-0">
                                <img src="{{ asset($image->image) }}"
                                    class="aspect-square w-full h-max object-cover rounded-lg" />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div thumbsSlider="" class="swiper productPageSwiper z-0">
                    <div class="swiper-wrapper z-0">
                        @foreach ($product->images as $image)
                            <div class="swiper-slide grayscale">
                                <img src="{{ asset($image->image) }}"
                                    class="w-full h-max aspect-square object-cover rounded-lg my-2" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="md:w-3/5 w-full">
                <div class="hidden md:block font-medium text-base text-gray-600">
                    <a class="hover:text-blue-600" href="{{ route('home') }}">صفحه اصلی </a>
                    /
                    <a class="hover:text-blue-600" href="{{ route('products.index') }}">محصولات </a>
                    /
                    <a class="hover:text-blue-600" href="#">{{ $product->category->title }} </a>
                </div>
                <div class="hidden md:block py-8">
                    <span class="text-xl font-semibold text-gray-700">{{ $product->title }}</span>
                </div>

                @php
                    $options = collect([]);

                    $defaultSelectedOption = collect([]);

                    $product->items->map(function ($item) use ($options, $defaultSelectedOption) {
                        $item->load('variationOptions');
                        $item->variationOptions->map(function ($option) use ($item, $defaultSelectedOption, $options) {
                            if ($item->is_default) {
                                $defaultSelectedOption->push($option->id);
                            }

                            $options->push($option);
                        });
                    });

                    $variations = $options->unique('id')->groupBy('variation_id');
                @endphp
                {{-- if our product had no variation --}}
                <form action="{{ route('shopping-cart.store', $product->id) }}" method="post" id="add_to_cart_form">
                    @csrf
                    <div class="my-3" id="discountZone">
                        <span class="text-gray-500 text-lg tracking-wide line-through mx-2 money" id="oldPrice"></span>
                        <span class="text-danger py-.5 px-2 text-white bg-red-600 rounded-lg font-bold hidden"
                            id="discountRate"></span>
                    </div>
                    @if (collect($variations)->isEmpty())
                        <div class="text-primary text-center md:text-start">
                            @if ($product->quantity > 0)
                                <div>
                                    <span
                                        class="text-3xl font-bold tracking-widest money">{{ $product->items()->first()->price }}</span>
                                    تومان
                                </div>
                            @else
                                <div class="text-3xl font-bold text-red-600">ناموجود</div>
                            @endif
                        </div>
                    @else
                        <div class="text-primary text-center md:text-start">
                            <div id="price" class="text-3xl font-bold"></div>
                            <div class="text-3xl font-bold text-red-600 hidden" id="unavailable">ناموجود</div>
                        </div>


                        @foreach ($variations as $variationId => $options)
                            @php
                                $variation = App\Models\Market\Variation::find($variationId);
                            @endphp
                            <div class="pt-4 font-medium">
                                <span class="text-sm font-bold">{{ $variation->name }} </span>

                                <div class="flex flex-wrap gap-2">

                                    @foreach ($options as $option)
                                        @if ($variation->is_color)
                                            <div
                                                class="relative border shadow aspect-square rounded-full h-10 text-base overflow-hidden p-1 mt-2 {{ $defaultSelectedOption->contains($option->id) ? 'border-gray-500' : '' }}">
                                                <div class="w-full h-full rounded-full"
                                                    style="background: {{ $option->second_value }}"></div>
                                                <input type="radio" name="options[{{ $variation->id }}][option_id]"
                                                    onchange="checkAndGetPrice()" @checked($defaultSelectedOption->contains($option->id))
                                                    value="{{ $option->id }}"
                                                    class="selectColorInput absolute w-full h-full top-0 left-0 opacity-0">
                                            </div>
                                        @else
                                            <div
                                                class="relative border shadow-sm rounded-lg p-2 px-4 my-2 text-base {{ $defaultSelectedOption->contains($option->id) ? 'border-gray-500' : '' }}">
                                                <span> {{ $option->value }} </span>
                                                <input type="radio" name="options[{{ $variation->id }}][option_id]"
                                                    onchange="checkAndGetPrice()" @checked($defaultSelectedOption->contains($option->id))
                                                    value="{{ $option->id }}"
                                                    class="selectSizeInput absolute w-full h-full top-0 left-0 opacity-0">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <button type="submit" id="add_to_cart_btn"
                        class="bg-green-500 px-5 py-3 text-white rounded shadow-lg mt-8 w-full md:w-max flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        <span class="mx-2">افزودن به سبد خرید</span>
                    </button>
                </form>

                @if (collect($product->attributes)->isNotEmpty())
                    <div class="mt-5">
                        <h6 class="text-sm font-bold mb-4">ویژگی ها</h6>
                        <ul class="list-disc space-y-2 list-inside font-light">
                            @foreach ($product->attributes as $attribute)
                                <li class="text-gray-500"><span>{{ $attribute->key }} :</span><span
                                        class="text-gray-800 text-xs mx-2 font-bold">{{ $attribute->value }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- <div class="py-2 pt-6">
                    <p class="text-gray-700">
                        {!! $product->description !!}
                    </p>
                </div> --}}
            </div>
        </div>
        {{-- comments section --}}
        <div class="container">         
            <hr class="border-2 rounded-lg" />
            <div class="py-4 font-medium text-lg">
                <span>امتیاز و دیدگاه کاربران </span>
            </div>
            <div class="flex flex-wrap">
                <div class="md:w-1/4 w-full relative pb-2">
                    <div class="sticky top-0 pl-2 py-2">
                        <div class="">
                            <span class="text-xl font-bold">{{ ceil($product->commentApproved->avg('rate')) }}</span>
                            <span class="text-xs px-1">از 5</span>
                        </div>
                        <div class="flex items-center">

                            <div id="dataReadonlyReview"
                                data-rating-stars="5"   
                                data-rating-readonly="true"
                                data-rating-value="{{ ceil($product->commentApproved->avg('rate')) }}"
                                data-rating-input="#dataReadonlyInput">
                            </div>

                            <span class="text-[11px] px-1"> از مجموع ۵۴ امتیاز </span>
                        </div>
                        <span class="text-sm py-1">شما هم درباره این کالا دیدگاه ثبت کنید</span>

                        <div class="">
                            <button
                                class="openNewCommentBTN w-full border border-red-500 rounded-md text-red-500 py-2 mt-4">
                                ثبت دیدگاه و امتیاز
                            </button>
                            <div
                                class="NewCommentCountainer fixed flex items-center justify-center w-full h-full top-0 left-0 !z-[999] bg-black bg-opacity-20 {{ count($errors) > 0 ? '' : 'hidden'}}">
                                <div class="md:w-1/3 sm:w-2/3 w-full  overflow-y-auto bg-white p-4 rounded-md m-3">
                                    <div class="flex justify-between mb-4">
                                        <span class="text-base font-medium text-black">دیدگاه شما
                                        </span>
                                        <div class="relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12"></path>
                                            </svg>
                                            <button
                                                class="closeNewCommentBTN absolute w-full h-full top-0 left-0"></button>
                                        </div>
                                    </div>
                                    <form action="{{ route('comments.store' , $product->id) }}" method="post" class="flex flex-wrap text-gray-600">
                                        @csrf
                                        <div class="w-full p-2">
                                            <label for="" class="block my-1">
                                                امتیاز دهید:
                                                <span class="ratingSpan">متوسط</span>
                                            </label>
                                            <input value="0" type="range" max="5" name="rate"
                                                id="rangInput"
                                                class="ratingInput w-full outline-none border rounded-md p-1 z-10">
                                        </div>

                                        <div class="flex flex-col w-full p-2">
                                            <label for="" class="block my-1"> متن نظر </label>
                                            <textarea name="description" id="" cols="30" rows="10" class="h-20 outline-0 border rounded-md p-1"
                                                style="height: 93px;"></textarea>
                                                @error('description')
                                                <span class="text-red-500 text-bold text-xs mt-2">{{ $message }}</span>
                                                @endif
                                        </div>
                                        
                                        <div class="sticky bottom-0 w-full">
                                            <button class="openNewCommentBTN w-full py-2 text-white bg-primary rounded-md">
                                                ثبت دیدگاه و امتیاز
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:w-3/4 w-full pr-2">
                    <div class="">
                        <hr class="w-full" />
                        <div class="flex gap-2 py-3 items-start">
                          
                            <div class="w-full">
                                <div class="">
                                    <span class="block font-medium pb-2">{{$product->title}}</span>
                                </div>
                            </div>
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width=".5" stroke="currentColor" class="w-5 fill-yellow-400 stroke-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        class="[clip-path: inset( 0px 0px 0px 90%)]"
                                        d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @foreach ($product->commentApproved as $comment)
                    <div class="">
                        <hr class="w-full" />
                        <div class="flex gap-2 py-3 items-start">
                            <span class="block p-1 px-2 @if($comment->rate >= 0 && $comment->rate <= 1) bg-red-500 @elseif($comment->rate >= 2 && $comment->rate <= 3) bg-yellow-400 @elseif($comment->rate >= 4) bg-green-500 @endif text-white rounded text-xs">
                                {{$comment->rate}}.0
                            </span>
                            <div class="w-full">
                                <div class="flex pb-3">
                                    <div class="flex gap-2">
                                        <span class="text-xs text-gray-400 p-1 px-2">{{ getJalaliTime($comment->created_at) }}</span>
                                        <span class="text-xs text-gray-400 p-1 px-2">{{$comment->user->fullName}}
                                        </span>
                                        {{-- <span
                                            class="text-xs text-green-600 bg-green-100 p-1 px-2 rounded-lg block">خریدار</span> --}}
                                    </div>
                                </div>

                                <div class="">
                                    <hr class="border-gray-100" />
                                    <p class="py-3 text-sm">
                                      {{ $comment->description}}
                                    </p>
                                </div>
                            </div>
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width=".5" stroke="currentColor" class="w-5 fill-yellow-400 stroke-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endforeach 
                   
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/app/js/shoppingCart.js') }}"></script>
    <script src="{{ asset('assets/app/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/app/js/rating.js') }}"></script>

    <script>
        const moneiesElements = document.querySelectorAll('.money');

        [...moneiesElements].map((item) => {
            item.textContent = formatNumber(item.textContent);
        });

        function formatNumber(value) {
            console.log(value);
            const regex = /(\d)(?=(\d{3})+$)/g;
            return value.toString().replace(regex, '$1,');
        }
    </script>

    <script>
        function checkAndGetPrice() {
            const formData = new FormData(addToCartForm);

            const action = "{{ route('products.get-price', $product->id) }}";

            fetch(action, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (data.price) {
                            if (data.discount) {
                                discountZone.classList.remove('hidden');
                                discountRate.classList.remove('hidden');
                                price.innerText = `${formatNumber(data.discount.price)} تومان`;
                                oldPrice.innerText = data.price;
                                discountRate.innerText = `${data.discount.rate} %`;
                                price.classList.remove('hidden');
                                unavailable.classList.add('hidden');
                                addToCartBtn.disabled = false;
                            } else {
                                discountZone.classList.add('hidden');
                                price.innerText = `${formatNumber(data.price)} تومان`;
                                price.classList.remove('hidden');
                                unavailable.classList.add('hidden');
                                addToCartBtn.disabled = false;
                            }
                        } else {
                            discountZone.classList.add('hidden');
                            price.classList.add('hidden');
                            unavailable.classList.remove('hidden');
                            addToCartBtn.disabled = true;
                        }
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        }
    </script>


    @if ($product->category->variations->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                checkAndGetPrice();
            })
        </script>
    @endif

    <script>
        const addToCartForm = document.querySelector('#add_to_cart_form');
        const addToCartBtn = document.querySelector('#add_to_cart_btn');

        document.addEventListener('DOMContentLoaded', function() {

            addToCartForm.addEventListener('submit', (event) => {
                event.preventDefault();
                const shopCart = new ShoppingCart();
                shopCart.addToCart(addToCartForm);
            })
        });
    </script>
@endsection
