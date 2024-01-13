@extends('app.layouts.app', ['title' => 'نظرات'])

@section('content')

<section>
    <div class="container flex flex-wrap py-5">
    @include('app.profile.partials.aside')
      <div class="md:w-3/4 w-full md:pr-2 space-y-4">
        <div class="border rounded-lg py-5 shadow md:block">
          <div class="flex justify-between px-5">
            <div class="flex gap-2 items-center pb-4">
              <!-- back arrow -->
              <a href="#" class="md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path>
                </svg>
              </a>
              <h3 class="font-medium">دیدگاه‌ها</h3>
            </div>
          </div>

          <div class="">
            <div class="flex border-b gap-3 md:mt-2 mt-5 px-5 overflow-auto">
              <button class="w-max flex gap-1 text-sm font-medium p-1 px-3 border-b-4 rounded border-red-500">
                <span class="w-max"> در انتظار ثبت نظر </span>
                <span class="flex items-center justify-center bg-red-500 p-1 text-white aspect-square h-5 text-sm rounded">{{ count($comments->where('is_approved', 0)) }}</span>
              </button>
            </div>
            <div class="flex flex-col my-3 divide-y">
             @forelse ($comments as $comment)
             <div class="flex gap-3 border-gray-300 p-5">
              <div class="">
                <img src="{{ asset($comment->product->primary_image) }}" class="w-14 aspect-square object-cover rounded-md" alt="">
              </div>
              <div class="w-full">
                <div class="flex items-center justify-between w-full mt-2 mb-4">
                  <span class="font-medium">{{ $comment->product->title }}</span>
                  <div class="flex gap-3">
                    @if($comment->is_approved)
                    <div class="flex items-center rounded-md bg-green-200 border text-green-600 px-2 text-xs">
                        تایید شده
                    </div>
                @else
                    <div class="flex items-center rounded-md bg-red-200 border text-red-600 px-2 text-xs">
                        تایید نشده
                    </div>
                @endif
                  <div class="relative">
                      <!--  addressUDContainer means adress update reade container  -->
                      <div class="addressUDContainer absolute left-1/2 bg-white w-52 border rounded-md divide-y hidden">
                        <div class="relative flex gap-2 px-2 py-3 text-sm">
                          <button class="openUpdateCommentBTN absolute top-0 left-0 w-full h-full"></button>
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"></path>
                          </svg>
                          <div class="UpdateCommentCountainer fixed flex items-center justify-center w-full h-full top-0 left-0 z-40 bg-black bg-opacity-20 hidden">
                            <div class="md:w-1/3 sm:w-2/3 w-full bg-white p-4 rounded-md m-3">
                              <div class="flex justify-between mb-4">
                                <span class="text-base font-medium text-black">دیدگاه شما
                                </span>
                                <div class="relative">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                  </svg>
                                  <button class="closeNewCommentBTN absolute w-full h-full top-0 left-0"></button>
                                </div>
                              </div>
                              <form action="" class="flex flex-wrap text-gray-600">
                                <div class="w-full p-2">
                                  <label for="" class="block my-1">
                                    امتیاز دهید:
                                    <span class="ratingSpan"></span>
                                  </label>
                                  <input value="0" type="range" max="5" name="" id="" class="ratingInput w-full outline-none border rounded-md p-1 z-10">
                                </div>

                                <div class="w-full p-2">
                                  <label for="" class="block my-1">عنوان نظر</label>
                                  <input type="text" name="" id="" class="w-full outline-none border rounded-md p-1">
                                </div>

                                <div class="flex flex-col w-full p-2">
                                  <label for="" class="block my-1">
                                    متن نظر
                                  </label>
                                  <textarea name="" id="" cols="30" rows="10" class="h-20 outline-0 border rounded-md p-1"></textarea>
                                </div>
                                <div class="sticky bottom-0 w-full">
                                  <button class="openNewCommentBTN w-full py-2 text-white bg-red-600 rounded-md">
                                    ثبت دیدگاه و امتیاز
                                  </button>
                                </div>
                              </form>
                            </div>
                          </div>
                          <span class="w-max">ویرایش دیدگاه‌</span>
                        </div>
                        <a href="#" class="flex gap-2 px-2 py-3 text-sm">
                          <svg class="w-3 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                            <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                          </svg>
                          <span class="w-max">حذف دیدگاه‌</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <p class="text-justify text-gray-500 font-light leading-relaxed mt-4">
                  {{ $comment->description }}
                </p>
              </div>
            </div>
             @empty
             
             <div class="text-center">
              <p>هنوز نظری ثبت نکردید</p>
             </div>

             @endforelse
              
              <div class="my-4">
                  {{ $comments->render('pagination::tailwind') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
