# USER AUTH REST API 

[概念]
UserCode : 管理対象となるユーザを識別する一意のコード。レスポンスには出さないオプションで任意のユーザ情報を保有することもできる。
Credential: 認証情報。認証方式により複数のタイプが有り、一つのUserCodeは必ず一つ以上のCredentialを持つ。同じタイプのCredentialを同一のUserCodeにひもづける事はできない。

[Client Token API] 

 /register 
新しくUserCodeを発行する。ヒモ付データの登録も可能
同時にひとつ以上のCredentialを発行する。

/login 
Credからひも付きデータを返送する。
オプションでユーザトークンの発行も行う。

/refresh
期限の切れたユーザトークンを再発行する。

[User Token API] 

/checkToken
ひも付きユーザデータを返してくれる。

/bind
トークンのUserCodeに新しいCredentialのヒモ付を行う。
明示的にupdateフラグを付けて実行することで、
同一タイプの既存のCredentialの上書きを行う。

/unbind
トークンのUserCodeからCredentialのヒモ付を除去する。

/update
トークンのUserCodeのヒモ付情報を更新する。

/logout
発行されているユーザトークンを失効させる。

[root Token API] 

/delete

ユーザを削除する。

/ban

ユーザをログイン不能にする。

/list

ユーザを検索する


## エンティティ

[User]


