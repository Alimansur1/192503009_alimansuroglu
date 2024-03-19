<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Formu</title>
    <style>

body {
    font-family: sans-serif;
    margin: 0;
    padding: 20px;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 300px;
    margin: 0 auto;
    border: 1px solid #ccc;
    padding: 20px;
}

h1 {
    margin-top: 0;
    margin-bottom: 10px;
}

label {
    margin-bottom: 5px;
    display: block;
}

input {
    width: 100%;
    padding: 5px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
}

button {
    width: 100%;
    padding: 5px 10px;
    border: 1px solid #ccc;
    background-color: #000;
    color: #fff;
    cursor: pointer;
}
#captcha-image {
  width: 150px;
  height: 50px;
}


    </style>
</head>
<body>
    <form id="loginForm" action="./database/conf.php" method="post">
        <h1>Giriş Yap</h1>
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" id="username" name="loginForm-username" placeholder="Kullanıcı adınızı giriniz">
        <br>
        <label for="password">Şifre:</label>
        <input type="password" id="password" name="password" placeholder="Şifrenizi giriniz">
        <br>
        <label for="captcha">Doğrulama Kodu:</label>
        <img src="" id="captcha-image">
        <input type="text" id="captcha" name="captcha">
        <br>
        <button type="submit">Giriş Yap</button>
        <a href="./sifresifirlama.php">Şifrenizi mi unuttunuz?</a>
    </form>

    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/jquery.js"></script>
    <script>

        $(document).ready(function(){
            var captchaID=Math.floor(Math.random()*10);
            var captcha=[
                {  imageurl:"./shop-product/1.png", imageCode:"W68HP"},    
                {  imageurl:"./shop-product/2.png", imageCode:"W68HP"},
                {  imageurl:"./shop-product/3.png", imageCode:"j6u28"},
                {  imageurl:"./shop-product/4.png", imageCode:"JYDZVG"},
                {  imageurl:"./shop-product/5.png", imageCode:"bys2w"},
                {  imageurl:"./shop-product/6.png", imageCode:"wym8v"},
                {  imageurl:"./shop-product/7.png", imageCode:"RMTKHE"},
                {  imageurl:"./shop-product/8.png", imageCode:"706DE"},
                {  imageurl:"./shop-product/9.png", imageCode:"ReCAPtChA"},
                {  imageurl:"./shop-product/10.png", imageCode:"4ehvhx"},
            ]

            console.log(captchaID);
            document.querySelector("#captcha-image").src= captcha[captchaID].imageurl ;
            $('#captcha-image').attr("data-label",captcha[captchaID].imageCode)
            
            $('#loginForm').submit(function(e){
                e.preventDefault();
                var username = $('#username').val();
                var password = $('#password').val();
                var captchaInput = $('#captcha').val();
                var captchaText = $('#captcha-image').attr("data-label");
                
                if(captchaInput==captchaText){
                    $.ajax({
                        type: 'POST',
                        url: 'database/conf.php',
                        data: {
                            username: username,
                            password: password,
                            captcha: captchaInput
                        },
                        success: function(response){
                            alert(response); 
                        }
                    });

                }else{
                    alert("Hatalı Kod Girdiniz!!!")
                }
              
            });
        });
    </script>
</body>
</html>