<div id="orderCall" class="popup popup-main" style="display:none;">
    <div class="wrapper">
        <div class="popup-block">
            <div class="popup-header">
            <span class="popup-title"
            ><span class="highlight-orange">Заказать</span> звонок</span>
            </div>
            <div class="popup-body">
                <form id="order_call_form" class="contacts-form" action="">
                    <input class="surname" name="surname">
                    <div class="contacts-form-block">
                        <label class="contacts-form-group">
                            <div class="contacts-form-img">
                                <img
                                    src="<?=SITE_TEMPLATE_PATH?>/images/icons/contacts-user-black.svg"
                                    alt="User"
                                />
                            </div>
                            <input
                                class="contacts-form-input"
                                type="text"
                                name="name"
                                placeholder="Ваше имя*"
                                required
                            />
                        </label>
                        <label class="contacts-form-group">
                            <div class="contacts-form-img">
                                <img
                                    src="<?=SITE_TEMPLATE_PATH?>/images/icons/contacts-phone-black.svg"
                                    alt="Phone"
                                />
                            </div>
                            <input
                                class="contacts-form-input contacts-phone"
                                type="text"
                                name="tel"
                                placeholder="Номер телефона*"
                                required
                            />
                        </label></div>
                        <textarea name="msg" class="" style="resize: none;" placeholder="Сообщение ..."></textarea>
                    <div class="smart-captcha" data-sitekey="ysc1_nx86mrDur3bexeldUfnigErDSWJcbLKNd8xedYz29cf6abf8"></div>
                    <button class="contacts-form-btn contacts-popup-btn" type="submit">
                        Оставить заявку
                    </button>
                </form>
            </div>
            <div class="popup-notification order_call_form-notification" style="display: none">
                <img style="height: 70px; width: 70px;" src="/bitrix/templates/elektro_flat/images/logo.gif" alt="">
                <p>Сообщение успешно отправлено!</p>
                <button class="popup-notification-btn">Принять</button>
            </div>
            <button type="button" class="popup-close-btn">
                <img src="<?=SITE_TEMPLATE_PATH?>/images/icons/close-icon.svg" alt="Close">
            </button>
        </div>
    </div>
</div>

<style>
      /*начало стилей формы*/
    section.form_feedback {
        display: flex;
        flex-wrap: wrap;
    }


    @media (max-width: 481px) {



    }

    .popup-notification { display: none;}
    /* конец стилей формы*/


    /**/

    .recall {
        float: left;
        margin: 0;
        margin-right: 10px;
        background: #575b71;
        color: white!important;
        width: 150px;
        text-decoration: none!important;
        height: 35px;
        margin-top: 5px;
        border-radius: 6px;
        border: none;
        font-weight: 700;
        font-size: 14px;
        line-height: 14px;
        /* identical to box height, or 100% */
        color: #FFFFFF;
        gap: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .recall:hover {
        opacity: .7;
    }
  #orderCall.popup {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100vh;
        z-index: 99999;
        background-color: rgba(0, 0, 0, 0.6);
        overflow-y: auto;
    }
   #orderCall .wrapper {
        max-width: 1304px;
        margin: 0 auto;
        padding: 0 15px;
    }
  #orderCall .fadeModal {
        transform: translate(0, 0) scale(1) !important;
    }
  #orderCall .popup-block {
        position: relative;
        width: 100%;
        margin: 50px auto;
        padding: 45px;
        border-radius: 40px;
        background-color: #ffffff;
        transform: translate(0, -200%) scale(0.3);
        transition: transform 0.6s ease;
        top: 20vh;
    }
  #orderCall .popup-notification {
        display: flex;
        align-items: center;
        flex-direction: column;
    }
  #orderCall .popup-close-btn {
        position: absolute;
        top: 30px;
        right: 30px;
        border: none;
        outline: none;
        background: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 25px;
        height: 25px;
    }
  #orderCall  .popup-close-btn img {
        width: 100%;
        height: 100%;
    }
  #orderCall  .popup-notification img {
        display: block;
        max-width: 200px;
        margin-bottom: 50px;
    }
  #orderCall  .popup-notification p {
        font-size: 24px;
        line-height: normal;
        font-weight: 600;
        margin-bottom: 50px;
    }

  #orderCall  .popup-notification button {
      font-family: arial;
        border: none;
        outline: none;
        cursor: pointer;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
      background-color: #ff7302;
        border-radius: 10px;
        font-weight: 400;
        font-size: 20px;
        line-height: normal;
        color: #ffffff;
        width: 196px;
        height: 63px;
        transition: 0.3s;
    }

  #orderCall  .contacts-form {
        position: relative;
        padding: 50px 47px;
        border: 1px solid #00133326;
        border-radius: 10px;
        grid-column: 2 / 5;
    }
  #orderCall .contacts-form {
      padding: 0;
      border: none;
  }
  #orderCall  .surname {
        display: none;
    }
  #orderCall input {
        margin-bottom: 10px;
        display: block;
        background: #F5F8FD;
        border: 1px solid #E8ECF1;
        border-radius: 6px;
        width: 100%;
        height: 52px;
        padding: 0 20px;
        font-weight: 600;
        font-size: 15px;
        line-height: 22px;
        color: #000000;
        font-weight: 400;
    }
  #orderCall  .contacts-form-block {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 80px;
        margin-bottom: 32px;
    }
  #orderCall .contacts-form-btn {
        background: #122D61;
        border-radius: 6px;
        width: 190px;
        height: 42px;
        border: none;
        font-weight: 700;
        font-size: 14px;
        line-height: 14px;
        color: #FFFFFF;
        gap: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
      margin-top: 30px;
      cursor: pointer;
    }
  .contacts-form-img img {
      width: 24px;
      height: 24px;
  }

  #orderCall .contacts-form-group {
      display: flex;
      align-items: center;
      max-width: 310px;
      width: 100%;
      height: 64px;
      border: 1px solid #00133326;
      border-radius: 10px;
      padding: 14px 20px;
  }
      #orderCall .contacts-form-group {
          max-width: 96%;
      }
  #orderCall .surname {
      display:none;
  }
  #orderCall textarea:focus-within {     border: 1px solid #00133326;
      outline: 0;
      border-radius: 10px;}
  #orderCall textarea:focus-visible {     border: 1px solid #00133326;
      outline: 0;
      border-radius: 10px;}
  #orderCall textarea {
      border: 1px solid #00133326;
      border-radius: 10px;
      min-height: 140px;
      width: 98%;
      padding: 15px;
      font-size: 18px;
  }
  .smart-captcha {
      height: 102px;
      width: 98%;
      margin-top: 20px;
  }
  #orderCall  label {
      display: inline-block;
      max-width: 100%;
      margin-bottom: 5px;
      font-weight: bold;
  }
  #orderCall .popup-title {
      display: inline-block;
      font-weight: 600;
      font-size: 44px;
      line-height: 63px;
      color: #001333;
      line-height: 50px;
      margin-bottom: 30px;
      text-transform: uppercase;
  }
  #orderCall .contacts-form-input {
      outline: none;
      border: none;
      background: none;
      font-family: arial;
      width: 100%;
      padding-left: 20px;
      font-weight: 500;
      font-size: 18px;
      line-height: 26px;
      color: #001333;
      margin-bottom: 0px;
  }
    /**/

  @media (max-width: 1681px) {

      #orderCall .wrapper {
          max-width: 1004px;
          margin: 0 auto;
          padding: 0 15px;
      }

  }

  @media (max-width: 1281px) {

      #orderCall .wrapper {
          max-width: 840px;
          margin: 0 auto;
          padding: 0 15px;
          display: flex;
      }

  }

  @media (max-width: 1081px) {
      #orderCall .wrapper {
          max-width: 640px;
          margin: 0 auto;
          padding: 0 15px;
          display: flex;
      }
      #orderCall .popup-block {
          width: 100%!important;
          text-align: center!important;
      }
  }

  @media (max-width: 781px) {

      #orderCall .wrapper {
          max-width: 440px;
          margin: 0 auto;
          padding: 0 15px;
          display: flex;
      }
      #orderCall .contacts-form-block {
          display: grid;
          grid-template-columns: repeat(1, 1fr);
          gap: 30px;
          margin-bottom: 32px;
      }
      #orderCall  .popup-block {
          top: 10vh;
      }
      #orderCall .popup-title {
          display: inline-block;
          font-weight: 600;
          font-size: 24px;
          line-height: 63px;
          color: #001333;
          line-height: 20px;
          margin-bottom: 30px;
          text-transform: uppercase;
      }
      #orderCall .contacts-form-input {
          outline: none;
          border: none;
          background: none;
          font-family: arial;
          width: 100%;
          padding-left: 12px;
          font-weight: 500;
          font-size: 15px;
          line-height: 26px;
          color: #001333;
          margin-bottom: 0px;
      }
      .contacts-form-img img {
          width: 19px;
          height: 19px;
      }
      #orderCall textarea {
          border: 1px solid #00133326;
          border-radius: 10px;
          min-height: 140px;
          width: 97%;
          padding: 15px;
          font-size: 15px;
      }

  }

  @media (max-width: 481px) {
      #orderCall .wrapper {
          max-width: 340px;
          margin: 0 auto;
          padding: 0 15px;
          display: flex;
      }
      #orderCall .contacts-form-block {
          display: grid;
          grid-template-columns: repeat(1, 1fr);
          gap: 10px;
          margin-bottom: 10px;
      }
      #orderCall  .popup-block {
          top: 5vh;
      }
  }

  @media (max-width: 381px) {

      #orderCall .wrapper {
          max-width: 300px;
          margin: 0 auto;
          padding: 0 15px;
          display: flex;
      }
      #orderCall .contacts-form-block {
          display: grid;
          grid-template-columns: repeat(1, 1fr);
          gap: 30px;
          margin-bottom: 32px;
      }
      #orderCall  .popup-block {
          top: 5vh;
      }
  }
</style>
