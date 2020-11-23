@php

    $subject_id = isset($goods_subject_id) ? $goods_subject_id : '';
    $groupId = isset($goods_subject_id) ? $goods_subject_id->good_group : '';
    $inputs = [
        'name'             => ['required' => 'required','hidden' => ''        ],
        'alias'            => ['required' => 'required','hidden' => ''        ],
        'page_title'       => ['required' => '',        'hidden' => ''        ],
        'h1_title_page'    => ['required' => '',        'hidden' => ''        ],
        'meta_title'       => ['required' => '',        'hidden' => ''        ],
        'meta_description' => ['required' => '',        'hidden' => ''        ],
        'meta_keywords'    => ['required' => '',        'hidden' => 'hidden'  ],
    ]
@endphp

<div class="form-page">



    <div class="form-body">
        <form class="form altehForm" method="POST"
              action="{{$action}}"
              id="{{$formid}}"
              enctype="multipart/form-data"
              page="{{$formRelation}}"
              data-parent-url="{{$url_for_active_elem or ''}}">

            <div class="flex">
                <h1>{{$goods_elems->name or ''}}</h1>

                <hr>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="fields-row radio">
                    <div class="label-wrap">
                        <label for="lang">{{trans('variables.lang')}}</label>
                    </div>

                    <div class="input-wrap myRadio">

                        @foreach($lang_list as $lang_key => $one_lang)

                            <label for="NoRedlang{{$one_lang->id}}"> <img src='/upfiles/lang/{{$one_lang->lang}}.png'> {{$one_lang->descr}}
                                <input id="NoRedlang{{$one_lang->id}}" type="radio" name="lang" value="{{$one_lang->id}}" {{$one_lang->id == $editLang ? 'checked' : ''}}>
                            </label>
                        @endforeach

                    </div>

                </div>

                <hr>
                <div class="fields-row select">
                    <div class="label-wrap">
                        <label for="p_id">{{trans('variables.form_parent')}}</label>
                    </div>
                    <div class="input-wrap">
                        <select name="p_id" id="p_id" class="select2">
                            <option value="0" {{ isset($goods_subject_id) ? (($goods_subject_id->p_id == 0) ? 'selected' : '') : ''}}>{{trans('variables.home')}}</option>
                            {!! SelectGoodsSubjectTree($lang_id, 0 ,$pageId) !!}
                        </select>
                    </div>
                </div>
                <div class="fields-row select">
                    <div class="label-wrap">
                        <label for="group">{{trans('variables.group')}}</label>
                    </div>
                    <div class="input-wrap">
                        <select name="group" id="group" class="select2">
                            <option value="0">{{trans('variables.group')}}</option>

                            @if(!empty($group_list))

                                @foreach($group_list as $group_one)

                                    <option value="{{$group_one->id}}" {{ $groupId == $group_one->id ? 'selected' :''}} >{{$group_one->name}}</option>

                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <hr>

                @foreach ($inputs as $input => $prop)

                    <div class="fields-row text {{$input}} {{$prop['hidden']}}">
                        <div class="label-wrap">
                            <label for="{{$input}}">{{trans("variables.form_$input")}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="{{$input}}" id="{{$input}}" value="{{$goods_elems[$input] or ''}}" {{$prop['required']}}>
                        </div>
                    </div>

                @endforeach


                <div class="fields-row photo min750">
                    @include('admin.uploadOnePhoto', ['modules_name' => $modules_name, 'element_id' => $subject_id, 'element_by_lang' => ''])
                </div>
                <div class="fields-row html">
                    <div class="label-wrap">
                        <label for="body0">{{trans('variables.description')}}</label>
                    </div>
                    <div class="input-wrap">
                            <textarea name="body" id="body0"
                                      data-type="ckeditor">{{$goods_elems->body or ''}}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-head fixed">
                <span>{{$title}} {{$goods_elems->name or ''}}</span> <button class="btn" onclick="saveForm(this)" data-form-id="{{$formid}}">{{trans('variables.save_it')}}</button>
            </div>

        </form>
    </div>
</div>