
<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
<script type="text/javascript">


       setTimeout(function() {
            $(document).ready(function(){ console.log('Готов!');

                $(".contacts-phone").mask("+7(999) 999-99-99");

                $(".header-order-btn").click(function() {
                    $("#orderCall.popup-main").show();
                    $("#orderCall .popup-block").addClass('fadeModal');
                    return false; // Предотвращает стандартное поведение ссылки
                });

                $(document).keyup(function (e) {
                    if (e.keyCode === 27) {
                        $(".popup-block").removeClass('fadeModal');
                        $(".popup-header").show();
                        $(".popup-body").show();
                        $(".popup").hide();
                    }
                });

                $(".popup-notification-btn, .popup-close-btn").click(function () {
                    $(".popup-block").removeClass('fadeModal');
                    $(".popup-header").show();
                    $(".popup-body").show();
                    $(".popup").hide();
                });

                $("#order_call_form").submit(function (event) {
                    event.preventDefault(); // Предотвращаем стандартное поведение формы

                    // Получение токена капчи
                    var captchaToken = document.querySelector('input[name="smart-token"]').value;

                    if (!captchaToken) {
                        alert("Пожалуйста, подтвердите, что вы не робот.");
                        return; // Если капча не пройдена, выходим из функции
                    }

                    // Получение ID формы
                    var formID = $(this).attr('id');
                    var formNm = $('#' + formID);
                    $.ajax({
                        type: "POST",
                        url: '/include/header_ordercall.php',
                        data: formNm.serialize() + '&smart-token=' + captchaToken, // Добавляем токен к данным формы
                        beforeSend: function () {
                            $(formNm).html('');
                        },
                        success: function (data) {
                            $('.order_call_form-notification').css("display", "flex");
                            $('#orderCall .popup-block').css("width","58%");
                            $('.popup-title').css("text-align", "center");
                            $('.popup-title').css("display", "block");
                        },
                        error: function (jqXHR, text, error) {
                            $(formNm).html(error);
                        }
                    });
                });


            });


        }, 3000); // 2000 миллисекунд = 2 секунды*/
</script>
