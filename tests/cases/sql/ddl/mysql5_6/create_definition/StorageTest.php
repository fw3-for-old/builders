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

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6\create_definition;

use fw3_for_old\builders\sql\ddl\mysql5_6\create_definition\Storage;
use fw3_for_old\ez_test\test_unit\AbstractTest;

/**
 * Storage
 */
class StorageTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\create_definition\\Storage";
    protected static $NONE_ERROR    = array();

    public function testStorage()
    {
        $storage   = Storage::factory();

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $storage;
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($storage->exists());

        $expected   = '';
        $actual     = $storage->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $storage->disk();
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($storage->exists());

        $expected   = 'STORAGE DISK';
        $actual     = $storage->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $storage->memory();
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($storage->exists());

        $expected   = 'STORAGE MEMORY';
        $actual     = $storage->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $storage->defaultFormat();
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($storage->exists());

        $expected   = 'STORAGE DEFAULT';
        $actual     = $storage->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $storage->disk();
        $this->assertTrue($storage->exists());

        $expected   = self::CLASS_PATH;
        $actual     = $storage->unsetFormat();
        $this->assertInstanceOf($expected, $actual);
        $this->assertFalse($storage->exists());

        $expected   = '';
        $actual     = $storage->build();
        $this->assertSame($expected, $actual);
    }
}
