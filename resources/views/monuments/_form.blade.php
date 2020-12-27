@include('form._input', [
    'name'=>'name',
    'label'=>'Название',
    'value'=>isset($monument) ? $monument->getName():'',
    'required'=>true,
])

<div class="row">
    <div class="col-6">
        @include('form._input', [
            'name'=>'latitude',
            'label'=>'Широта',
            'value'=>isset($monument) ? $monument->getLatitude():'',
            'required'=>true,
        ])
    </div>
    <div class="col-6">
        @include('form._input', [
            'name'=>'longitude',
            'label'=>'Долгота',
            'value'=>isset($monument) ? $monument->getLongitude():'',
            'required'=>true,
        ])
    </div>
</div>

<div class="pb-2">
    <span class="h3">Описание</span>
    @if (isset($monument))
        {!! $monument->trix('description') !!}
    @else
        @trix(\App\Models\Monument::class, 'description')
    @endif
</div>

@for($i = 0; $i < 5; $i++)
    @include('form._picture', [
    'ignoreFields' => ['all'],
    'label' => 'Изображение',
    'slideId'=>0,
    'id'=>$i,
])
@endfor

