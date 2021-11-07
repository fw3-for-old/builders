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

namespace fw3_for_old\tests\builders\sql\ddl\mysql5_6\storage_engine;

use fw3_for_old\ez_test\test_unit\AbstractTest;
use fw3_for_old\builders\sql\ddl\mysql5_6\storage_engine\StorageEngine;
use fw3_for_old\strings\converter\Convert;

/**
 * ストレージエンジン
 */
class StorageEngineTest extends AbstractTest
{
    const CLASS_PATH    = "\\fw3_for_old\\builders\\sql\\ddl\\mysql5_6\\storage_engine\\StorageEngine";

    public function testFactory()
    {
        //----------------------------------------------
        $storageEngine  = StorageEngine::factory();

        $expected   = self::CLASS_PATH;
        $actual     = $storageEngine;
        $this->assertInstanceOf($expected, $actual);

        $expected   = StorageEngine::DEFAULT_ENGINE;
        $actual     = $storageEngine->engine();
        $this->assertSame($expected, $actual);
        $this->assertFalse($storageEngine->hasErrors());
        $this->assertFalse($storageEngine->hasError('engine'));
        $this->assertSame(array(), $storageEngine->getErrors());
        $this->assertSame(array(), $storageEngine->getError('engine'));

        $expected   = sprintf('ENGINE=%s', StorageEngine::DEFAULT_ENGINE);
        $actual     = $storageEngine->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $storageEngine  = StorageEngine::factory(null);

        $expected   = self::CLASS_PATH;
        $actual     = $storageEngine;
        $this->assertInstanceOf($expected, $actual);

        $expected   = StorageEngine::DEFAULT_ENGINE;
        $actual     = $storageEngine->engine();
        $this->assertSame($expected, $actual);
        $this->assertFalse($storageEngine->hasErrors());
        $this->assertFalse($storageEngine->hasError('engine'));
        $this->assertSame(array(), $storageEngine->getErrors());
        $this->assertSame(array(), $storageEngine->getError('engine'));

        $expected   = sprintf('ENGINE=%s', StorageEngine::DEFAULT_ENGINE);
        $actual     = $storageEngine->build();
        $this->assertSame($expected, $actual);

        //----------------------------------------------
        $engine_name    = StorageEngine::CSV;

        $storageEngine  = StorageEngine::factory($engine_name);

        $expected   = self::CLASS_PATH;
        $actual     = $storageEngine;
        $this->assertInstanceOf($expected, $actual);

        $expected   = StorageEngine::CSV;
        $actual     = $storageEngine->engine();
        $this->assertSame($expected, $actual);
        $this->assertFalse($storageEngine->hasErrors());
        $this->assertFalse($storageEngine->hasError('engine'));
        $this->assertSame(array(), $storageEngine->getErrors());
        $this->assertSame(array(), $storageEngine->getError('engine'));

        $expected   = sprintf('ENGINE=%s', StorageEngine::CSV);
        $actual     = $storageEngine->build();
        $this->assertSame($expected, $actual);
    }

    public function testName()
    {
        $storageEngine  = StorageEngine::factory(StorageEngine::MEMORY);

        //----------------------------------------------
        $expected   = self::CLASS_PATH;
        $actual     = $storageEngine->engine(StorageEngine::CSV);
        $this->assertInstanceOf($expected, $actual);

        $expected   = StorageEngine::CSV;
        $actual     = $storageEngine->engine();
        $this->assertSame($expected, $actual);
        $this->assertFalse($storageEngine->hasErrors());
        $this->assertFalse($storageEngine->hasError('engine'));
        $this->assertSame(array(), $storageEngine->getErrors());
        $this->assertSame(array(), $storageEngine->getError('engine'));

        //----------------------------------------------
        $engine       = 'aaaaaaaa';
        $message    = sprintf('未知のストレージエンジン名を与えられました。engine:%s', Convert::toDebugString($engine, 2));

        $expected   = self::CLASS_PATH;
        $actual     = $storageEngine->engine($engine);
        $this->assertInstanceOf($expected, $actual);
        $this->assertTrue($storageEngine->hasErrors());
        $this->assertTrue($storageEngine->hasError('engine'));
        $this->assertSame(array('engine' => array($message)), $storageEngine->getErrors());
        $this->assertSame(array($message), $storageEngine->getError('engine'));
    }
}
