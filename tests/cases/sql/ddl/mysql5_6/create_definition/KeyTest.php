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

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6\create_definition;

use fw3_for_old\builders\sql\ddl\mysql5_6\create_definition\Key;
use fw3_for_old\ez_test\test_unit\AbstractTest;

/**
 * Key
 */
class KeyTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\create_definition\\Key";
    protected static $NONE_ERROR    = array();

    public function testKey()
    {
        $key    = Key::factory();

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $key;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($key->exists());

        $expected   = '';
        $actual     = $key->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $key->unique();
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($key->exists());

        $expected   = 'UNIQUE KEY';
        $actual     = $key->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $key->primary();
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($key->exists());

        $expected   = 'PRIMARY KEY';
        $actual     = $key->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $key->unique();
        $this->assertTrue($key->exists());

        $expected   = self::CLASS_PATH;
        $actual     = $key->unsetKey();
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($key->exists());

        $expected   = '';
        $actual     = $key->build();
        $this->assertSame($expected, $actual);
    }
}
