@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="form-content">
        @if($groupSubRelations->new == 1)
			@include('admin.list-elements', [
				'actions' => [
					trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
					trans('variables.add_element') => urlForFunctionLanguage($lang, 'createMenu/createmenu'),
					trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'menuCart/menucart')
				]
			])
        @else
			@include('admin.list-elements', [
				'actions' => [
					trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
					trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'menuCart/menucart')
				]
			])
        @endif

        <div class="form-page">

            <div class="form-head">
                <span>{{trans('variables.add_element')}}</span>
            </div>
            <div class="form-body">
                    <div class="fields-row pdf_file" >
                        <div class="label-wrap">
                            <label for="lang">PDF file</label>
                        </div>
						@if(!empty($this_menu) && $this_menu->pdf != '')
                            <p>{{ $this_menu->pdf or '' }}</p>
                            <form method="POST"  action="{{ url($lang, ['back', 'deletePdf']) }}" id="pdf_form_delete" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="file_name" value="{{ $this_menu->pdf or '' }}">
                                <input type="hidden" name="url" value="{{ url()->current() }}">
                                <input type="hidden" name="subject" value="{{ $menu_id->alias }}">
                                <input type="submit" value="" title="Удалить файл">
                            </form>
                        @else
                            <form method="POST"  action="{{ url($lang, ['back', 'uploadPdf']) }}" id="pdf-form" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="file" name="pdf">
                                <input type="hidden" name="url" value="{{ url()->current() }}">
                                <input type="hidden" name="subject" value="{{ $menu_id->alias }}_{{ $page_lang->lang }}">
                            </form>
                        @endif
                    </div>



            </div>
        </div>
    </div>

@stop

