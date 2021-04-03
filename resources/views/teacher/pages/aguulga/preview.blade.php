@extends('../teacher.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y news p-5 box mt-8">
        <!-- BEGIN: Blog Layout -->
        <h2 class="intro-y font-medium text-xl sm:text-2xl">
            {{ $aguulga->sedev }}
        </h2>
        <div class="intro-y text-gray-700 dark:text-gray-600 mt-3 text-xs sm:text-sm"> 
            {{ $aguulga->created_at }} 
            <span class="mx-1">•</span> 
            <a class="text-theme-1 dark:text-theme-10" href="">Агуулгын жагсаалтруу буцах</a> 
        </div>
        
        <div class="intro-y flex relative pt-16 sm:pt-6 items-center pb-6">
            <div class="absolute sm:relative -mt-12 sm:mt-0 w-full flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm">
                <div class="intro-x mr-1 sm:mr-3"> Үлдээсэн сэтгэдэл: <span class="font-medium">{{ count($comments) }}</span> </div>
                <div class="intro-x mr-1 sm:mr-3"> Үзсэн тоо: <span class="font-medium">{{ $aguulga->uzsen }}</span> </div>
            </div>
        </div>
        <div class="intro-y text-justify leading-relaxed">
            {!! $aguulga->aguulga !!}
        </div>

        <!-- END: Blog Layout -->
        <!-- BEGIN: Comments -->
        <div class="intro-y mt-5 pt-5 border-t border-gray-200 dark:border-dark-5">
            <div class="text-base sm:text-lg font-medium">{{ count($comments) }} сэтгэгдэл</div>
            <div class="news__input relative mt-5">
                <form method="POST" action="{{ route('teacher-aguulga-preview', $aguulga->id) }}">
                    
                    <i data-feather="message-circle" class="w-5 h-5 absolute my-auto inset-y-0 ml-6 left-0 text-gray-600"></i> 
                    <textarea class="input w-full bg-gray-200 pl-16 py-6 placeholder-theme-13 resize-none" rows="1" 
                        placeholder="Сэтгэгдэл үлдээх..."></textarea>
                    <div class="flex justify-end mt-4">
                        <button type="submit" name="action" value="Илгээх" class="button w-40 bg-theme-1 text-white ml-5">{{ __('site.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="intro-y mt-5 pb-10">
            @foreach($comments as $comment)
                <div class="mt-5 pt-5 border-t border-gray-200 dark:border-dark-5">
                    <div class="flex">
                        <div class="ml-3 flex-1">
                            <div class="flex items-center"> <a href="" class="font-medium">{{ $comment->name }}}</a></div>
                            <div class="text-gray-600 text-xs sm:text-sm">{{ $comment->created_at }}</div>
                            <div class="mt-2">
                                {{ $comment->comment }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
        <!-- END: Comments -->
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection
