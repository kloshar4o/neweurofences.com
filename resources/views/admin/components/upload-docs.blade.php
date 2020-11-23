<div class="fields-row">
    <div class="label-wrap">
        <label for="meta_description">{{trans('variables.documents')}}</label>
    </div>

    @isset($docs)
    <div class="homeless-files-previews">
        @foreach($docs as $doc)

            @php
                $src = "/upfiles/$main_folder/$sub_folder/$doc->file_name";
                $extension = strtolower($doc->extension);
            @endphp

            <div class="homeless-files-preview {{$extension ?? 'unknown'}}">

                <input class="hidden"
                       type="checkbox"
                       name="docs_delete[]"
                       id="docs_delete_{{$doc->id}}" value="{{$doc->id}}">

                <label for="docs_delete_{{$doc->id}}">
                    <i class="fas fa-trash"></i>
                    <i class="fas fa-trash-restore"></i>
                </label>

                @switch($extension)
                    @case('jpg')
                    @case('png')
                    @case('gif')
                    <img class="homeless-file-image" src="{{$src}}">
                    <span class="homeless-file-name">
                        <a href="{{$src}}" target="_blank">{{$doc->file_name}}</a>
                    </span>

                    @break

                    @default

                    <span class="homeless-file-icon">{{$extension ?? 'Unknown'}}</span>
                    <span class="homeless-file-name">
                        <a href="{{$src}}" target="_blank">{{$doc->file_name}}</a>
                    </span>
                @endswitch
            </div>
        @endforeach
    </div>
    @endisset

    <div class="label-wrap homeless-file-input">
        <label for="docs" class="is-dragover">
            <b class="upload-label">{{trans('variables.upload_files')}}</b>
            <input type="file" name="docs_upload[]" id="docs" multiple>
        </label>
    </div>
</div>

@push('scripts')
    <script> new DropFileInput('docs')</script>
@endpush

{{--
$modules_name [▼
  "id" => 7
  "modules_id" => "3"
  "alias" => "menu"
]

$element_id [▼
  "id" => 24
  "alias" => "Jaluze"
]

$lang: "ro"
--}}