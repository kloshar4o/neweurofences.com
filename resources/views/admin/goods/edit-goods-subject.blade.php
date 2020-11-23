@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="form-content">
        @if($groupSubRelations->new == 1)
            @if(request()->segment(5) == '' || request()->segment(4) == 'createGoodsSubject')
                @include('admin.list-elements', [
                    'actions' => [
                        trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                        trans('variables.add_subject') => urlForFunctionLanguage($lang, 'createGoodsSubject/creategoodssubject'),
                        trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'goodsSubjectCart/goodssubjectcart'),
                        trans('variables.edit_element') => urlForFunctionLanguage($lang, str_slug($goods_without_lang->name).'/editgoodssubject/'.$goods_without_lang->goods_subject_id.'/'.$edited_lang_id)
                    ]
                ])
            @else
                @include('admin.list-elements', [
                    'actions' => [
                        trans('variables.elements_list') => urlForLanguage($lang, 'memberslist'),
                        trans('variables.add_subject') => urlForLanguage($lang, 'creategoodssubject'),
                        trans('variables.elements_basket') => urlForLanguage($lang, 'goodssubjectcart'),
                        trans('variables.edit_element') => urlForLanguage($lang, 'editgoodssubject/'.$goods_without_lang->goods_subject_id.'/'.$edited_lang_id)
                    ]
                ])
            @endif
        @else
            @if(request()->segment(5) == '' || request()->segment(4) == 'createGoodsSubject')
                @include('admin.list-elements', [
                    'actions' => [
                        trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                        trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'goodsSubjectCart/goodssubjectcart'),
                        trans('variables.edit_element') => urlForFunctionLanguage($lang, str_slug($goods_without_lang->name).'/editgoodssubject/'.$goods_without_lang->goods_subject_id.'/'.$edited_lang_id)
                    ]
                ])
            @else
                @include('admin.list-elements', [
                    'actions' => [
                        trans('variables.elements_list') => urlForLanguage($lang, 'memberslist'),
                        trans('variables.elements_basket') => urlForLanguage($lang, 'goodssubjectcart'),
                        trans('variables.edit_element') => urlForLanguage($lang, 'editgoodssubject/'.$goods_without_lang->goods_subject_id.'/'.$edited_lang_id)
                    ]
                ])
            @endif
        @endif

        <div class="form-page">

            <div class="form-head">
                <span>{{trans('variables.edit_element')}} "{{$goods_elems->name or ''}}"</span>
            </div>


            <div class="form-body" id="editgoodssubject">
                <form class="form" method="POST"
                      action="{{ urlForLanguage($lang, 'savesubject/'.$goods_without_lang->goods_subject_id.'/'.$edited_lang_id) }}"
                      id="edit-form" enctype="multipart/form-data" page="edit-relation"
                      data-parent-url="{{$url_for_active_elem}}">
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
                            <input name="name" id="name" value="{{$goods_elems->name or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="alias">{{trans('variables.alias_table')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="alias" id="alias" value="{{$goods_subject_id->alias or ''}}">  <span class="btn btn-inline refresh_alias">Refresh Alias</span>
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="p_id">{{trans('variables.p_id_name')}}</label>
                        </div>
                        <div class="input-wrap">
                            <select name="p_id" id="p_id" class="select2">
                                <option value="0" {{ !is_null($goods_subject_id) ? (($goods_subject_id->p_id == 0) ? 'selected' : '') : ''}}>{{trans('variables.home')}}</option>
                                {!! SelectGoodsSubjectTree($lang_id, 0 ,$goods_subject_id->p_id, $goods_subject_id->id) !!}
                            </select>
                        </div>
                    </div>

                        <div class="fields-row">
                            @include('admin.uploadOnePhoto', ['modules_name' => $modules_name, 'element_id' => $goods_subject_id, 'element_by_lang' => ''])
                        </div>





                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="group">{{trans('variables.group')}}</label>
                        </div>
                        <div class="input-wrap">
                            <select name="group" id="group" class="select2">
                              <option value="0">{{trans('variables.group')}}</option>

                                @if(!empty($group_list))

                                @foreach($group_list as  $group_one)

                                    <option value="{{$group_one->id}}" {{$goods_subject_id->good_group ==$group_one->id ? 'selected' :''}} >{{$group_one->name}}</option>
                                @endforeach
                                    @endif
                            </select>
                        </div>
                    </div>








                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="body0">{{trans('variables.description')}}</label>
                        </div>
                        <div class="input-wrap">
                            <textarea name="body" id="body0"
                                    data-type="ckeditor">{{$goods_elems->body or ''}}</textarea>
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="title">{{trans('variables.general_title_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="title" id="title" value="{{$goods_elems->page_title or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="h1_title">{{trans('variables.h1_title_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="h1_title" id="h1_title" value="{{$goods_elems->h1_title or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="meta_title">{{trans('variables.meta_title_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="meta_title" id="meta_title" value="{{$goods_elems->meta_title or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="meta_keywords">{{trans('variables.meta_keywords_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="meta_keywords" id="meta_keywords"
                                   value="{{$goods_elems->meta_keywords or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="meta_description">{{trans('variables.meta_description_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="meta_description" id="meta_description"
                                   value="{{$goods_elems->meta_description or ''}}">
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