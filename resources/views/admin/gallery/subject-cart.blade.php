@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="list-page">

        @if($groupSubRelations->new == 1)
            @if(request()->segment(5) == '' || request()->segment(4) == 'gallerySubjectCart')
                @include('admin.list-elements', [
                    'actions' => [
                        trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                        trans('variables.add_subject') => urlForFunctionLanguage($lang, 'createGallerySubject/creategallerysubject'),
                        trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'gallerySubjectCart/gallerysubjectcart')
                    ]
                ])
            @else
                @include('admin.list-elements', [
                    'actions' => [
                        trans('variables.elements_list') => urlForLanguage($lang, 'memberslist'),
                        trans('variables.add_subject') => urlForLanguage($lang, 'creategallerysubject'),
                        trans('variables.elements_basket') => urlForLanguage($lang, 'gallerysubjectcart')
                    ]
                ])
            @endif
        @else
            @if(request()->segment(5) == '' || request()->segment(4) == 'gallerySubjectCart')
                @include('admin.list-elements', [
                    'actions' => [
                        trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                        trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'gallerySubjectCart/gallerysubjectcart')
                    ]
                ])
            @else
                @include('admin.list-elements', [
                    'actions' => [
                        trans('variables.elements_list') => urlForLanguage($lang, 'memberslist'),
                        trans('variables.elements_basket') => urlForLanguage($lang, 'gallerysubjectcart')
                    ]
                ])
            @endif
        @endif


        <div class="list-table">
            @if(!empty($deleted_subject_elems))
                <table class="table" empty-response="{{trans('variables.list_is_empty')}}">
                    <thead>
                    <tr>
                        <th>{{trans('variables.title_table')}}</th>
                        <th class="restore-all">{{trans('variables.reestablish_table')}}</th>
                        @if($groupSubRelations->del_from_rec == 1)
                            <th class="remove-all">{{trans('variables.delete_table')}}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deleted_subject_elems as $deleted_one_subject_elem)
                        <tr id="{{$deleted_one_subject_elem->gallery_subject_id}}">
                            <td>
                                <span>{{!empty(IfHasName($deleted_one_subject_elem->gallery_subject_id, $lang_id, 'gallery_subject')) ? IfHasName($deleted_one_subject_elem->gallery_subject_id, $lang_id, 'gallery_subject') : trans('variables.another_name')}}</span>
                            </td>
                            <td class="medium check-restore-element">
                                <input type="checkbox" class="restore-all-elements"
                                       name="restore_elements[{{$deleted_one_subject_elem->gallery_subject_id}}]"
                                       value="{{$deleted_one_subject_elem->gallery_subject_id}}"
                                       url="{{urlForFunctionLanguage($lang, str_slug($deleted_one_subject_elem->name).'/restoreGallerySubject')}}">
                            </td>
                            @if($groupSubRelations->del_from_rec == 1)
                                <td class="medium check-destroy-element">
                                    <input type="checkbox" class="remove-all-elements"
                                           name="destroy_elements[{{$deleted_one_subject_elem->gallery_subject_id}}]"
                                           value="{{$deleted_one_subject_elem->gallery_subject_id}}"
                                           url="{{urlForFunctionLanguage($lang, str_slug($deleted_one_subject_elem->name).'/destroyGallerySubjectFromCart')}}">
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    <tfoot>
                    <tr>
                        <td colspan="10"></td>
                    </tr>
                    </tfoot>
                </table>
            @else
                <div class="empty-response">{{trans('variables.list_is_empty')}}</div>
            @endif
        </div>
        <div id="loader-gif" class="loader-list"></div>
    </div>

@stop
