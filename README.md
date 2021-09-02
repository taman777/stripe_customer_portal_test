# stripe_customer_portal_test
Stripe Customer Portal のサンプルコード

Version 1.0     2021/9/2  
株式会社ジーティーアイ　さとうたけし

## 設置方法
stripe_customer_portal_test ディレクトリは名前が長いので適当なディレクトリ名に中身を設置してください。

設置したディレクトリ名を config.php にURLとして書きます。
RETURN_URL に設定します。

    // Stripe 開発者→APIキー→標準キー の シークレットキーを設定
    define( 'API_KEY', 'sk_test_xxxxxxxxxxxxxxxxxxxx' );
    define( 'RETURN_URL', 'https://example.com/cp/cp.php' );    // cpディレクトリに設置した場合

### このままだとライブラリが無いため動作しません。

このディレクトリで
composer update してください。

composer.json の中身は確認してください。 stripe-php のみ取得するようになっています。

customer_portal.php の下記部分

    require './vendor/autoload.php';

はライブラリ取得後本領発揮します。

## サンプル内容

サンプルでは ch_ から始まる 決済ID "charge" と 決済に使用したクレジットカードの下4桁を照合してログインさせるような簡易ログイン形式になっています。

本来は charge ではなく customer があればそのまま カスタマーポータルのセッションを生成できます。

