@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="form-content">
        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => ($menu_id->level == 1 ? urlForFunctionLanguage($lang, '') : urlForFunctionLanguage($lang, GetParentAlias($menu_without_lang->menu_id, 'menu_id').'/memberslist')),
                    trans('variables.add_element') => ($menu_id->level == 1 ? urlForFunctionLanguage($lang, 'createMenu/createmenu') : urlForFunctionLanguage($lang, GetParentAlias($menu_without_lang->menu_id, 'menu_id').'/createmenu')),
                    trans('variables.elements_basket') => ($menu_id->level == 1 ? urlForFunctionLanguage($lang, 'menuCart/menucart') : urlForFunctionLanguage($lang, GetParentAlias($menu_without_lang->menu_id, 'menu_id').'/menucart')),
                    trans('variables.edit_element') => urlForFunctionLanguage($lang, $menu_id->alias . '/editmenu/'.$menu_without_lang->menu_id.'/'.$edited_lang_id)
                ]
            ])
        @else
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => ($menu_id->level == 1 ? urlForFunctionLanguage($lang, '') : urlForFunctionLanguage($lang, GetParentAlias($menu_without_lang->menu_id, 'menu_id').'/memberslist')),
                    trans('variables.elements_basket') => ($menu_id->level == 1 ? urlForFunctionLanguage($lang, 'menuCart/menucart') : urlForFunctionLanguage($lang, GetParentAlias($menu_without_lang->menu_id, 'menu_id').'/menucart')),
                    trans('variables.edit_element') => urlForFunctionLanguage($lang, $menu_id->alias . '/editmenu/'.$menu_without_lang->menu_id.'/'.$edited_lang_id)
                ]
            ])
        @endif

        <div class="form-page">

            <div class="form-head">
                <span>{{trans('variables.edit_element')}} "{{$menu_elems->name or ''}}"</span>
            </div>
            <div class="form-body">
                <form class="form"
                      method="POST"
                      onsubmit="saveFormNew(event)"
                      action="{{ urlForLanguage($lang, 'savemenu/'.$menu_without_lang->menu_id.'/'.$edited_lang_id) }}"
                      data-parent-url="{{$url_for_active_elem}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="module_id" value="{{$modules_name->modules_id}}">

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
                            <input name="name" id="name" value="{{$menu_elems->name or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="alias">{{trans('variables.alias_table')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="alias" id="alias" value="{{$menu_id->alias or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="p_id">{{trans('variables.p_id_name')}}</label>
                        </div>
                        <div class="input-wrap">
                            <select name="p_id" id="p_id" class="select2">
                                <option value="0" {{ !is_null($menu_id) ? (($menu_id->p_id == 0) ? 'selected' : '') : ''}} >{{trans('variables.home')}}</option>
                                {!! SelectTree($lang_id, 0, $menu_id->p_id) !!}
                            </select>
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="set_type">{{trans('variables.parameter_type')}}</label>
                        </div>
                        <div class="input-wrap">
                            <select name="page_type" id="set_type" class="select2">
                                <option value="page" {{ !is_null($menu_id) ? (($menu_id->page_type == 'page') ? 'selected' : '') : ''}}>{{trans('variables.html_page')}}</option>
                                <option value="link" {{ !is_null($menu_id) ? (($menu_id->page_type == 'link') ? 'selected' : '') : ''}}>{{trans('variables.link')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="fields-row link hide">
                        <div class="label-wrap">
                            <label for="link">{{trans('variables.link')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="link" id="link" value="{{$menu_id->link or ''}}">
                        </div>
                    </div>
                    <div class="fields-row ckeditor hide">
                        <div class="label-wrap">
                            <label for="body">{{trans('variables.description')}}</label>
                        </div>
                        <div class="input-wrap">
                            <textarea name="body" id="body" data-type="ckeditor">{{$menu_elems->body or ''}}</textarea>
                        </div>
                    </div>
                    <div class="fields-row">
                        @include('admin.uploadOnePhoto', ['modules_name' => $modules_name, 'element_id' => $menu_id, 'element_by_lang' => ''])
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="title">{{trans('variables.general_title_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="title" id="title" value="{{$menu_elems->page_title or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="h1_title">{{trans('variables.h1_title_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="h1_title" id="h1_title" value="{{$menu_elems->h1_title or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="meta_title">{{trans('variables.meta_title_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="meta_title" id="meta_title" value="{{$menu_elems->meta_title or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="meta_keywords">{{trans('variables.meta_keywords_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="meta_keywords" id="meta_keywords" value="{{$menu_elems->meta_keywords or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="meta_description">{{trans('variables.meta_description_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="meta_description" id="meta_description"
                                   value="{{$menu_elems->meta_description or ''}}">
                        </div>
                    </div>

                    <div class="fields-row">
                        @include('admin.components.upload-docs', [
                            'docs' => $menu_docs,
                            'main_folder' => $module_id->alias,
                            'sub_folder' => $menu_without_lang->id
                            ])
                    </div>

                    @if($groupSubRelations->save == 1)
                        <button class="btn" type="submit">{{trans('variables.save_it')}}</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

@stop