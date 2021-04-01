@extends('../teacher.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <h2 class="intro-y text-lg font-medium mt-10">{{ $page_title }} талбар</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('teacher-aguulga-add', request()->route('id')) }}" 
                class="button text-white bg-theme-1 shadow-md mr-2">{{ $page_title }} нэмэх</a>
        </div>

        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            @if(!count($aguulga))
                <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-17 text-theme-11">
                    <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> Мэдээлэл ороогүй байна!
                </div>
            @else
            <table id="table" class="table table-report mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">Хичээлийн сэдэв</th>
                        <th class="text-center whitespace-nowrap">Товч тайлбар</th>
                        <th class="text-center whitespace-nowrap">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;?>
                    @foreach($aguulga as $item)
                        <?php $i++;?>
                        <tr class="intro-x">
                            <td class="w-10">
                                <div class="flex">
                                    {{ $i }}
                                </div>
                            </td>
                            <td>
                                <a href="" class="font-medium whitespace-nowrap">{{ $item->sedev }}</a>
                            </td>
                            <td class="text-center">
                                {{ $item->tailbar }}
                            </td>
                            <td class="table-report__action w-72">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('aguulga-edit', $item->id) }}">
                                        <i data-feather="edit-2" class="w-4 h-4 mr-1"></i> Засах
                                    </a>
                                    
                                    @if ($item->d_id != null)
                                        <a class="flex items-center mr-3" href="{{ route('teacher-daalgavar', $item->d_id) }}">
                                            <i data-feather="home" class="w-4 h-4 mr-1"></i> Даалгавар
                                        </a>
                                    @else
                                        <a class="flex items-center mr-3" href="{{ route('teacher-daalgavar-add', $item->id) }}">
                                            <i data-feather="home" class="w-4 h-4 mr-1"></i> Даалгавар оруулах
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection