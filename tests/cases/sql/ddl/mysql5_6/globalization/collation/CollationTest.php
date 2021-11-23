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

namespace fw3_for_old\builders\sql\ddl\mysql5_6\globalization\collation;

use fw3_for_old\builders\sql\ddl\mysql5_6\globalization\charset\Charset;
use fw3_for_old\ez_test\test_unit\AbstractTest;
use fw3_for_old\strings\converter\Convert;

/**
 * 照合順序
 */
class CollationTest extends AbstractTest
{
    const CLASS_PATH            = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\globalization\\collation\\Collation";
    const CHARSET_CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\globalization\\charset\\Charset";

    public function testFactory()
    {
        //----------------------------------------------
        $collation  = Collation::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Charset::DEFAULT_CHARSET;
        $actual     = $collation->charset();
        $this->assertSame($expected, $actual->build());

        $expected   = self::CHARSET_CLASS_PATH;
        $this->assertInstanceOf($expected, $actual);

        $this->assertFalse($actual->hasErrors());
        $this->assertFalse($actual->hasError('charset'));
        $this->assertSame(array(), $actual->getErrors());
        $this->assertSame(array(), $actual->getError('charset'));

        $this->assertFalse($collation->hasErrors());
        $this->assertFalse($collation->hasError('charset'));
        $this->assertSame(array(), $collation->getErrors());
        $this->assertSame(array(), $collation->getError('charset'));

        $expected   = Collation::DEFAULT_SUFFIX;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $actual);

        $this->assertFalse($collation->hasErrors());
        $this->assertFalse($collation->hasError('suffix'));
        $this->assertSame(array(), $collation->getErrors());
        $this->assertSame(array(), $collation->getError('suffix'));

        $expected   = Collation::DEFAULT_LANG;
        $actual     = $collation->lang();
        $this->assertSame($expected, $actual);

        $this->assertFalse($collation->hasErrors());
        $this->assertFalse($collation->hasError('lang'));
        $this->assertSame(array(), $collation->getErrors());
        $this->assertSame(array(), $collation->getError('lang'));

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::DEFAULT_CHARSET, Collation::DEFAULT_LANG, Collation::DEFAULT_SUFFIX);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory(array(
            'charset'   => Charset::CP932,
            'suffix'    => Collation::SUFFIX_CASE_SENSITIVE,
            'lang'      => Collation::LANG_JAPANESE,
        ));

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $this->assertFalse($actual->hasErrors());
        $this->assertSame(array(), $actual->getErrors());

        $this->assertFalse($actual->hasError('charset'));
        $this->assertSame(array(), $actual->getError('charset'));

        $this->assertFalse($collation->hasError('charset'));
        $this->assertSame(array(), $collation->getError('charset'));

        $this->assertFalse($collation->hasError('suffix'));
        $this->assertSame(array(), $collation->getError('suffix'));

        $this->assertFalse($collation->hasError('lang'));
        $this->assertSame(array(), $collation->getError('lang'));

        $expected   = Charset::CP932;
        $actual     = $collation->charset();
        $this->assertSame($expected, $actual->build());

        $expected   = self::CHARSET_CLASS_PATH;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_CASE_SENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $actual);

        $expected   = Collation::LANG_JAPANESE;
        $actual     = $collation->lang();
        $this->assertSame($expected, $actual);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::CP932, Collation::LANG_JAPANESE, Collation::SUFFIX_CASE_SENSITIVE);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory(array(
            'charset'   => Charset::CP932,
            'suffix'    => Collation::SUFFIX_CASE_SENSITIVE,
        ));

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $this->assertFalse($actual->hasErrors());
        $this->assertSame(array(), $actual->getErrors());

        $this->assertFalse($actual->hasError('charset'));
        $this->assertSame(array(), $actual->getError('charset'));

        $this->assertFalse($collation->hasError('charset'));
        $this->assertSame(array(), $collation->getError('charset'));

        $this->assertFalse($collation->hasError('suffix'));
        $this->assertSame(array(), $collation->getError('suffix'));

        $this->assertFalse($collation->hasError('lang'));
        $this->assertSame(array(), $collation->getError('lang'));

        $expected   = Charset::CP932;
        $actual     = $collation->charset();
        $this->assertSame($expected, $actual->build());

        $expected   = self::CHARSET_CLASS_PATH;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_CASE_SENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $actual);

        $expected   = Collation::LANG_GENERAL;
        $actual     = $collation->lang();
        $this->assertSame($expected, $actual);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::CP932, Collation::LANG_GENERAL, Collation::SUFFIX_CASE_SENSITIVE);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory(array(
            'charset'   => Charset::CP932,
            'suffix'    => Collation::SUFFIX_CASE_SENSITIVE,
            'lang'      => null,
        ));

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $this->assertFalse($actual->hasErrors());
        $this->assertSame(array(), $actual->getErrors());

        $this->assertFalse($actual->hasError('charset'));
        $this->assertSame(array(), $actual->getError('charset'));

        $this->assertFalse($collation->hasError('charset'));
        $this->assertSame(array(), $collation->getError('charset'));

        $this->assertFalse($collation->hasError('suffix'));
        $this->assertSame(array(), $collation->getError('suffix'));

        $this->assertFalse($collation->hasError('lang'));
        $this->assertSame(array(), $collation->getError('lang'));

        $expected   = Charset::CP932;
        $actual     = $collation->charset();
        $this->assertSame($expected, $actual->build());

        $expected   = self::CHARSET_CLASS_PATH;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_CASE_SENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $collation->lang();
        $this->assertSame($expected, $actual);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s', Charset::CP932, Collation::SUFFIX_CASE_SENSITIVE);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory(array(
            Charset::CP932,
            Collation::SUFFIX_CASE_SENSITIVE,
            Collation::LANG_JAPANESE,
        ));

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $this->assertFalse($actual->hasErrors());
        $this->assertSame(array(), $actual->getErrors());

        $this->assertFalse($actual->hasError('charset'));
        $this->assertSame(array(), $actual->getError('charset'));

        $this->assertFalse($collation->hasError('charset'));
        $this->assertSame(array(), $collation->getError('charset'));

        $this->assertFalse($collation->hasError('suffix'));
        $this->assertSame(array(), $collation->getError('suffix'));

        $this->assertFalse($collation->hasError('lang'));
        $this->assertSame(array(), $collation->getError('lang'));

        $expected   = Charset::CP932;
        $actual     = $collation->charset();
        $this->assertSame($expected, $actual->build());

        $expected   = self::CHARSET_CLASS_PATH;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_CASE_SENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $actual);

        $expected   = Collation::LANG_JAPANESE;
        $actual     = $collation->lang();
        $this->assertSame($expected, $actual);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::CP932, Collation::LANG_JAPANESE, Collation::SUFFIX_CASE_SENSITIVE);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory(array(
            Charset::CP932,
            Collation::SUFFIX_CASE_SENSITIVE,
        ));

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $this->assertFalse($actual->hasErrors());
        $this->assertSame(array(), $actual->getErrors());

        $this->assertFalse($actual->hasError('charset'));
        $this->assertSame(array(), $actual->getError('charset'));

        $this->assertFalse($collation->hasError('charset'));
        $this->assertSame(array(), $collation->getError('charset'));

        $this->assertFalse($collation->hasError('suffix'));
        $this->assertSame(array(), $collation->getError('suffix'));

        $this->assertFalse($collation->hasError('lang'));
        $this->assertSame(array(), $collation->getError('lang'));

        $expected   = Charset::CP932;
        $actual     = $collation->charset();
        $this->assertSame($expected, $actual->build());

        $expected   = self::CHARSET_CLASS_PATH;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_CASE_SENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $actual);

        $expected   = Collation::LANG_GENERAL;
        $actual     = $collation->lang();
        $this->assertSame($expected, $actual);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::CP932, Collation::LANG_GENERAL, Collation::SUFFIX_CASE_SENSITIVE);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory(array(
            Charset::CP932,
            Collation::SUFFIX_CASE_SENSITIVE,
            null,
        ));

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $this->assertFalse($actual->hasErrors());
        $this->assertSame(array(), $actual->getErrors());

        $this->assertFalse($actual->hasError('charset'));
        $this->assertSame(array(), $actual->getError('charset'));

        $this->assertFalse($collation->hasError('charset'));
        $this->assertSame(array(), $collation->getError('charset'));

        $this->assertFalse($collation->hasError('suffix'));
        $this->assertSame(array(), $collation->getError('suffix'));

        $this->assertFalse($collation->hasError('lang'));
        $this->assertSame(array(), $collation->getError('lang'));

        $expected   = Charset::CP932;
        $actual     = $collation->charset();
        $this->assertSame($expected, $actual->build());

        $expected   = self::CHARSET_CLASS_PATH;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_CASE_SENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $collation->lang();
        $this->assertSame($expected, $actual);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s', Charset::CP932, Collation::SUFFIX_CASE_SENSITIVE);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory(sprintf('%s_%s_%s', Charset::CP932, Collation::LANG_JAPANESE, Collation::SUFFIX_CASE_SENSITIVE));

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $this->assertFalse($actual->hasErrors());
        $this->assertSame(array(), $actual->getErrors());

        $this->assertFalse($actual->hasError('charset'));
        $this->assertSame(array(), $actual->getError('charset'));

        $this->assertFalse($collation->hasError('charset'));
        $this->assertSame(array(), $collation->getError('charset'));

        $this->assertFalse($collation->hasError('suffix'));
        $this->assertSame(array(), $collation->getError('suffix'));

        $this->assertFalse($collation->hasError('lang'));
        $this->assertSame(array(), $collation->getError('lang'));

        $expected   = Charset::CP932;
        $actual     = $collation->charset();
        $this->assertSame($expected, $actual->build());

        $expected   = self::CHARSET_CLASS_PATH;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_CASE_SENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $actual);

        $expected   = Collation::LANG_JAPANESE;
        $actual     = $collation->lang();
        $this->assertSame($expected, $actual);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::CP932, Collation::LANG_JAPANESE, Collation::SUFFIX_CASE_SENSITIVE);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory(sprintf('%s_%s', Charset::LATIN1, Collation::SUFFIX_CASE_SENSITIVE));

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $this->assertFalse($actual->hasErrors());
        $this->assertSame(array(), $actual->getErrors());

        $this->assertFalse($actual->hasError('charset'));
        $this->assertSame(array(), $actual->getError('charset'));

        $this->assertFalse($collation->hasError('charset'));
        $this->assertSame(array(), $collation->getError('charset'));

        $this->assertFalse($collation->hasError('suffix'));
        $this->assertSame(array(), $collation->getError('suffix'));

        $this->assertFalse($collation->hasError('lang'));
        $this->assertSame(array(), $collation->getError('lang'));

        $expected   = Charset::LATIN1;
        $actual     = $collation->charset();
        $this->assertSame($expected, $actual->build());

        $expected   = self::CHARSET_CLASS_PATH;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_CASE_SENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $actual);

        $expected   = null;
        $actual     = $collation->lang();
        $this->assertSame($expected, $actual);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s', Charset::LATIN1, Collation::SUFFIX_CASE_SENSITIVE);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $collation->latin1();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::LATIN1, Collation::DEFAULT_LANG, Collation::DEFAULT_SUFFIX);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $collation->binary();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::BINARY, Collation::DEFAULT_LANG, Collation::DEFAULT_SUFFIX);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $collation->sjisWin();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::CP932, Collation::DEFAULT_LANG, Collation::DEFAULT_SUFFIX);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $collation->eucJpWin();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::EUC_JPMS, Collation::DEFAULT_LANG, Collation::DEFAULT_SUFFIX);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $collation->utf8mb4();
        $this->assertInstanceOf($expected, $actual);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::UTF8MB4, Collation::DEFAULT_LANG, Collation::DEFAULT_SUFFIX);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);
    }

    public function testWith()
    {
        //----------------------------------------------
        $collation  = Collation::factory();

        $withCollation  = $collation->with();

        $expected   = $collation;
        $actual     = $withCollation;
        $this->assertNotSame($expected, $actual);

        $expected   = $collation->charset();
        $actual     = $withCollation->charset();
        $this->assertNotSame($expected, $actual);
    }

    public function testCharset()
    {
        //----------------------------------------------
        $charset  = Collation::factory()->charset(Charset::CP932);

        $expected   = self::CLASS_PATH;
        $actual     = $charset;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Charset::CP932;
        $actual     = $charset->charset();
        $this->assertSame($expected, $actual->charset());
        $this->assertFalse($charset->hasErrors());
        $this->assertFalse($charset->hasError('charset'));
        $this->assertSame(array(), $charset->getErrors());
        $this->assertSame(array(), $charset->getError('charset'));

        //----------------------------------------------
        $collation      = Collation::factory();
        $charset_name   = 'aaaaaaaa';
        $message        = sprintf('未知の文字セットを与えられました。charset:%s', Convert::toDebugString($charset_name, 2));

        $expected   = self::CLASS_PATH;
        $actual     = $collation->charset($charset_name);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($collation->hasErrors());
        $this->assertTrue($collation->hasError('charset'));
        $this->assertSame(array('charset' => array($message)), $collation->getErrors());
        $this->assertSame(array($message), $collation->getError('charset'));

        //----------------------------------------------
        // Collation経由ではnullを未知の文字セットとして設定する事は出来ない
        $collation      = Collation::factory();
        $charset_name   = null;
        $message        = sprintf('未知の文字セットを与えられました。charset:%s', Convert::toDebugString($charset_name, 2));

        $expected   = self::CLASS_PATH;
        $actual     = $collation->charset($charset_name);
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($collation->hasErrors());
        $this->assertFalse($collation->hasError('charset'));
        $this->assertNotSame(array('charset' => array($message)), $collation->getErrors());
        $this->assertNotSame(array($message), $collation->getError('charset'));


    }

    public function testLang()
    {
        //----------------------------------------------
        $collation  = Collation::factory()->lang(Collation::LANG_JAPANESE);

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::LANG_JAPANESE;
        $actual     = $collation->lang();
        $this->assertSame($expected, $collation->lang());
        $this->assertFalse($collation->hasErrors());
        $this->assertFalse($collation->hasError('lang'));
        $this->assertSame(array(), $collation->getErrors());
        $this->assertSame(array(), $collation->getError('lang'));

        //----------------------------------------------
        $collation  = Collation::factory();
        $lang_name  = 'aaaaaaaa';
        $message    = sprintf('未知の言語名を与えられました。lang:%s', Convert::toDebugString($lang_name, 2));

        $expected   = self::CLASS_PATH;
        $actual     = $collation->lang($lang_name);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($collation->hasErrors());
        $this->assertTrue($collation->hasError('lang'));
        $this->assertSame(array('lang' => array($message)), $collation->getErrors());
        $this->assertSame(array($message), $collation->getError('lang'));

        //----------------------------------------------
        // Collation経由ではnullを未知の文字名として設定する事は出来ない
        $collation  = Collation::factory();
        $lang_name  = null;
        $message    = sprintf('未知の言語名を与えられました。lang:%s', Convert::toDebugString($lang_name, 2));

        $expected   = self::CLASS_PATH;
        $actual     = $collation->lang($lang_name);
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($collation->hasErrors());
        $this->assertFalse($collation->hasError('lang'));
        $this->assertNotSame(array('lang' => array($message)), $collation->getErrors());
        $this->assertNotSame(array($message), $collation->getError('lang'));

        //----------------------------------------------
        $collation  = Collation::factory()->general();

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::LANG_GENERAL;
        $actual     = $collation->lang();
        $this->assertSame($expected, $collation->lang());

        //----------------------------------------------
        $collation  = Collation::factory()->japanese();

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::LANG_JAPANESE;
        $actual     = $collation->lang();
        $this->assertSame($expected, $collation->lang());
    }

    public function testSuffix()
    {
        //----------------------------------------------
        $collation  = Collation::factory()->suffix(Collation::SUFFIX_CASE_INSENSITIVE);

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_CASE_INSENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $collation->suffix());
        $this->assertFalse($collation->hasErrors());
        $this->assertFalse($collation->hasError('suffix'));
        $this->assertSame(array(), $collation->getErrors());
        $this->assertSame(array(), $collation->getError('suffix'));

        //----------------------------------------------
        $collation  = Collation::factory();
        $suffix_name  = 'aaaaaaaa';
        $message    = sprintf('未知のsuffixを与えられました。suffix:%s', Convert::toDebugString($suffix_name, 2));

        $expected   = self::CLASS_PATH;
        $actual     = $collation->suffix($suffix_name);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($collation->hasErrors());
        $this->assertTrue($collation->hasError('suffix'));
        $this->assertSame(array('suffix' => array($message)), $collation->getErrors());
        $this->assertSame(array($message), $collation->getError('suffix'));

        //----------------------------------------------
        $collation  = Collation::factory();
        $suffix_name  = null;
        $message    = sprintf('未知のsuffixを与えられました。suffix:%s', Convert::toDebugString($suffix_name, 2));

        $expected   = self::CLASS_PATH;
        $actual     = $collation->suffix($suffix_name);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($collation->hasErrors());
        $this->assertTrue($collation->hasError('suffix'));
        $this->assertSame(array('suffix' => array($message)), $collation->getErrors());
        $this->assertSame(array($message), $collation->getError('suffix'));

        //----------------------------------------------
        $collation  = Collation::factory()->accentInsensitive();

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_ACCENT_INSENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $collation->suffix());

        //----------------------------------------------
        $collation  = Collation::factory()->accentSensitive();

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_ACCENT_SENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $collation->suffix());

        //----------------------------------------------
        $collation  = Collation::factory()->caseInsensitive();

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_CASE_INSENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $collation->suffix());

        //----------------------------------------------
        $collation  = Collation::factory()->ci();

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_CASE_INSENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $collation->suffix());

        //----------------------------------------------
        $collation  = Collation::factory()->caseSensitive();

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_CASE_SENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $collation->suffix());

        //----------------------------------------------
        $collation  = Collation::factory()->cs();

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_CASE_SENSITIVE;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $collation->suffix());

        //----------------------------------------------
        $collation  = Collation::factory()->bin();

        $expected   = self::CLASS_PATH;
        $actual     = $collation;
        $this->assertInstanceOf($expected, $actual);

        $expected   = Collation::SUFFIX_BINARY;
        $actual     = $collation->suffix();
        $this->assertSame($expected, $collation->suffix());
    }

    public function testBuild()
    {
        //----------------------------------------------
        $collation  = Collation::factory();

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::DEFAULT_CHARSET, Collation::DEFAULT_LANG, Collation::DEFAULT_SUFFIX);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory();

        $collation->charset(Charset::EUC_JP_WIN);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::EUC_JP_WIN, Collation::DEFAULT_LANG, Collation::DEFAULT_SUFFIX);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory();

        $collation->lang(Collation::LANG_GENERAL);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::DEFAULT_CHARSET, Collation::LANG_GENERAL, Collation::DEFAULT_SUFFIX);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory();

        $collation->suffix(Collation::SUFFIX_ACCENT_INSENSITIVE);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::DEFAULT_CHARSET, Collation::DEFAULT_LANG, Collation::SUFFIX_ACCENT_INSENSITIVE);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory();

        $collation->charset(Charset::BINARY);
        $collation->suffix(Collation::SUFFIX_BINARY);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s_%s', Charset::BINARY, Collation::DEFAULT_LANG, Collation::SUFFIX_BINARY);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $collation  = Collation::factory();

        $collation->charset(Charset::BINARY);
        $collation->suffix(Collation::SUFFIX_BINARY);
        $collation->lang(null);

        $expected   = sprintf('DEFAULT COLLATE=%s_%s', Charset::BINARY, Collation::SUFFIX_BINARY);
        $actual     = $collation->build();
        $this->assertSame($expected, $actual);
    }

    public function testBuildException()
    {
        //----------------------------------------------
        $collation  = Collation::factory();

        $collation->charset(Charset::BINARY);
        $collation->suffix(Collation::SUFFIX_ACCENT_SENSITIVE);

        $message    = sprintf('使用できない文字セットと照合順序接尾辞です。charset:%s, suffix:%s', Charset::BINARY, Collation::SUFFIX_ACCENT_SENSITIVE);

        $this->assertException("\\Exception");
        $this->assertExceptionMessage($message);

        $collation->build();
    }
}
