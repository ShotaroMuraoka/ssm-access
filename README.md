# SSM Parameter Store Access

## Overview
SSMパラメータストアからパラメータを取得するためだけのプラグイン
(特に公式化する予定なし)

## How to use.
## Step 1.
cloneしたりcomposer installしたり
```
git clone https://github.com/ShotaroMuraoka/ssm-access.git
cd ./ssm-access
composer install
```

## Step 2.
`wp-config.php` とかで定数定義します。

| key | value |
|---|---|
| SSM_AWS_ACCESS_KEY | アクセスキー |
| SSM_AWS_SECRET_ACCESS_KEY | シークレットアクセスキー |

## Step 3.
クライアントを作って取得したいパラメータのkeyを入れてgetします。
```
$hoge = new Ssm_Client();
$hoge->get_parameter( 'fuga' );
```