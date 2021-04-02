@extends('../teacher.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mt-10">{{ $page_title }} талбар</h2>
    </div>
    @if($daalgavar == null)
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-17 text-theme-11">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Мэдээлэл ороогүй байна!
        </div>
    @else
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="box">
                    {{ $daalgavar->aguulga }}
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="box">
                    <iframe src="/teacher/{{ $daalgavar->fileUrl }}" style="width: 100%; min-height: 600px;" ></iframe>
                </div>
            </div>
        </div>
    @endif

    
@endsection

@section('style')
@endsection

@section('script')
@endsection
