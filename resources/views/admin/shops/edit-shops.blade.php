@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="form-content">
        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                    trans('variables.add_element') => urlForFunctionLanguage($lang, 'createShops/createitem'),
                    trans('variables.edit_element') => urlForFunctionLanguage($lang, str_slug($shops_without_lang->name).'/edititem/'.$shops_without_lang->shops_id.'/'.$edited_lang_id)
                ]
            ])
        @else
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                    trans('variables.edit_element') => urlForFunctionLanguage($lang, str_slug($shops_without_lang->name).'/edititem/'.$shops_without_lang->shops_id.'/'.$edited_lang_id)
                ]
            ])
        @endif

        <div class="form-page">

            <div class="form-head">
                <span>{{trans('variables.edit_element')}} "{{$shops->name or ''}}"</span>
            </div>
            <div class="form-body">
                <form class="form" method="POST" action="{{ urlForLanguage($lang, 'save/'.$shops_without_lang->shops_id.'/'.$edited_lang_id) }}" id="edit-form" enctype="multipart/form-data" data-parent-url="{{$url_for_active_elem}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="lang">{{trans('variables.lang')}}</label>
                        </div>
                        <div class="input-wrap">
                            <select name="lang" id="lang" class="select2">
                                @foreach($lang_list as $lang_key => $one_lang)
                                    <option value="{{$one_lang->id}}" {{$one_lang->id == $edited_lang_id ? 'selected' : ''}}>{{$one_lang->descr}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="name">{{trans('variables.title_table')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="name" id="name" value="{{$shops->name or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="alias">{{trans('variables.alias_table')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="alias" id="alias" value="{{$shops_without_lang->shopsId->alias or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="phone" class="new_input_label">{{trans('variables.phone')}}</label>
                        </div>
                        <div class="input-wrap">
                            <div class="new_input" data-url="{{$url_for_active_elem}}" data-msg-err="{{trans('variables.min_one_input')}}">
                                @if(!empty($shops_without_lang->shopsId->phone))
                                    @foreach(explode(';', $shops_without_lang->shopsId->phone) as $key => $one_phone_number)
                                        <div class="clone_div" data-elem-id="{{$shops_without_lang->shops_id}}">
                                            <input name="phone[]" id="phone{{$key}}" data-position-el="{{$key}}" value="{{$one_phone_number or ''}}">
                                            <span class="destroy_cloned_input destroy_cloned_element"></span>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="clone_div" data-elem-id="{{$shops_without_lang->shops_id}}">
                                        <input name="phone[]" id="phone">
                                        <span class="destroy_cloned_input destroy_cloned_element"></span>
                                    </div>
                                @endif
                                <div class="button-new-input">
                                    <button type="button" class="btn">{{trans('variables.new_element')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!empty($city))
                        <div class="fields-row">
                            <div class="label-wrap">
                                <label for="city_id">{{trans('variables.city')}}</label>
                            </div>
                            <div class="input-wrap">
                                <select name="city_id" id="city_id" class="select2">
                                    @foreach($city as $one_city)
                                        <option value="{{$one_city->city_id}}" {{$shops_without_lang->shopsId->city_id == $one_city->city_id ? 'selected' : ''}}>{{$one_city->name or ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="fields-row">
                        @include('admin.uploadOnePhoto', ['modules_name' => $modules_name, 'element_id' => $shops_without_lang->shopsId, 'element_by_lang' => ''])
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="schedule" class="new_input_label">{{trans('variables.schedule')}}</label>
                        </div>
                        <div class="input-wrap">
                            <div class="new_input" data-url="{{$url_for_active_elem}}" data-msg-err="{{trans('variables.min_one_input')}}">
                                @if(!empty($shops->schedule))
                                    @foreach(explode(';', $shops->schedule) as $key => $one_schedule)
                                        <div class="clone_div" data-elem-id="{{$shops_without_lang->shops_id}}">
                                            <input name="schedule[]" id="schedule{{$key}}" data-position-el="{{$key}}" value="{{$one_schedule or ''}}">
                                            <span class="destroy_cloned_input destroy_cloned_element"></span>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="clone_div" data-elem-id="{{$shops_without_lang->shops_id}}">
                                        <input name="schedule[]" id="schedule">
                                        <span class="destroy_cloned_input destroy_cloned_element"></span>
                                    </div>
                                @endif
                                <div class="button-new-input">
                                    <button type="button" class="btn">{{trans('variables.new_element')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="address">{{trans('variables.address')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input id="address" name="address" value="{{$shops->address or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="latitude">{{trans('variables.latitude')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input id="latitude" name="latitude" value="{{$shops_without_lang->shopsId->latitude or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="longitude">{{trans('variables.longitude')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input id="longitude" name="longitude" value="{{$shops_without_lang->shopsId->longitude or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="show_gmap">{{trans('variables.map')}}</label>
                        </div>
                        <div class="input-wrap">
                            <button type="button" class="btn btn-inline small left map" id="show_gmap">{{trans('variables.map')}}</button>
                            <button type="button" class="btn btn-inline small right map hidden" id="my-location">{{trans('variables.my_location')}}</button>
                            <div id="google_map"></div>
                        </div>
                    </div>
                    @if($groupSubRelations->save == 1)
                        <button class="btn" onclick="saveForm(this)"
                                data-form-id="edit-form">{{trans('variables.save_it')}}</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

@stop