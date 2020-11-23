@extends('admin.app')

@section('content')

    {{--@include('admin.breadcrumbs')--}}

    <div class="form-content">
        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, 'color'),
                    trans('variables.add_element') => urlForFunctionLanguage($lang, 'color/createColors/createitem')
                ]
            ])
        @else
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, 'color'),
                    trans('variables.add_element') => urlForFunctionLanguage($lang, 'color/createColors/createitem')
                ]
            ])
        @endif

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

        <div class="form-page" ng-app="" >

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

                <form class="form" method="POST" action="{{ urlForLanguage($lang, 'save') }}" id="add-form" enctype="multipart/form-data">
                    <h1>{{trans('variables.add_element')}}</h1>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <div class="label-wrap">
                        <label for="name">{{trans('variables.lang')}}</label>
                    </div>

                    <select name="lang" id="lang" class="select2">
                        @foreach($lang_list as $lang_key => $one_lang)
                            <option value="{{$one_lang->id}}" {{$one_lang->id == $lang_id ? 'selected' : ''}}>{{$one_lang->descr}}</option>
                        @endforeach
                    </select>


                    <div class="label-wrap">
                        <label for="ral">RAL</label>
                    </div>
                    <div class="input-wrap">
                        <input name="ral" id="ral" ng-model="ral" required>
                    </div>

                    <div class="label-wrap">
                        <label for="hex">HEX/RGB/RGBA</label>
                    </div>

                    <div class="input-wrap">
                        <input name="hex" id="hex" ng-model="hex" required>
                    </div>

                    <div class="label-wrap">
                        <label for="name">{{myTrans('Color')}}</label>
                    </div>

                    <div class="input-wrap">
                        <input name="name" id="name" ng-model="name" required>
                    </div>

                    <div class="label-wrap">
                        <label for="structure">{{myTrans('Structure')}}</label>
                    </div>

                    <div class="input-wrap">
                        <input name="structure" id="structure" ng-model="structure" type="checkbox"  class="checkbox">
                    </div>

                    @if($groupSubRelations->save == 1)
                        <button class="btn" onclick="saveForm(this)" data-form-id="add-form">{{trans('variables.save_it')}}</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

@stop