@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">

                {{Form::model($monument, ['url'=>route('monuments.update', $monument), 'method'=>'PATCH', 'files'=>true])}}

                @include('monuments._form')
                <button class="btn btn-success mt-4 btn-block mb-5">
                    Сохранить
                </button>

                {{Form::close()}}

            </div>
        </div>
    </div>
{{--    @include('site.form._delete-pictures',['gallery'=>$gallery])--}}

@endsection
