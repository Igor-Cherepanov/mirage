
<div class="col-lg-12 mt-3">
    <div class="row {{$key ?? ''}} mb-3 border rounded py-3">
        <?php
        $pictureId =  isset($element) ? $element->getKey() : null;
        ?>
        <div class="col-lg-8">
            <div style="max-width: 720px">
                <?php
                $storageReceptionClient = \Illuminate\Support\Facades\Storage::disk('reception');
                $filePath = $gallery[$id] ?? null;
                if (null !== $filePath) {
                    $file = asset('images/'.$filePath['path']);
                }
                ?>
                @if (isset($file))
                    <img src="{{ $file ?? '' }}" class="img-fluid rounded">
                @endif

            </div>
        </div>
        <div class="col-lg-4">
@include('form._file',[
    'name'=>'slides['.$slideId.']['.$id.'][file]',
    'label'=>($label.' ' ??'Изображение ').($id>0?$id+1:''),
    'class'=>'text-success',
])
{{ Form::hidden('slides['.$slideId.']['.$id.'][ordering]',$id) }}
{{ Form::hidden('slides['.$slideId.']['.$id.'][picture_id]',$pictureId) }}

@if (!in_array('all',$ignoreFields??[]))
    @if (!in_array('text',$ignoreFields??[]))
        @include('form._input', [
'name'=>'slides['.$slideId.']['.$id.'][primary_text]',
'label'=>'Текст',
'text'=>'Максимальная длина: 255 символов.',
'value'=>isset($element) ? $element->getTextPrimary() : null,
'attributes'=>[
'maxlength'=>255,
'data-observe-text-length',
]
])
    @endif

    @if (!in_array('alt',$ignoreFields??[]))
        @include('form._input', [
'name'=>'slides['.$slideId.']['.$id.'][alt]',
'label'=>'Alt',
'value'=>isset($element) ? $element->getAlt() : null,
'text'=>'Максимальная длина: 70 символов.',
'attributes'=>[
'maxlength'=>70,
'data-observe-text-length',
]
])
    @endif

    @if (!in_array('title',$ignoreFields??[]))
        @include('form._input', [
'name'=>'slides['.$slideId.']['.$id.'][title]',
'label'=>'Title',
'value'=>isset($element) ? $element->getTitle() : null,
'text'=>'Максимальная длина: 70 символов.',
'attributes'=>[
'maxlength'=>70,
'data-observe-text-length',
]
])
        @endif
            @endif
        </div>
    </div>
</div>
