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
 * @package     strings
 * @author      akira wakaba <wakabadou@gmail.com>
 * @copyright   Copyright (c) @2020  Wakabadou (http://www.wakabadou.net/) / Project ICKX (https://ickx.jp/). All rights reserved.
 * @license     http://opensource.org/licenses/MIT The MIT License.
 *              This software is released under the MIT License.
 * @varsion     1.0.0
 */

namespace fw3_for_old\builders\sql\ddl\mysql5_6;

use fw3_for_old\builders\sql\ddl\mysql5_6\abstracts\AbstractDdlBuilder;
use fw3_for_old\strings\converter\Convert;

/**
 * COLUM Builder
 */
class Column extends AbstractDdlBuilder
{
    //==============================================
    // consts
    //==============================================
    /**
     * @var int     カラム名の最大文字列長
     */
    const NAME_MAX_LENGTH   = 64;

    /**
     * @var int     カラムコメントの最大文字列長
     */
    const COMMENT_MAX_LENGTH    = 1024;

    //==============================================
    // properties
    //==============================================
    /**
     * @var string  カラム名
     */
    protected $name;

    /**
     * @var string  型
     */
    protected $type             = null;

    /**
     * @var array   型オプション
     */
    protected $typeOptions      = null;

    /**
     * @var bool    符号属性
     */
    protected $unsigned         = false;

    /**
     * @var bool    バイナリデータ
     */
    protected $binary           = false;

    /**
     * @var bool    NOT NULL制約
     */
    protected $notNull          = false;

    /**
     * @var bool    オートインクリメント
     */
    protected $autoIncrement    = false;

    /**
     * @var array   デフォルト
     */
    protected $default          = array();

    /**
     * @var string  コメント
     */
    protected $comment          = null;

    /**
     * @var array   定義値マップ
     */
    protected $map              = array();

    //==============================================
    // methods
    //==============================================
    /**
     * constructor
     *
     * @param   string  $name   カラム名
     */
    protected function __construct($name)
    {
        $this->name($name);
    }

    /**
     * factory
     *
     * @param   string  $name   カラム名
     * @return  static  このインスタンス
     */
    public static function factory($name)
    {
        return new static($name);
    }

    /**
     * カラム名を取得・設定します。
     *
     * @param   $name   string|null カラム名
     * @return  string|static       カラム名またはこのインスタンス
     */
    public function name($name = null)
    {
        if ($name === null && func_num_args() === 0) {
            return $this->name;
        }

        if ($name === '') {
            throw new \Exception('カラム名が空です。');
        }

        if (($length = mb_strlen($name)) > self::NAME_MAX_LENGTH) {
            throw new \Exception(sprintf('カラム名の最大文字列長を超過しました。name:%s, max_length:%d, length:%s', Convert::toDebugString($name, 2), self::NAME_MAX_LENGTH, $length));
        }

        $this->name = $name;
        return $this;
    }

    //----------------------------------------------
    // 型指定
    //----------------------------------------------
    /**
     * 型を設定します。
     *
     * @param   string  $type       型
     * @param   array   $options    型オプション
     * @return  static  このインスタンス
     */
    protected function type($type, $options = array())
    {
        $this->type         = $type;
        $this->typeOptions  = $options;
        return $this;
    }

    /**
     * このカラムをbit型とします。
     *
     * @param   int     $length bit長さ
     * @return  static  このインスタンス
     */
    public function bit($length = null)
    {
        $this->type('bit', array('length' => $length));
        return $this;
    }

    /**
     * このカラムをtinyint型とします。
     *
     * @return  static  このインスタンス
     */
    public function tinyint()
    {
        $this->type('tinyint');
        return $this;
    }

    /**
     * このカラムをsmallint型とします。
     *
     * @return  static  このインスタンス
     */
    public function smallint()
    {
        $this->type('smallint');
        return $this;
    }

    /**
     * このカラムをmediumint型とします。
     *
     * @return  static  このインスタンス
     */
    public function mediumint()
    {
        $this->type('mediumint');
        return $this;
    }

    /**
     * このカラムをbigint型とします。
     *
     * @return  static  このインスタンス
     */
    public function bigint()
    {
        $this->type('bigint');
        return $this;
    }

    /**
     * このカラムをint型とします。
     *
     * @return  static  このインスタンス
     */
    public function int()
    {
        $this->type('int');
        return $this;
    }

    /**
     * このカラムをreal型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @return  static  このインスタンス
     */
    public function real($length = null, $decimals = null)
    {
        $this->type('real', array('length' => $length, 'decimals' => $decimals));
        return $this;
    }

    /**
     * このカラムをdouble型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @return  static  このインスタンス
     */
    public function double($length = null, $decimals = null)
    {
        $this->type('double', array('length' => $length, 'decimals' => $decimals));
        return $this;
    }

    /**
     * このカラムをfloat型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @return  static  このインスタンス
     */
    public function float($length = null, $decimals = null)
    {
        $this->type('float', array('length' => $length, 'decimals' => $decimals));
        return $this;
    }

    /**
     * このカラムをdecimal型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @return  static  このインスタンス
     */
    public function decimal($length = null, $decimals = null)
    {
        $this->type('decimal', array('length' => $length, 'decimals' => $decimals));
        return $this;
    }

    /**
     * このカラムをnumeric型とします。
     *
     * @param   int     $length     精度
     * @param   int     $decimals   スケール
     * @return  static  このインスタンス
     */
    public function numeric($length = null, $decimals = null)
    {
        $this->type('numeric', array('length' => $length, 'decimals' => $decimals));
        return $this;
    }

    /**
     * このカラムをdate型とします。
     *
     * @return  static  このインスタンス
     */
    public function date()
    {
        $this->type('date');
        return $this;
    }

    /**
     * このカラムをtime型とします。
     *
     * @return  static  このインスタンス
     */
    public function time()
    {
        $this->type('time');
        return $this;
    }

    /**
     * このカラムをtimestamp型とします。
     *
     * @return  static  このインスタンス
     */
    public function timestamp()
    {
        $this->type('timestamp');
        return $this;
    }

    /**
     * このカラムをdatetime型とします。
     *
     * @return  static  このインスタンス
     */
    public function datetime()
    {
        $this->type('datetime');
        return $this;
    }

    /**
     * このカラムをyear型とします。
     *
     * @return  static  このインスタンス
     */
    public function year()
    {
        $this->type('year');
        return $this;
    }

    /**
     * このカラムをchar型とします。
     *
     * @param   int     $length 文字列長
     * @return  static  このインスタンス
     */
    public function char($length)
    {
        $this->type('char', array('length' => $length));
        return $this;
    }

    /**
     * このカラムをvarchar型とします。
     *
     * @param   int     $length 文字列長
     * @return  static  このインスタンス
     */
    public function varchar($length)
    {
        $this->type('varchar', array('length' => $length));
        return $this;
    }

    /**
     * このカラムをtext型とします。
     *
     * @return  static  このインスタンス
     */
    public function text()
    {
        $this->type('text');
        return $this;
    }

    /**
     * このカラムをmediumtext型とします。
     *
     * @return  static  このインスタンス
     */
    public function mediumtext()
    {
        $this->type('mediumtext');
        return $this;
    }

    /**
     * このカラムをlongtext型とします。
     *
     * @return  static  このインスタンス
     */
    public function longtext()
    {
        $this->type('longtext');
        return $this;
    }

    //----------------------------------------------
    // 属性
    //----------------------------------------------
    /**
     * このカラムを符号なしとします。
     *
     * @return  static  このインスタンス
     */
    public function unsigned()
    {
        $this->unsigned = true;
        return $this;
    }

    /**
     * このカラムをバイナリとします。
     *
     * @return  static  このインスタンス
     */
    public function binary()
    {
        $this->binary = true;
        return $this;
    }

    /**
     * このカラムをNOT NULLとします。
     *
     * @return  static  このインスタンス
     */
    public function notNull()
    {
        $this->notNull  = true;
        return $this;
    }

    /**
     * このカラムをauto incrementとします。
     *
     * @return  static  このインスタンス
     */
    public function autoIncrement()
    {
        $this->autoIncrement    = true;
        return $this;
    }

    /**
     * このカラムにデフォルト値を設定します。
     *
     * @param   string|int|float    $value  デフォルト値
     * @return  static  このインスタンス
     */
    public function defaultValue($value)
    {
        $this->default  = array($value);
        return $this;
    }

    /**
     * このカラムにコメントを設定します。
     *
     * @param   string  $comment    コメント
     * @param   array   $map        定義値マップ
     * @return  static  このインスタンス
     */
    public function comment($comment, $map = array())
    {
        if (($length = mb_strlen($comment)) > self::COMMENT_MAX_LENGTH) {
            throw new \Exception(sprintf('カラムコメントの最大文字列長を超過しました。comment:%s, max_length:%d, length:%s', Convert::toDebugString($comment, 2), self::COMMENT_MAX_LENGTH, $length));
        }

        $this->comment  = $comment;
        $this->map      = $map;
        return $this;
    }

    //----------------------------------------------
    // build
    //----------------------------------------------
    /**
     * 現在の状態を返します。
     *
     * @return  array   現在の状態
     */
    public function getState()
    {
        $type   = $this->buildType();

        $comment    = $this->comment;
        if ($comment !== null) {
            if (!empty($this->map)) {
                if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
                    $json_options   = constant("\\JSON_UNESCAPED_SLASHES") | constant("\\JSON_UNESCAPED_UNICODE");
                } else {
                    $json_options   = 0;
                }

                $comment    = sprintf('%s const:%s', $this->comment, json_encode($this->map, $json_options));

                if (($length = mb_strlen($comment)) > self::COMMENT_MAX_LENGTH) {
                    throw new \Exception(sprintf('カラムコメントの最大文字列長を超過しました。comment:%s, max_length:%d, length:%s', Convert::toDebugString($comment, 2), self::COMMENT_MAX_LENGTH, $length));
                }
            }
        }

        return array(
            'name'              => sprintf('`%s`', $this->name),
            'type'              => $type,
            'not_null'          => $this->notNull ? 'NOT NULL' : '',
            'default'           => !empty($this->default) ? sprintf('DEFAULT \'%s\'', $this->default[0]) : '',
            'auto_increment'    => $this->autoIncrement ? 'AUTO_INCREMENT' : '',
            'comment'           => $comment !== null ? sprintf('COMMENT \'%s\'', $comment) : '',
        );
    }

    /**
     * 型の文字列表現を構築し返します。
     *
     * @return  string  型の文字列表現
     */
    protected function buildType()
    {
        if ($this->type === null) {
            throw new \Exception('型が指定されていません。');
        }

        switch ($this->type) {
            case 'bit':
                return isset($this->typeOptions['length']) ? sprintf('bit(%d)', $this->typeOptions['length']) : 'bit';
            case 'tinyint':
                return $this->unsigned ? 'tinyint unsigned' : 'tinyint';
            case 'smallint':
                return $this->unsigned ? 'smallint unsigned' : 'smallint';
            case 'mediumint':
                return $this->unsigned ? 'mediumint unsigned' : 'mediumint';
            case 'bigint':
                return $this->unsigned ? 'bigint unsigned' : 'bigint';
            case 'int':
                return $this->unsigned ? 'int unsigned' : 'int';
            case 'real':
                $format = isset($this->typeOptions['length'], $this->typeOptions['decimals']) ? sprintf('(%d, %d)', $this->typeOptions['length'], $this->typeOptions['decimals']) : '';
                return sprintf($this->unsigned ? 'real%s unsigned' : 'real%s', $format);
            case 'double':
                $format = isset($this->typeOptions['length'], $this->typeOptions['decimals']) ? sprintf('(%d, %d)', $this->typeOptions['length'], $this->typeOptions['decimals']) : '';
                return sprintf($this->unsigned ? 'double%s unsigned' : 'double%s', $format);
            case 'float':
                $format = isset($this->typeOptions['length'], $this->typeOptions['decimals']) ? sprintf('(%d, %d)', $this->typeOptions['length'], $this->typeOptions['decimals']) : '';
                return sprintf($this->unsigned ? 'float%s unsigned' : 'float%s', $format);
            case 'decimal':
                if (isset($this->typeOptions['length'])) {
                    $format = isset($this->typeOptions['decimals']) ? sprintf('(%d, %d)', $this->typeOptions['length'], $this->typeOptions['decimals']) : sprintf('(%d)', $this->typeOptions['length']);
                } else {
                    $format = '';
                }
                return sprintf($this->unsigned ? 'decimal%s unsigned' : 'decimal%s', $format);
            case 'numeric':
                if (isset($this->typeOptions['length'])) {
                    $format = isset($this->typeOptions['decimals']) ? sprintf('(%d, %d)', $this->typeOptions['length'], $this->typeOptions['decimals']) : sprintf('(%d)', $this->typeOptions['length']);
                } else {
                    $format = '';
                }
                return sprintf($this->unsigned ? 'numeric%s unsigned' : 'numeric%s', $format);
            case 'date':
                return 'date';
            case 'time':
                return 'time';
            case 'timestamp':
                return 'timestamp';
            case 'datetime':
                return 'datetime';
            case 'year':
                return 'year';
            case 'char':
                return isset($this->typeOptions['length']) ? sprintf('char(%d)', $this->typeOptions['length']) : 'char';
            case 'varchar':
                return isset($this->typeOptions['length']) ? sprintf('varchar(%d)', $this->typeOptions['length']) : 'varchar';
            case 'text':
                return $this->binary ? 'text binary' : 'text';
            case 'mediumtext':
                return $this->binary ? 'mediumtext binary' : 'mediumtext';
            case 'longtext':
                return $this->binary ? 'longtext binary' : 'longtext';
        }

        throw new \Exception(sprintf('未知の型を指定されました。type:%s', Convert::toDebugString($this->type)));
    }
}
