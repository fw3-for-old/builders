<?php
/**    _______       _______
 *    / ____/ |     / /__  /
 *   / /_   | | /| / / /_ <
 *  / __/   | |/ |/ /___/ /
 * /_/      |__/|__//____/
 *
 * Flywheel3: the inertia php framework for old php versions
 *
 * @category    Flywheel3
 * @package     builders
 * @author      akira wakaba <wakabadou@gmail.com>
 * @copyright   Copyright (c) @2020  Wakabadou (http://www.wakabadou.net/) / Project ICKX (https://ickx.jp/). All rights reserved.
 * @license     http://opensource.org/licenses/MIT The MIT License.
 *              This software is released under the MIT License.
 * @varsion     1.0.0
 */

namespace fw3_for_old\builders\sql\ddl\mysql5_6\abstracts;

/**
 * 基底DDLビルダ
 */
abstract class AbstractDdlBuilder
{
    /**
     * @var array   エラー
     */
    protected $errors   = array();

    /**
     * エラーを追加します。
     *
     * @param   string          $name   名前
     * @param   string|array    $error  エラー内容
     * @return  static  このインスタンス
     */
    public function addError($name, $error)
    {
        $this->errors[$name][]  = $error;
        return $this;
    }

    /**
     * 現在エラーがあるかどうか返します。
     *
     * @return  bool    現在エラーがあるかどうか
     */
    public function hasErrors()
    {
        return !empty($this->errors);
    }

    /**
     * 名前に紐づくエラーがあるかどうかを返します。
     *
     * @param   string  $name   名前
     * @return  bool    名前に紐づくエラーがあるかどうか
     */
    public function hasError($name)
    {
        return !empty($this->errors[$name]);
    }

    /**
     * エラー内容を返します。
     *
     * @return  array   エラー内容
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * 名前に紐づくエラー内容を返します。
     *
     * @param   string  $name   名前
     * @return  array   名前に紐づくエラー内容
     */
    public function getError($name)
    {
        return isset($this->errors[$name]) ? $this->errors[$name] : array();
    }

    /**
     * エラー内容を取り込みます。
     *
     * @param   static|array    $canHaveError   エラー
     * @param   null|string     $force_name     強制したいエラー名
     * @return  static  このインスタンス
     */
    public function mergeErrors($canHaveError, $force_name = null)
    {
        foreach (is_object($canHaveError) && is_subclass_of($canHaveError, __CLASS__) ? $canHaveError->getErrors() : $canHaveError as $name => $messages) {
            foreach ($messages as $message) {
                $this->errors[$force_name === null ? $name : $force_name][]  = $message;
            }
        }

        return $this;
    }

    /**
     * このインスタンスをクローンして返します。
     *
     * @return  static  このインスタンス
     */
    public function with()
    {
        return clone $this;
    }

    /**
     * __clone
     */
    public function __clone()
    {
    }
}
