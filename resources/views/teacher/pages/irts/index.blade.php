@extends('../teacher.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <h2 class="intro-y text-lg font-medium mt-10">{{ $page_title }} талбар</h2>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            @if (!$students) 
                <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-17 text-theme-11">
                    <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Мэдээлэл алга байна!
                </div>
            @else
                <form class="validate-form-teacher" action="{{ route('teacher-irts-save') }}" method="post" enctype="multipart/form-data">
                    <table id="table" class="table table-report mt-2">
                        <thead>
                            <tr>
                                <td>Оюутны нэр</td>
                                <td>Хичээлд суусан эсэх</td>
                                <td>Явцын дүн</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>
                                    {{ $student->ovog }} - {{ $student->ner }}
                                </td>
                                <td>
                                    <input type="text" name="data->irts" value="0" class="input w-full border mt-2" />
                                </td>
                                <td>
                                    <input type="text" name="" value="0" class="input w-full border mt-2" />
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-end mt-4">
                        <button type="submit" name="action" value="save" class="button w-40 bg-theme-1 text-white ml-5">{{ __('site.save') }}</button>
                    </div>
                </form>
                
            @endif
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection
