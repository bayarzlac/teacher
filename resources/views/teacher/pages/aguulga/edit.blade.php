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
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form class="validate-form-teacher" action="{{ route('teacher-aguulga-update', $aguulga->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="f_id" value="{{ $aguulga->f_id }}" />
                <div class="intro-y box p-5">
                    <div class="input-form">
                        <label class="flex flex-col sm:flex-row">
                            Хичээлийн сэдэв: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                        </label>
                        <input type="text" name="sedev" placeholder="Сэдэв бичих" class="input w-full border mt-2" minlength="2" 
                            required data-pristine-minlength-message="2 тэмдэгдээс дээш байх ёстой" 
                            data-pristine-required-message="Гарчиг хоосон байж болохгүй" 
                            value="{{ $aguulga->sedev }}" />
                    </div>
                    <div class="input-form">
                        <label class="flex flex-col sm:flex-row">
                            Товч тайлбар: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                        </label>
                        <textarea name="tailbar" class="input w-full border mt-2">{{ $aguulga->tailbar }}</textarea>
                    </div>

                    <div class="input-form">
                        <label class="flex flex-col sm:flex-row">
                            Хичээлийн агуулга: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                        </label>
                        <textarea name="aguulga" class="input w-full border mt-2">{{ $aguulga->aguulga }}</textarea>
                    </div>

                    <div class="input-form">
                        <div class="dropzone border-gray-200 border-dashed">
                            <div class="fallback">
                                <input name="file" type="file" />
                            </div>
                            <div class="dz-message" data-dz-message>
                                <div class="text-lg font-medium">Drop files here or click to upload.</div>
                                <div class="text-gray-600"> This is just a demo dropzone. Selected files are <span class="font-medium">not</span> actually uploaded. </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="window.location.href='{{ route('teacher-aguulga', [request()->route('id')]) }}'" class="button w-40 bg-theme-6 text-white ml-5">{{ __('site.cancel') }}</button> 
                        <button type="submit" name="action" value="save" class="button w-40 bg-theme-1 text-white ml-5">{{ __('site.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection