@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <h4 class="ml-2">{{$monument->getName()}}</h4>
                    </div>
                </div>

                <div class="row p-4">
                    <div class="col-12">
                        <div style="max-width: 720px">
                            <?php
                            $gallery = $monument->getMonumentPictures()->toArray();
                            $storageReceptionClient = \Illuminate\Support\Facades\Storage::disk('reception');
                            $filePath = $gallery[0] ?? null;
                            if (null !== $filePath) {
                                $file = asset('images/' . $filePath['path']);
                            }
                            ?>
                            @if (isset($file))
                                <img src="{{ $file ?? '' }}" class="img-fluid rounded">
                            @endif

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h4>{!! $monument->getDescription() !!}</h4>
                    </div>
                </div>
            </div>
        </div>

@endsection
