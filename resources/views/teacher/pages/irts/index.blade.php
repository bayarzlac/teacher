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
        <form action="{{ route('teacher-irts') }}" method="get">
            <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                <div class="sm:flex items-center sm:mr-4">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Орох анги</label>
                    <select class="input w-full sm:w-32 xxl:w-full mt-2 sm:mt-0 sm:w-auto border" name="a_id">
                        <option value="">--Сонгох--</option>
                        @foreach($angis as $angi)
                            @if (app('request')->input('a_id') == $angi->id)
                                <option value="{{ $angi->id }}" selected>{{ $angi->tovch }}{{ $angi->course }}{{ $angi->buleg }}</option>    
                            @else
                                <option value="{{ $angi->id }}">{{ $angi->tovch }}{{ $angi->course }}{{ $angi->buleg }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="relative w-56 mx-auto">
                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4"> 
                        <i data-feather="calendar" class="w-4 h-4"></i> 
                    </div>
                    <!--<input type="text" name="day" class="input w-full border mt-2" placeholder="YYYY-MM-DD" required  />-->

                    @if (request()->get('day'))
                        <input type="text" class="datepicker input pl-12 border" data-single-mode="true" name="day" value="{{ request()->get('day') }}" />
                    @else 
                        <input type="text" class="datepicker input pl-12 border" data-single-mode="true" name="day" />
                    @endif
                </div>
                <div class="mt-2 xl:mt-0">
                    <button type="submit" class="button w-full sm:w-28 bg-theme-1 text-white">Хайлт хийх</button>
                </div>
            </div>
        </form>
        

        @if (!count($irts))
            <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-17 text-theme-11">
                <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Анги сонгоогүй эсвэл сонгосон ангид оюутан бүртгэгдээгүй!
            </div>
        @else
            <form class="validate-form-teacher" action="{{ route('teacher-irts-save') }}" method="post" enctype="multipart/form-data">
                @csrf
                <table id="table" class="table table-report mt-2">
                    <thead>
                        <tr>
                            <td>№</td>
                            <td>Оюутны нэр</td>
                            <td>Хичээлд суусан эсэх</td>
                            <td>Явцын дүн</td>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($irts); $i++)
                            <tr>
                                <td>
                                    {{ $i + 1 }}
                                </td>    
                                <td>
                                    {{ Str::substr($irts[$i]->ovog, 0, 3) }}.{{ $irts[$i]->ner }}
                                    <input type="text" name="s_id[{{ $i }}]" value="{{ $irts[$i]->id }}" />
                                </td>

                                <td>
                                    <div class="flex flex-col sm:flex-row mt-2">
                                        <div class="flex items-center text-gray-700 dark:text-gray-500 mr-2"> 
                                            <label class="cursor-pointer select-none">
                                                @if ($irts[$i]->status == 1)
                                                    <input type="radio" class="input border mr-2" name="status[{{ $i }}]" value="1" checked />
                                                @else
                                                    <input type="radio" class="input border mr-2" name="status[{{ $i }}]" value="1" />
                                                @endif
                                                Ирсэн
                                            </label>
                                        </div>
                                        <div class="flex items-center text-gray-700 dark:text-gray-500 mr-2 mt-2 sm:mt-0">
                                            <label class="cursor-pointer select-none">
                                                @if ($irts[$i]->status == 2)
                                                    <input type="radio" class="input border mr-2" name="status[{{ $i }}]" value="2" checked />
                                                @else
                                                    <input type="radio" class="input border mr-2" name="status[{{ $i }}]" value="2" />
                                                @endif
                                                Өвч.
                                            </label>
                                        </div>
                                        <div class="flex items-center text-gray-700 dark:text-gray-500 mr-2 mt-2 sm:mt-0">
                                            <label class="cursor-pointer select-none">
                                                @if ($irts[$i]->status == 3)
                                                    <input type="radio" class="input border mr-2" name="status[{{ $i }}]" value="3" checked />
                                                @else
                                                    <input type="radio" class="input border mr-2" name="status[{{ $i }}]" value="3" />
                                                @endif
                                                Чөл.
                                            </label>
                                        </div>
                                        <div class="flex items-center text-gray-700 dark:text-gray-500 mr-2 mt-2 sm:mt-0">
                                            <label class="cursor-pointer select-none">
                                                @if ($irts[$i]->status == 3)
                                                    <input type="radio" class="input border mr-2" name="status[{{ $i }}]" value="4" checked />
                                                @else
                                                    <input type="radio" class="input border mr-2" name="status[{{ $i }}]" value="4" />
                                                @endif
                                                Тас.
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                
                                <td>
                                    <input type="text" name="dun[{{ $i }}]" class="input w-full border mt-2" value="{{ $irts[$i]->dun }}" />
                                </td>
                            </tr>
                        @endfor
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
