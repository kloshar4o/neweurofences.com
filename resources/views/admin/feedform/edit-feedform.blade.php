@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="list-page">

        @include('admin.list-elements', [
            'actions' => [
                trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                trans('variables.edit_element') => urlForFunctionLanguage($lang, str_slug($feedform->name).'/edititem/'.$feedform->id)
            ]
        ])

        <div class="form-page">
            <div class="list-table">
                <div class="table-title">
                    <span>{{trans('variables.edit_element')}} "{{$feedform->name or ''}}"</span>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{trans('variables.name_text')}}</th>
                        {{--<th>{{trans('variables.email_text')}}</th>--}}
                        <th>{{trans('variables.phone')}}</th>
                        <th>{{trans('variables.date_table')}}</th>
                        <th>{{trans('variables.user_ip')}}</th>
                        @if($groupSubRelations->active == 1)
                            <th>{{trans('variables.active_table')}}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <span>{{$feedform->name or ''}}</span>
                        </td>
                        {{--<td>--}}
                            {{--<span>{{$feedform->email or ''}}</span>--}}
                        {{--</td>--}}
                        <td>
                            <span>{{$feedform->phone or ''}}</span>
                        </td>
                        <td>
                            <span>{{$feedform->created_at or ''}}</span>
                        </td>
                        <td>
                            <span>{{$feedform->ip or ''}}</span>
                        </td>
                        @if($groupSubRelations->active == 1)
                            <td class="small active-link">
                                <a href="" class="change-active{{$feedform->active == 1 ? ' active' : ''}}"
                                   data-active="{{$feedform->active}}" element-id="{{$feedform->id}}"
                                   action="subject"
                                   url="{{$url_for_active_elem}}"></a>
                            </td>
                        @endif
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="10"></td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            {{--<div class="form-head">--}}
                {{--<span>{{trans('variables.edit_element')}} "{{$feedform->name or ''}}"</span>--}}
            {{--</div>--}}
            <div class="form-body">
                <form class="form" method="POST" action="{{ urlForLanguage($lang, 'save/'.$feedform->id) }}"
                      id="edit-form" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="body">{{trans('variables.comment_table')}}</label>
                        </div>
                        <div class="input-wrap">
                            <textarea name="comment" id="body" rows="10">{!! $feedform->comment or '' !!}</textarea>
                        </div>
                    </div>
                    {{--<div class="fields-row">--}}
                        {{--<div class="label-wrap">--}}
                            {{--<label for="active">{{trans('variables.active_table')}}</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                            {{--<input type="checkbox" name="active"--}}
                                   {{--id="active" {{$feedform->active == 1 ? 'checked' : ''}}>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    @if($groupSubRelations->save == 1)
                        <button class="btn" onclick="saveForm(this)"
                                data-form-id="edit-form">{{trans('variables.save_it')}}</button>
                    @endif
                </form>
            </div>

        </div>
    </div>

@stop






{{--@extends('admin.app')--}}

{{--@section('content')--}}

    {{--@include('admin.breadcrumbs')--}}

    {{--<div class="form-content">--}}
        {{--@include('admin.list-elements', [--}}
            {{--'actions' => [--}}
                {{--trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),--}}
                {{--trans('variables.edit_element') => urlForFunctionLanguage($lang, str_slug($feedform->name).'/edititem/'.$feedform->id)--}}
            {{--]--}}
        {{--])--}}

        {{--<div class="form-page">--}}

            {{--<div class="form-head">--}}
                {{--<span>{{trans('variables.edit_element')}} "{{$feedform->name or ''}}"</span>--}}
            {{--</div>--}}
            {{--<div class="form-body">--}}
                {{--<form class="form" method="POST" action="{{ urlForLanguage($lang, 'save/'.$feedform->id) }}"--}}
                      {{--id="edit-form" enctype="multipart/form-data">--}}
                    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                    {{--<div class="fields-row">--}}
                        {{--<div class="label-wrap">--}}
                            {{--<label for="name">{{trans('variables.name_text')}}</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                            {{--<span>{{$feedform->name or ''}}</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="fields-row">--}}
                        {{--<div class="label-wrap">--}}
                            {{--<label for="email">{{trans('variables.email_text')}}</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                            {{--<span>{{$feedform->email or ''}}</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="fields-row">--}}
                        {{--<div class="label-wrap">--}}
                            {{--<label for="phone">{{trans('variables.phone')}}</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                            {{--<span>{{$feedform->phone or ''}}</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="fields-row">--}}
                        {{--<div class="label-wrap">--}}
                            {{--<label for="date">{{trans('variables.date_table')}}</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                            {{--<span>{{$feedform->created_at or ''}}</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="fields-row">--}}
                        {{--<div class="label-wrap">--}}
                            {{--<label for="ip">{{trans('variables.user_ip')}}</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                            {{--<span>{{$feedform->ip or ''}}</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="fields-row">--}}
                        {{--<div class="label-wrap">--}}
                            {{--<label for="body">{{trans('variables.comment_table')}}</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                            {{--<textarea name="comment" id="body" rows="10">{!! $feedform->comment or '' !!}</textarea>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="fields-row">--}}
                        {{--<div class="label-wrap">--}}
                            {{--<label for="active">{{trans('variables.active_table')}}</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                            {{--<input type="checkbox" name="active"--}}
                                   {{--id="active" {{$feedform->active == 1 ? 'checked' : ''}}>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--@if($groupSubRelations->save == 1)--}}
                        {{--<button class="btn" onclick="saveForm(this)"--}}
                                {{--data-form-id="edit-form">{{trans('variables.save_it')}}</button>--}}
                    {{--@endif--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

{{--@stop--}}