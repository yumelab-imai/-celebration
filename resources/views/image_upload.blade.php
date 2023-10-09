<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Upload</title>
    <link rel="stylesheet" href="{{ asset('css/image_upload.css') }}">
</head>
<body>
    <form action="{{ route('image.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="image-preview" style="background-image: url('{{ asset('/images/rose.jpeg') }}')">
            <img id="image1">
            <label for="imageInput1" class="file-label">１枚目</label>
            <input type="file" id="imageInput1" name="image1" class="file-input">
        </div>

        <div class="image-preview" style="background-image: url('{{ asset('/images/mountain.jpeg') }}')">
            <img id="image2">
            <label for="imageInput2" class="file-label">2枚目</label>
            <input type="file" id="imageInput2" name="image2" class="file-input">
        </div>

        <button id="editComplete" type="submit">編集完了</button>
    </form>

    <script src="{{ asset('cropper.min.js') }}"></script>
    <script>
        const image1 = document.getElementById('image1');
        const input1 = document.getElementById('imageInput1');
        let cropper1;

        input1.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    image1.src = e.target.result;
                    if (cropper1) cropper1.destroy();
                    cropper1 = new Cropper(image1, {
                        aspectRatio: 16 / 9,
                        viewMode: 1
                    });
                }

                reader.readAsDataURL(file);
            }
        });

        const image2 = document.getElementById('image2');
        const input2 = document.getElementById('imageInput2');
        let cropper2;

        input2.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    image2.src = e.target.result;
                    if (cropper2) cropper2.destroy();
                    cropper2 = new Cropper(image2, {
                        aspectRatio: 16 / 9
                    });
                }

                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
