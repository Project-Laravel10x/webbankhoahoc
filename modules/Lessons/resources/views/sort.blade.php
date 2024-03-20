@extends('layouts.backend')


@section('content')

    <div class="row-cols-auto">
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        <form action="{{ route('admin.lessons.sort',$courseId) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div id="sort-table-list" class="list-group col">
                    @foreach($modules as $module)
                        <div id="item-{{ $module['id'] }}" data-id="{{ $module['id'] }}"
                             class="list-group-item nested-1">{{ $module['name'] }}
                            <input type="hidden" name="lessons[]" value="{{ $module['id'] }}">
                        </div>
                        @if($module['children'])
                            @php
                                    $lessons = $module->children()->orderBy('position','asc')->get();
                            @endphp
                            @foreach($lessons as $lesson)
                                <div id="item-{{ $lesson['id'] }}" data-id="{{ $lesson['id'] }}"
                                     class="list-group-item nested-2">- {{ $lesson['name'] }}
                                    <input type="hidden" name="lessons[]" value="{{ $lesson['id'] }}">
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>

            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
            <a href="{{ route('admin.lessons.index',$courseId) }}" class="btn btn-dark mt-3">Quay lại</a>
        </form>
    </div>
@endsection

@section('style')
    <style>
        .ghost {
            opacity: 0.4;
        }

        .list-group {
            margin: 20px;
        }

        .nested-1 {
            color: #000;
            font-size: 20px;
            font-weight: bold;
        }

        .nested-2 {
            padding-left: 50px;
        }
    </style>
@endsection



@section('js_custom')
    <script>
        $('#sort-table-list').sortable({
            group: 'list',
            animation: 200,
            ghostClass: 'ghost',
            onSort: () => {
                console.log(12545743875748784)
            },
        });
    </script>
@endsection


