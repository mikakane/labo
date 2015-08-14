# App And Token REST API

[概念]
App : アプリケーション。登録ユーザが自由に作れる。ユーザ管理の単位
Token : 認証等の機構を保有するトークン。トークンを見れば該当のアプリケーション、ヒモ付設定などがわかる。

Client Token: accessType=appのトークン。通常トークン。JSなどで叩くときには公開される。アプリケーションに必要な一部機能のみが利用可能
Root Token: accessType=rootのトークン。管理者トークン。アプリの削除、作成など公開したくない機能を実行する事ができる。



## API 設計

エンドポイント /app

[Client Token API]

/info
トークンを元に対象アプリケーションの情報を表示する。

[root Token API]

/create
アプリケーションを作成

/list
アプリケーション一覧の取得

/freeze
アプリケーションを凍結

/delete
アプリケーションを削除

