<?php
namespace Chatbox\App\Repositories;
use Chatbox\App\Entity\TokenEntity;

/**
 * トークンCRUDに関するリポジトリインターフェイス
 *
 * UPDATE なしで、データが存在する限り有効なトークンとして扱う。
 * (有効ならログイン可能とは言っていない)
 */
interface TokenRepositoryInterface {

    /**
     * トークンの読み込み
     * 有効期限のチェックも行わず、ただ取得するのみ
     *
     * @return TokenEntity | null
     */
    public function loadToken($tokenKey,$type,$default=null);

    /**
     * トークンの保存
     * トークンの格納を行う。
     *
     * @return TokenEntity $tokenEntity
     */
    public function insert(TokenEntity $tokenEntity);

    /**
     * 物理削除を行う。
     * @param $tokenKey
     * @return void
     */
    public function delete($tokenKey);

}

