//////регистрация
$("#registration").on("click", function(){
    let email = $("#email").val().trim(); //удаление лишних пробелов
    let name = $("#name").val().trim();
    let password1 = $("#password1").val().trim();
    let password2 = $("#password_confirm").val().trim();
    let login = $("#login1").val().trim();

    ///// проверки
    const EMAIL_VALID = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
    const NAME_VALID = /^[a-zа-яё]+$/iu;
    const PASS_VALID_LETTERS =  /[а-яёa-z]/iu;
    const PASS_VALID_NUMBERS = /[\d]/;
    const PASS_VALID =  /^[a-z\dа-яё]+$/ui;

    if(login === "" || login.length < 6){
        $("#error_login1").text("Введите логин (мин. 6 символов)");
        return false;
    } else $(".errorMess").text('');

    if(login.indexOf(" ")!==-1){
        $("#error_login1").text("Не допускается использование пробелов");
        return false;
    } else $(".errorMess").text('');

    if(password1 === "" || password1.length < 6){
        $("#error_pass1").text("Введите пароль (мин. 6 символов)");
        return false;
    }else $(".errorMess").text('');

    if (!PASS_VALID_NUMBERS.test(password1) || !PASS_VALID_LETTERS.test(password1) || !PASS_VALID.test(password1))
    {
        $("#error_pass1").text("В пароле должны быть буквы и цифры (без других символов");
        return false;
    } else $(".errorMess").text('');

    if(password1 !== password2){
        $("#error_pass2").text("Пароли не совпадают");
        return false;
    } else $(".errorMess").text('');

    if(email === ""){
        $("#error_email").text("Введите email");
        return false;
    } else $(".errorMess").text('');

    if (!EMAIL_VALID.test(email))
    {
        $("#error_email").text("Некорректный email");
        return false;
    }  else $(".errorMess").text('');

    if(name === "" || name.length < 2 || name.length > 50){
        $("#error_name").text("Введите имя (2-50 символов)");
        return false;
    }  else $(".errorMess").text('');

    if (!NAME_VALID.test(name))
    {
        $("#error_name").text("Допускаются только буквы");
        return false;
    } else $(".errorMess").text('');

    ////аякс запрос
    $.ajax({
        url: 'server_regist.php',
        type: 'POST',
        cache: false,
        data: { 'name': name,
                'email': email,
                'login': login,
                'password': password1 }, //формат json
        dataType: 'html',
        context: $( ".main_theme" ),
        beforeSend: function(){
            $("#registration").prop("disabled", true);  //сработает до получения ответа: кнопка неактивна
        },
        success: function(data){ //сработает после получения ответа
            if(data==="Аккаунт с таким логином уже существует"
                || data==="Аккаунт с таким email уже существует")
                alert(data);
            else{
                $('#authForm').hide();
                $('#mailForm').hide();
                $(this).load("main.php");
            }
            $("#registration").prop("disabled", false);
            console.log(data);
        }
    });
});


//////авторизация

$("#authorization").on("click", async function () {
    let password = $("#password2").val().trim();
    let login = $("#login2").val().trim();

    ///проверки
    if (login === "") {
        $("#error_login2").text("Введите логин");
        return false;
    } else $("#error_login2").text('');

    if (password === "") {
        $("#error_pass").text("Введите пароль");
        return false;
    } else $("#error_pass").text('');

//ajax request
    $.ajax({
        url: 'server_auth.php',
        type: 'POST',
        cache: false,
        data: {
            'login': login,
            'password': password
        },
        dataType: 'html',
        beforeSend: function () {
            $("#authorization").prop("disabled", true);  //сработает до получения ответа: кнопка неактивна
        },
        context: $(".main_theme"),
        success: function (data) {  //сработает после получения ответа
            if (data === "Пользователь не найден") alert(data);
            else {
                $('#authForm').hide();
                $('#mailForm').hide();
                $(this).load("main.php");
            }
            $("#authorization").prop("disabled", false);
            console.log(data);
        }
    });
})
