@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')


    @include('admin.list-elements', [
        'actions' => $id ? [
            myTrans('All') => "../../../",
            myTrans('Create') => "../../$lang_id/",
            myTrans('Edit') => "../../$lang_id/$id/"
        ] : [
            myTrans('All') => "../../",
            myTrans('Create') => "../$lang_id/",
        ]
    ])

    <div class="form-page">

    </div>

@stop