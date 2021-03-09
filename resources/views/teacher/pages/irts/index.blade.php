@extends('../teacher.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif

    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Ирц, явцын дүн</h2>
    </div>
    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <div class="sm:flex items-center sm:mr-4">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Орох анги</label>

                    <select class="input w-full sm:w-32 xxl:w-full mt-2 sm:mt-0 sm:w-auto border" name="aid">
                        <option value="">--Сонгох--</option>
                        @foreach ($angis as angi)
                            <option value="{{ $angi->id }}">{{ $angi->tovch }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-2 xl:mt-0">
                    <button type="button" class="button w-full sm:w-28 bg-theme-1 text-white" id="tabulator-html-filter-go">Хайлт хийх</button>
                </div>
        </div>

        @if (!$students)
            <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-17 text-theme-11">
                <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Анги сонгоогүй байна!
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
    <!-- END: HTML Table Data -->
@endsection

@section('style')
@endsection

@section('script')
@endsection
