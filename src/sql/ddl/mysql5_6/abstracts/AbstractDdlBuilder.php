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

use fw3_for_old\builders\sql\ddl\mysql5_6\exceptions\UnbuildableException;

/**
 * 基底DDLビルダ
 */
abstract class AbstractDdlBuilder
{
    /**
     * @var UnbuildableException[]  エラー
     */
    protected $errors   = array();

    /**
     * エラーを追加します。
     *
     * @param   string                  $name   名前
     * @param   UnbuildableException    $error  エラー内容
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
     * @return  UnbuildableException[]  エラー内容
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * エラーメッセージを返します。
     *
     * @return  array   エラー内容
     */
    public function getErrorsMessage()
    {
        $error_messages = [];
        foreach ($this->errors as $name => $errors) {
            foreach ($errors as $error) {
                $error_messages[$name][]    = $error->getMessage();
            }
        }
        return $error_messages;
    }

    /**
     * 名前に紐づくエラー内容を返します。
     *
     * @param   string                      $name   名前
     * @return  UnbuildableException|null   名前に紐づくエラー内容
     */
    public function getError($name)
    {
        return isset($this->errors[$name]) ? $this->errors[$name] : array();
    }

    /**
     * 名前に紐づくエラーメッセージリストを返します。
     *
     * @param   string  $name   名前
     * @return  array   名前に紐づくエラー内容
     */
    public function getErrorMessage($name)
    {
        if (!isset($this->errors[$name])) {
            return array();
        }

        $errors = array();
        foreach ($this->errors[$name] as $error) {
            $errors[]   = $error->getMessage();
        }

        return $errors;
    }

    /**
     * エラー内容を取り込みます。
     *
     * @param   static      $canHaveError   エラー
     * @param   null|string $force_name     強制したいエラー名
     * @return  static  このインスタンス
     */
    public function mergeErrors($canHaveError, $force_name = null)
    {
        foreach ($canHaveError->getErrors() as $name => $errors) {
            foreach ($errors as $error) {
                $this->errors[$force_name === null ? $name : $force_name][]  = $error;
            }
        }

        return $this;
    }

    /**
     * build可能な状態か検証します。
     *
     * @throws  UnbuildableException
     */
    public function validBuildable()
    {
        if ($this->hasErrors()) {
            $message_stacks = ['ビルド不能な状態でビルドが実行されました。'];
            foreach ($this->errors as $name => $errors) {
                foreach ($errors as $error) {
                    /** @var UnbuildableException $error */
                    $message_stacks[]   = '------------------------------------------------';
                    $message_stacks[]   = sprintf('%s:%s', $name, $error->getMessage());
                    $message_stacks[]   = 'Stack trace:';
                    $message_stacks[]   = $error->getTraceAsString();
                }
            }

            $message_stacks[]   = '------------------------------------------------';
            $message_stacks[]   = '';

            throw new UnbuildableException(implode("\n", $message_stacks));
        }
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
