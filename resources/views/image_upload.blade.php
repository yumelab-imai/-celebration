<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Upload</title>
    <link rel="stylesheet" href="public/css/image_upload.css">
    <link rel="stylesheet" href="public/cropper.min.css">
</head>
<body>
    <div class="div-container">
        <form action="{{ route('image.save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="image-preview" style="background-image: url('public/images/rose.jpeg')">
                <img id="image1">
                <label for="imageInput1" class="file-label">１枚目</label>
                <input type="file" id="imageInput1" name="image1" class="file-input">
            </div>

            <div class="image-preview2" style="background-image: url('public/images/mountain.jpeg')">
                <img id="image2">
                <label for="imageInput2" class="file-label">2枚目</label>
                <input type="file" id="imageInput2" name="image2" class="file-input">
            </div>

            <button id="editComplete" type="submit">編集完了</button>
        </form>
    </div>

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script>
        document.getElementById('editComplete').addEventListener('click', function(e){
            e.preventDefault();
            html2canvas(document.querySelector("form")).then(canvas => {
                const dataURL = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = dataURL;
                link.download = 'screenshot.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        });
    </script>


    <script src="cropper.min.js"></script>
    <script>
        const image1 = document.getElementById('image1');
        const input1 = document.getElementById('imageInput1');
        let cropper1;

        input1.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.querySelector('.image-preview').style.backgroundImage = '';
                    image1.src = e.target.result;
                    if (cropper1) cropper1.destroy();
                    cropper1 = new Cropper(image1, {
                        aspectRatio: 16 / 9,
                        cropBoxResizable: false,
                        viewMode: 1,
                        dragMode: 'move',
                        guides: false,
                        autoCrop: false,  // 追加: クロップボックスの自動表示をオフにする
                        highlight: false
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
                    document.querySelector('.image-preview2').style.backgroundImage = '';
                    image2.src = e.target.result;
                    if (cropper2) cropper2.destroy();
                    cropper2 = new Cropper(image2, {
                        aspectRatio: 16 / 9,
                        cropBoxResizable: false,
                        viewMode: 1,
                        dragMode: 'move',
                        guides: false,
                        autoCrop: false,  // 追加: クロップボックスの自動表示をオフにする
                        highlight: false
                    });
                }

                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
