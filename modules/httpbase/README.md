# Chatbox Rest Application

## Token System

トークンは一旦全てTokenエンティティとしてretrieveされてから
使用目的に応じてUserToken,RootTokenなどの種別に切り分けられる。

切り分け可能か否かはtokenデータの性質による。
