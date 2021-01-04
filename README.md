# Jetstream_Login

使用 Laravel Auth,撰寫簡易登入與註冊平台

-   需求：
    1. 透過資料庫查詢後,若無資料則進行註冊作業
       若已有該使用者,則進行資料驗證,查驗該使用者資料是否正確,於正確結果中顯示登入後頁面,若資料不正確則顯示錯誤結果

    2. 串接 google 或 facebook 登入

## Use

-   Url
    https://jetstream.login.gill.gq/
    ![](https://i.imgur.com/3Guxau2.png)

點選右上角可進行登入或註冊

-   登入

![](https://i.imgur.com/jnQ6Bow.png)

1. 可選擇一般登入或 google 登入

2. 若在資料庫中查無輸入的帳號，則直接註冊，使用者名為'new user'(登入後可自行修改),輸入帳號需為 email 格式，密碼至少 8 位元
