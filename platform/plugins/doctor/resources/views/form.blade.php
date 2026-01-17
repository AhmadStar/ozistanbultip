@extends('core/base::layouts.master')


@php
    $name = ($model)? $model->name:'';
    $message = ($model)? $model->message:'';

    $saturday_start = ($model)? $model->saturday_start:'';
    $saturday_end =($model)? $model->saturday_end:'';
    $saturday_status =($model)? $model->saturday_status:'';

    $sunday_start = ($model)? $model->sunday_start:'';
    $sunday_end =($model)? $model->sunday_end:'';
    $sunday_status =($model)? $model->sunday_status:'';

    $monday_start = ($model)? $model->monday_start:'';
    $monday_end =($model)? $model->monday_end:'';
    $monday_status =($model)? $model->monday_status:'';

    $tuesday_start = ($model)? $model->tuesday_start:'';
    $tuesday_end =($model)? $model->tuesday_end:'';
    $tuesday_status =($model)? $model->tuesday_status:'';

    $wednesday_start = ($model)? $model->wednesday_start:'';
    $wednesday_end =($model)? $model->wednesday_end:'';
    $wednesday_status =($model)? $model->wednesday_status:'';

    $thursday_start = ($model)? $model->thursday_start:'';
    $thursday_end =($model)? $model->thursday_end:'';
    $thursday_status =($model)? $model->thursday_status:'';

    $friday_start = ($model)? $model->friday_start:'';
    $friday_end =($model)? $model->friday_end:'';
    $friday_status =($model)? $model->friday_status:'';

    $period =($model)? $model->period:'';


@endphp
<style>
    label {
        min-width: 100px;
    }
    .onoffswitch-label{
        min-width: 20px !important;
    }
</style>

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="clearfix"></div>
            <div id="main">
                <div class="row">
                    <div class="col-md-9">
                        <div class="tabbable-custom">
                            <div class="tab-pane active">
                                @if (!$model)
                                    <form method="POST" action="{{ route('doctor.create') }}" accept-charset="UTF-8"
                                        id="adminApp">
                                        {{ csrf_field() }}
                                    @else
                                        <form method="POST" action="{{ route('doctor.edit', $model->id) }}"
                                            accept-charset="UTF-8" id="adminApp">
                                            {{ csrf_field() }}
                                            <input type="hidden" id="lang_meta_created_from" name="ref_from"
                                                value="{{ app('request')->input('ref_from') }}">
                                @endif

                                @if (!$model)
                                    <h2>{{ __('إنشاء طبيب جديد') }} </h2>
                                @else
                                    <h2>{{ __('تعديل المعلومات') }} {{ $model->name }}</h2>
                                @endif



                                <div class="form-body">

                                    <div class="container">

                                        <div class="form-group mb-3">
                                            <label for="name" class="control-label required"
                                                aria-required="true">الاسم</label>
                                            <input class="form-control is-valid" placeholder="الاسم" data-counter="120"
                                                name="name" type="text" value="{{ $name }}" id="name">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="name" class="control-label required"
                                                aria-required="true">مدة المعاينة</label>
                                            <select name="period">
                                                <option value="5" {{ $period == 5 ? 'selected' : '' }}>5 دقائق</option>
                                                <option value="10" {{ $period == 10 ? 'selected' : '' }}>10 دقائق</option>
                                                <option value="15" {{ $period == 15 ? 'selected' : '' }}>15 دقيقة</option>
                                                <option value="30" {{ $period == 30 ? 'selected' : '' }}>30 دقيقة</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="name" class="control-label required"
                                                aria-required="true">رسالة عدم توفر الموعد</label>
                                            <textarea name="message" id="editor1" cols="30" rows="10" style="width:100%">
                                                {{ $message }}
                                            </textarea>
                                        </div>

                                        <div class="demo">
                                            <p id="saturday">
                                                <label for="date">{{ __('السبت') }}</label>
                                                <input type="text" name="saturday_start" class="time start"
                                                    value="{{ $saturday_start }}" /> {{ __(' الى') }}
                                                <input type="text" name="saturday_end" class="time end"
                                                    value="{{ $saturday_end }}" />

                                                <label class="mb-2">
                                                    <input type="checkbox" name="saturday_status"  value="1" {{  ($saturday_status == 1 ? ' checked' : '') }}>
                                                    {{__('ON/OFF')}}
                                                </label>
                                            </p>
                                            <p id="sunday">
                                                <label for="date">{{ __('الأحد') }}</label>
                                                <input type="text" name="sunday_start" class="time start"
                                                    value="{{ $sunday_start }}" />
                                                {{ __(' الى') }}
                                                <input type="text" name="sunday_end" class="time end"
                                                    value="{{ $sunday_end }}" />

                                                <label class="mb-2">
                                                    <input type="checkbox" name="sunday_status"  value="1" {{  ($sunday_status == 1 ? ' checked' : '') }}>
                                                    {{__('ON/OFF')}}
                                                </label>

                                            </p>
                                            <p id="monday">
                                                <label for="date">{{ __('الاثنين') }}</label>
                                                <input type="text" name="monday_start" class="time start"
                                                    value="{{ $monday_start }}" />
                                                {{ __(' الى') }}
                                                <input type="text" name="monday_end" class="time end"
                                                    value="{{ $monday_end }}" />

                                                <label class="mb-2">
                                                    <input type="checkbox" name="monday_status"  value="1" {{  ($monday_status == 1 ? ' checked' : '') }}>
                                                    {{__('ON/OFF')}}
                                                </label>

                                            </p>
                                            <p id="tuesday">
                                                <label for="date">{{ __('الثلاثاء') }}</label>
                                                <input type="text" name="tuesday_start" class="time start"
                                                    value="{{ $tuesday_start }}" /> {{ __(' الى') }}
                                                <input type="text" name="tuesday_end" class="time end"
                                                    value="{{ $tuesday_end }}" />

                                                <label class="mb-2">
                                                    <input type="checkbox" name="tuesday_status"  value="1" {{  ($tuesday_status == 1 ? ' checked' : '') }}>
                                                    {{__('ON/OFF')}}
                                                </label>

                                            </p>
                                            <p id="wednesday">
                                                <label for="date">{{ __('الأربعاء') }}</label>
                                                <input type="text" name="wednesday_start" class="time start"
                                                    value="{{ $wednesday_start }}" /> {{ __(' الى') }}
                                                <input type="text" name="wednesday_end" class="time end"
                                                    value="{{ $wednesday_end }}" />

                                                <label class="mb-2">
                                                    <input type="checkbox" name="wednesday_status"  value="1" {{  ($wednesday_status == 1 ? ' checked' : '') }}>
                                                    {{__('ON/OFF')}}
                                                </label>

                                            </p>
                                            <p id="thursday">
                                                <label for="date">{{ __('الخميس') }}</label>
                                                <input type="text" name="thursday_start" class="time start"
                                                    value="{{ $thursday_start }}" /> {{ __(' الى') }}
                                                <input type="text" name="thursday_end" class="time end"
                                                    value="{{ $thursday_end }}" />

                                                <label class="mb-2">
                                                    <input type="checkbox" name="thursday_status"  value="1" {{  ($thursday_status == 1 ? ' checked' : '') }}>
                                                    {{__('ON/OFF')}}
                                                </label>

                                            </p>
                                            <p id="friday">
                                                <label for="date">{{ __('الجمعة') }}</label>
                                                <input type="text" name="friday_start" class="time start"
                                                    value="{{ $friday_start }}" />
                                                {{ __(' الى') }}
                                                <input type="text" name="friday_end" class="time end"
                                                    value="{{ $friday_end }}" />

                                                <label class="mb-2">
                                                    <input type="checkbox" name="friday_status"  value="1" {{  ($friday_status == 1 ? ' checked' : '') }}>
                                                    {{__('ON/OFF')}}
                                                </label>

                                            </p>
                                        </div>
                                    </div>


                                    @push('footer')
                                        <script src="https://jonthornton.github.io/Datepair.js/dist/datepair.js"></script>
                                        <script src="https://jonthornton.github.io/Datepair.js/dist/jquery.datepair.js"></script>
                                        <script>
                                            $('#saturday .time').timepicker({
                                                'showDuration': true,
                                                'timeFormat': 'H:i'
                                            });
                                            $('#saturday').datepair();
                                            $('#saturday').datepair({
                                                parseDate: function(input) {
                                                    return $(input).datepicker('getDate');
                                                },
                                                updateDate: function(input, dateObj) {
                                                    $(input).datepicker('setDate', dateObj);
                                                    console.log(input);
                                                }
                                            });
                                            //
                                            $('#sunday .time').timepicker({
                                                'showDuration': true,
                                                'timeFormat': 'H:i'
                                            });
                                            $('#sunday').datepair();
                                            $('#sunday').datepair({
                                                parseDate: function(input) {
                                                    return $(input).datepicker('getDate');
                                                },
                                                updateDate: function(input, dateObj) {
                                                    $(input).datepicker('setDate', dateObj);
                                                    console.log(input);
                                                }
                                            });
                                            //
                                            $('#monday .time').timepicker({
                                                'showDuration': true,
                                                'timeFormat': 'H:i'
                                            });
                                            $('#monday').datepair();
                                            $('#monday').datepair({
                                                parseDate: function(input) {
                                                    return $(input).datepicker('getDate');
                                                },
                                                updateDate: function(input, dateObj) {
                                                    $(input).datepicker('setDate', dateObj);
                                                    console.log(input);
                                                }
                                            });
                                            //
                                            $('#tuesday .time').timepicker({
                                                'showDuration': true,
                                                'timeFormat': 'H:i'
                                            });
                                            $('#tuesday').datepair();
                                            $('#tuesday').datepair({
                                                parseDate: function(input) {
                                                    return $(input).datepicker('getDate');
                                                },
                                                updateDate: function(input, dateObj) {
                                                    $(input).datepicker('setDate', dateObj);
                                                    console.log(input);
                                                }
                                            });
                                            //
                                            $('#wednesday .time').timepicker({
                                                'showDuration': true,
                                                'timeFormat': 'H:i'
                                            });
                                            $('#wednesday').datepair();
                                            $('#wednesday').datepair({
                                                parseDate: function(input) {
                                                    return $(input).datepicker('getDate');
                                                },
                                                updateDate: function(input, dateObj) {
                                                    $(input).datepicker('setDate', dateObj);
                                                    console.log(input);
                                                }
                                            });
                                            //
                                            $('#thursday .time').timepicker({
                                                'showDuration': true,
                                                'timeFormat': 'H:i'
                                            });
                                            $('#thursday').datepair();
                                            $('#thursday').datepair({
                                                parseDate: function(input) {
                                                    return $(input).datepicker('getDate');
                                                },
                                                updateDate: function(input, dateObj) {
                                                    $(input).datepicker('setDate', dateObj);
                                                    console.log(input);
                                                }
                                            });
                                            //
                                            $('#friday .time').timepicker({
                                                'showDuration': true,
                                                'timeFormat': 'H:i'
                                            });
                                            $('#friday').datepair();
                                            $('#friday').datepair({
                                                parseDate: function(input) {
                                                    return $(input).datepicker('getDate');
                                                },
                                                updateDate: function(input, dateObj) {
                                                    $(input).datepicker('setDate', dateObj);
                                                    console.log(input);
                                                }
                                            });
                                        </script>
                                    @endpush

                                    <div class="clearfix"></div>

                                    <div class="form-group mb-3">
                                        <button type="submit" name="submit" value="save" class="btn btn-info">
                                            <i class="fa fa-save"></i> حفظ
                                        </button>
                                    </div>

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

<script src="https://cdn.tiny.cloud/1/3d8s9x7d7nttj0gqhx4akt2f6vkedl8bdg6lnfw3qnydl3bp/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>
