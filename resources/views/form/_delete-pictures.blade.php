
@if(null!==$gallery->first())

<h4 class="pt-2">{{$title_secondary ?? 'Галерея'}}</h4>

<div class="col-lg-12">
    <div class="row pb-3">
    @forelse($gallery as $picture)
            <div class="col-lg-4 pb-4 border">
                <div class="text-center">
                    {{ $picture->getName() }}
                </div>
                <img src="{{ $picture->getSrc() }}"
                     srcset="{{ $picture->getSrcset() }}"
                     data-width="{{ $picture->getWidth() }}"
                     data-height="{{ $picture->getHeight() }}"
                     alt="{{ $picture->getName() }}"
                     data-gallery-id="{{ $picture->getTypeId() }}"
                     class="pswp-item mh-100 img-fluid"
                >

                <div class="text-center">
                    <div class="row justify-content-center no-gutters">
                        <div class="col-auto">
                            {{ Form::open(['url'=>route('pictures.destroy',$picture),'method'=>'DELETE','class'=>'btn-group']) }}
                            {{ Form::hidden('connection','site') }}
                            <button class="btn btn-sm"
                                    onclick="return confirm('Удалить изображение {{ $picture->getName() }}?')">
                                Удалить <i class="fa fa-trash"></i>
                            </button>

                            {{ Form::close() }}
                        </div>

{{--                        @if ($picture->getSrc() && strpos($picture->getSrc(),'414',0) === false)--}}
{{--                            <div class="text-danger">--}}
{{--                                Старый формат — требуется удаление и перезаливка--}}
{{--                            </div>--}}
{{--                        @endif--}}
                    </div>
                </div>

            </div>
        @empty
        @endforelse
    </div>
</div>
@endif
