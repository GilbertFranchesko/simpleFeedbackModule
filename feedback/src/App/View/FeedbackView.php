<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .main-nav {
            width: 100%;
            min-height: 70px;
        }
        .main-nav .btn {
            margin-top: 100px;
            padding: 25px;
            background-color: #e6e6e6;
            width: 100%;
            border: none;
        }

        .main-nav .active {
            background-color: green;
            color: #ffffff;
        }

        .feedbacks-container {
            margin-top: 100px;
        }

        .t-yellow {
            color: #FCE412 !important;
        }

        .feedbacks-container p {
            color: #5B5B5B;
            font-size: 16px;
        }

        .feedbacks-container .inner-img {
            width: 245px;
            height: 148px;
        }

        .feedbacks-container .row div {
            margin-right: 40px;
        }

        .feedback-element:first-child {
            margin-top: 0;
        }

        .feedback-element {
            margin-top: 60px;
        }

        .feedback-element ul {
            margin-top: 10px;
            list-style: none;

            color: #5B5B5B;
            padding-bottom: 50px;
        }

        .feedback-element li {
            padding-top: 15px;
        }

        .add-form {
            width: 780px;
            margin-left: 243px;
            padding-bottom: 80px;
        }

        .add-form .rate {
            margin-left: 73px;
            margin-top: 40px;
            text-align: center;
        }

        .rate-list li {
            display: inline-block;
        }

        .rate-list li p {
            padding-top: 20px;
        }

        .rate-list i {
            cursor: pointer;
            color: #CECACA;
        }

        .add-form input {
            height: 70px;
            border-radius: 0px;
            padding: 35px;
        }

        .add-form textarea {
            height: 144px;
            border-radius: 0px;
            padding: 35px;
        }

        .add-form .form-group {
            padding-top: 15px;
        }

        .add-documents {
            padding-top: 20px;
        }

        .add-documents ul {
            list-style: none;
        }

        .add-documents li {
            display: inline-block;
            width: 144px;
            height: 110px;
            cursor: pointer;

            margin-right: 55px;
        }

        .add-documents .photo-block {
            width: 85%;
            position: relative;
            height: 100%;
            border: 2px solid #CECACA;
        }

        .photo-block:before {
            content: "+";
            position: absolute;
            top: 110px;
            right: -1px;
            transform:translate(50%,-50%);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #199A3E;
            mix-blend-mode:darken;
            color: white;
            font-size: 30px;
            text-align: center;
            font-weight: bold;
        }

        .add-documents li > p {
            text-align: center;
            margin-top: 20px;

            text-decoration: underline;
            color: #5B5B5B;
        }

        .document-active {
            border: 2px solid #199A3E !important;
        }

        .empty-photo img {
            margin-top: 43px;
            margin-left: 47px;
        }

        .add-photo img {
            margin-top: 25px;
            margin-left: 35px;

            width: 54px;
            height: 54px;
        }

        .submit-button {
            background-color: #199A3E;
            width: 305px;
            height: 60px;
            padding: 19px 43px 19px 43px;
            margin-top: 25px;
            text-transform: uppercase;
            font-weight: bold;
            border: none;
            border-radius: none;
        }

        .paginator ul {
            list-style: none;
        }

        .paginator li {
            display: inline-block;
        }

        .subicons {
            width: 23px;
            height: 23px;
            background-size: cover;
        }

        #error {
            color: red;
            font-weight: bold;
        }

    </style>
    </head>
    <body>
        <div class="container">
            <div class="btn-group main-nav" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-default">Описание</button>
                <button type="button" class="btn btn-default">Характеристики</button>
                <button type="button" class="btn btn-default">Применимость</button>
                <button type="button" class="btn btn-default">Доставка</button>
                <button type="button" class="btn btn-default">Оплата</button>
                <button type="button" class="btn btn-default active">Отзывы (<?php echo count($params['feedbackList']); ?>)</button>
                <button type="button" class="btn btn-default">Варианты</button>
            </div>


            <div class="feedbacks-container">
                <?php foreach($params['feedbackList'] as $feedback) { ?>
                <div class="feedback-element">
                    <h5><?=$feedback['name'];?></h5>
                    <?php for($i=0; $i<$feedback['rate'];$i++) { ?>
                    <i class="fa fa-star t-yellow"></i>
                    <?php } ?>

                    <p>
                        <?=$feedback['description'];?>
                    </p>

                    
                    <div class="row">
                        <?php 
                        if($feedback['document'] != "null") {
                        foreach(json_decode($feedback['document']) as $photos) { ?>
                            <?php foreach($photos as $photo) { ?>
                            <div class="col-md-2">
                                <img class="inner-img" src="<?=$photo->path ?>" />
                            </div>
                        <?php  }}} ?>
                    </div>
                    <ul>
                        <?php if($feedback['benefits'] != null) { ?>
                        <li>
                            <img class="subicons" src="/assets/plus.png" /> 
                            <?=$feedback['benefits'];?>         
                        </li>
                        <?php } ?>

                        <?php if($feedback['drawbacks'] != null) { ?>
                        <li>
                            <img class="subicons" src="/assets/minus.png" /> 
                            <?=$feedback['drawbacks'];?>         
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <hr />

                <?php } ?>

                <?php if(count($params['feedbackList']) > 25) { ?> 

                <div class="paginator">
                    <ul>
                        <?php $pagesCount = count($params['feedbackList']) / 25 ?>
                        <?php for($i=0;$i<$pagesCount;$i++) { ?>
                        <li>
                            <a href="#<?=$i;?>">$i</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>

                <?php } ?>

                <div class="add-form-container">
                    <h5>Добавить отзыв к товару</h5>
                    <div class="add-form">
                        <p id="error"></p>
                        <ul class="rate-list">
                            <li class="rate">
                                <i class="fa fa-star rate-button" value="1"></i>
                                <p>Плохо</p>
                            </li>
                            <li class="rate">
                                <i class="fa fa-star rate-button" value="2"></i>
                                <p>Так себе</p>
                            </li>
                            <li class="rate">
                                <i class="fa fa-star rate-button" value="3"></i>
                                <p>Нормально</p>
                            </li>
                            <li class="rate">
                                <i class="fa fa-star rate-button" value="4"></i>
                                <p>Хорошо</p>
                            </li>
                            <li class="rate">
                                <i class="fa fa-star rate-button" value="5"></i>
                                <p>Отлично</p>
                            </li>
                        </ul>

                        <div class="form-group">
                            <input type="text" class="form-control" id="name" placeholder="Ваше имя">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="benefits" placeholder="Преимущества:">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="drawbacks" placeholder="Недостатки:">
                        </div>
                        <div class="form-group">
                            <textarea type="text" class="form-control" id="description" placeholder="Ваш отзыв:"></textarea>
                        </div>
                        
                        <div class="add-documents">
                            <p>Добавьте фото и видео к своему отзыву, чтобы он стал еще интереснее.</p>

                            <ul id="document-selector">
                                <li>
                                    <div class="photo-block empty-photo document-active">
                                        <img src="/assets/empty.png" />
                                    </div>
                                    <p>без фото</p>
                                </li>
                                <li id="photo-selector">
                                    <div class="photo-block add-photo" onclick="photoInput.click()">
                                        <img id="add-photo-image" src="/assets/icon_photo.png" />
                                    </div>
                                    <canvas id="canvas" hidden></canvas>
                                    <p id="add-photo-descriptor">добавить фото</p>
                                    <input id="photoInput" type="file" accept="image/png, image/gif, image/jpeg" hidden/>
                                </li>
                                <li>
                                    <div class="photo-block add-photo">
                                        <img src="/assets/icon_video.svg" />
                                    </div>
                                    <p>добавить видео</p>
                                </li>
                            </ul>
                        </div>
                        <button class="btn btn-success submit-button" onclick="submitFeedback()">
                            Отправить
                        </button>
                    </div>

                    
                </div>
            </div>

        </div>    




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <script>
    
    var rate = 0;
    var photos = null;

    let rateButtons = document.getElementsByClassName('rate-button'); 
    let arr = Array.from(rateButtons);
    
    
    arr.forEach((button) => {
        button.addEventListener("click", function (e) {
            arr.forEach((rate) => rate.classList.remove("t-yellow"));
            rate = button.getAttribute("value");
            let rates = arr.slice(0, rate);
            rates.forEach((e) => e.classList.add("t-yellow"));
        })
    });

    let photoInput = document.getElementById("photoInput");
    let emptyPhoto = document.getElementsByClassName("empty-photo")[0];
    let photoBlock = document.getElementsByClassName("add-photo")[0];
    let addPhotoDescriptor = document.getElementById("add-photo-descriptor");
    let addPhotoImage = document.getElementById("add-photo-image");
    let documentSelector = document.getElementById("document-selector");
    let photoSelector = document.getElementById("photo-selector");
            
    function resizeImage(sourceImg, targetWidth, targetHeight) {
        var canvas = document.getElementById('canvas');
        var ctx = canvas.getContext('2d');

        var image = new Image();
        image.onload = function() {
            var width = image.width;
            var height = image.height;
            var scaleFactor = 1;

            if (width > targetWidth || height > targetHeight) {
                var scaleWidth = targetWidth / width;
                var scaleHeight = targetHeight / height;
                scaleFactor = Math.min(scaleWidth, scaleHeight);
            }

            canvas.width = width * scaleFactor;
            canvas.height = height * scaleFactor;
            ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
        };
        image.src = sourceImg;
    }

    photoInput.addEventListener("change", function(e) {
        let photos = e.target.files;
        let photoArr = Array.from(photos);
        
        var reader = new FileReader();
            reader.readAsDataURL(photoArr[0]);
            reader.onload = function (event) {
            
            let image = new Image();
            image.src = event.target.result;

            image.onload = function () {
                let width = this.width;
                let height = this.height;

                if(width > 1000 && height > 1000)
                {
                    resizeImage(event.target.result, 1000, 1000);
                }
                else {

                    resizeImage(event.target.result, width, height);
                }
            }

        }      

        emptyPhoto.classList.remove("document-active");
        photoBlock.classList.add("document-active");

        let imageURL = URL.createObjectURL(photoArr[0]);
        addPhotoImage.src = imageURL;

        addPhotoDescriptor.textContent = photoArr[0].name;

    });


    async function submitFeedback() {
        let name = document.getElementById("name").value;
        let email = document.getElementById("email").value;
        let description = document.getElementById("description").value;
        let benefits = document.getElementById("benefits").value;
        let drawbacks = document.getElementById("drawbacks").value;
        let canvas = document.getElementById('canvas');

        let errorAlert = document.getElementById("error");

        canvas.toBlob(function(blob) {
            let formData = new FormData();

            let noneHTMLRegex = "<\s*([^ >]+)[^>]*>.*?<\s*/\s*\1\s*>";
            if(!name.match(noneHTMLRegex) || !description.match(noneHTMLRegex) || !benefits.match(noneHTMLRegex) || !drawbacks.match(noneHTMLRegex))
            { errorAlert.innerHTML = "Ошибка ввода"; return;}

            if(rate == 0) { errorAlert.innerHTML = "Выберите по шкале до 5ти."; return;}
            formData.append("rate", rate);

            if(name == "") { errorAlert.innerHTML = "Введите имя."; return;}
            formData.append("name", name);

            let validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if(!email.match(validRegex)) { errorAlert.innerHTML = "Email введён неверно."; return;}
            formData.append("email", email);
            
            if(description == "") { errorAlert.innerHTML = "Введите отзыв."; return;}
            formData.append("description", description);
            formData.append("benefits", benefits);
            formData.append("drawbacks", drawbacks);
            if(canvas.getAttribute("width") != null) { formData.append("photos", blob); }

            fetch('/feedback/formAddFeedback', {
                method: "POST",
                body: formData,
            });
        });

        

    }


        



    </script>
    </body>
</html>