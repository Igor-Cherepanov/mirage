@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <video id="video">Video stream not available.</video>
            </div>
        </div>

        <div class="row justify-content-center m-4">
            <div class="col-auto">
                <button id="startbutton" class="btn btn-primary btn-circle"></button>
            </div>
        </div>

        <div class="row justify-content-center overflow-hidden" style="display: none">
            <div class="col-auto">
                <canvas id="canvas">
                </canvas>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-auto">
                <img id="photo" alt="The screen capture will appear in this box.">
            </div>
        </div>
    </div>


@endsection


<script>
    //Завернута, чтобы не помешать другому коду (название перменных)
    (function () {
        let width = 640;
        let height = 0;
        let streaming = false;
        let video = null;
        let canvas = null;
        let photo = null;
        let startbutton = null;

        function startup() {
            video = document.getElementById('video');
            canvas = document.getElementById('canvas');
            photo = document.getElementById('photo');
            startbutton = document.getElementById('startbutton');

            navigator.mediaDevices.getUserMedia({video: true, audio: false})
                .then(function (stream) {
                    video.srcObject = stream;
                    video.play();
                })
                .catch(function (err) {
                    console.log("An error occurred: " + err);
                });

            video.addEventListener('canplay', function (ev) {
                if (!streaming) {
                    height = video.videoHeight / (video.videoWidth / width);

                    if (isNaN(height)) {
                        height = width / (4 / 3);
                    }

                    video.setAttribute('width', width);
                    video.setAttribute('height', height);
                    canvas.setAttribute('width', width);
                    canvas.setAttribute('height', height);
                    streaming = true;
                }
            }, false);

            startbutton.addEventListener('click', function (ev) {
                takepicture();
                ev.preventDefault();
            }, false);

            clearphoto();
        }

        function clearphoto() {
            let context = canvas.getContext('2d');
            context.fillStyle = "#AAA";
            context.fillRect(0, 0, canvas.width, canvas.height);

            let data = canvas.toDataURL('image/png');
            photo.setAttribute('src', data);
        }

        function takepicture() {
            let context = canvas.getContext('2d');
            if (width && height) {
                canvas.width = width;
                canvas.height = height;
                context.drawImage(video, 0, 0, width, height);

                let data = canvas.toDataURL('image/png');
                console.log(data);

                photo.setAttribute('src', data);
            } else {
                clearphoto();
            }
        }

        window.addEventListener('load', startup, false);
    })();
</script>
