@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="form-content">
        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                 'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, 'groups'),
                    trans('variables.add_element') => urlForFunctionLanguage($lang, 'groups/createGroups/createitem'),
                ]
            ])
        @else
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, 'groups'),
                    trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'groups/createGroups/createitem')
                ]
            ])
        @endif

        <div class="form-page">

            <div class="form-head">
                <span>{{trans('variables.add_element')}}</span>
            </div>
            <div class="form-body">
                <form class="form" method="POST" action="{{ urlForLanguage($lang, 'save') }}" id="add-form" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="fields-row">

                        <div class="label-wrap">
                            <label for="name">{{trans('variables.title_table')}}</label>
                        </div>
                        <div class="input-wrap" >
                            <input name="name" id="name">
                        </div>

                        {{--<div class="label-wrap">--}}
                            {{--<label for="category">{{trans('Category')}}</label>--}}
                        {{--</div>--}}
                        {{--<select name="category" id="category" class="select2" >--}}
                            {{--@foreach($group_list as $group)--}}
                                {{--<option value="{{$group->id}}" >{{$group->name}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}


                    @if($groupSubRelations->save == 1)
                        <button class="btn" onclick="saveForm(this)" data-form-id="add-form">{{trans('variables.save_it')}}</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

@stop