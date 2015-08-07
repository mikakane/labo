# 作業メモ

とりあえずRequestも作って、バリデーションをRequest側に持たせる戦略。

UserDataはひとつカゴとして持っていいと思う戦略

Token抽象エンティティが機能エンティティにラップされるイメージ


## テーブル名の依存注入管理

基本諦める。 
migrate はalterかければいいしeloquentは継承してrepositoryに注入すればいい(providerフェーズ)
実際問題、後でどうとでもなる問題。
