@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="form-content">
        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForLanguage($lang, '../color'),
                    trans('variables.add_item') => urlForLanguage($lang, '../color/createColors/createitem'),
                ]
            ])
        @else
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForLanguage($lang, '/'),
                ]
            ])
        @endif

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

        <div class="form-page" ng-app="" ng-init="ral = '{{$color_lang->ral or ''}}'; hex = '{{$color_lang->hex or ''}}'; name = '{{$color_lang->name or ''}}'; ">

            <div class="form-body altehForm">
                <div>
                    @verbatim

                        <style>
                            .colors .ral{{ral}} .hexagon::before,
                            .colors .ral{{ral}} .hexagon::after,
                            .colors .ral{{ral}} .hexagon .box {
                                border-color: {{hex}};
                                background-color: {{hex}};
                                outline-color: {{hex}}


                            }
                        </style>

                        <div class="colors" ng-if="hex">
                            <div class="oneColor">
                                <div class="holdHexagon ral{{ral}}">

                                    <div class="hexagon">
                                        <div class="box"></div>
                                    </div>

                                    <div class="hexagon shadow">
                                        <div class="box">{{name}}</div>
                                    </div>


                                </div>
                            </div>



                        </div>
                        <p style="font-size: 20px;margin-top: 20px;"> RAL {{ral}}</p>

                    @endverbatim
                </div>
                <form class="form" method="POST" action="{{ urlForLanguage($lang, 'save/'.$colors_list->id.'/'.$edited_lang_id) }}" id="edit-form" enctype="multipart/form-data">
                    <h1>{{trans('variables.edit_element')}} "{{$color_lang->name or ''}}"</h1>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="label-wrap">
                        <label for="name">{{trans('variables.lang')}}</label>
                    </div>
                    <select name="lang" id="lang" class="select2">
                        @foreach($lang_list as $lang_key => $one_lang)
                            <option value="{{$one_lang->id}}" {{$one_lang->id == $edited_lang_id ? 'selected' : ''}}>{{$one_lang->descr or ''}}</option>
                        @endforeach
                    </select>

                    <div class="label-wrap">
                        <label for="ral">RAL</label>
                    </div>
                    <div class="input-wrap">
                        <input name="ral" id="ral" ng-model="ral" ng-value="'{{$color_lang->ral or ''}}'" required>
                    </div>

                    <div class="label-wrap">
                        <label for="hex">HEX/RGB/RGBA</label>
                    </div>
                    <div class="input-wrap">
                        <input name="hex" id="hex" ng-model="hex" ng-value="'{{$color_lang->hex or ''}}'" required>
                    </div>


                    <div class="label-wrap">
                        <label for="name">{{trans('variables.title_table')}}</label>
                    </div>
                    <div class="input-wrap">
                        <input name="name" id="name" ng-model="name" ng-value="'{{$color_lang->name or ''}}'" required>
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