# Flywheel3 Eazy Builder for old php versions

Rapid Development FrameworkであるFlywheel3 の簡易ビルダーです。

## 対象バージョンおよび動作確認バージョン

対象バージョン：PHP5.3.3以降

### 動作確認バージョン


- **5.3.3**
- 5.3.4
- 5.3.5
- 5.3.6
- 5.3.7
- 5.3.8
- **5.3.9**
- 5.4.16
- 5.4.39
- **5.4.45**
- **5.5.38**
- **5.6.40**
- **7.0.33**
- **7.1.33**
- **7.2.33**
- **7.3.21**
- **7.4.0**
- **7.4.9**
- **8.0.0**
- **8.0.3**

## 主な機能

### DDL Builder For MySQL 5.6

MySQL 5.6向けの簡易的なDDL Builderです。

### 実行後例

コード

```
$table  = Table::factory('test_table');

$table->add(
    $table->column('primary_id')->int()->unsigned()->notNull()->autoIncrement()->comment('プライマリID'),
    $table->column('secondary_id')->int()->unsigned()->notNull()->comment('セカンダリID'),
    $table->column('name')->varchar(50)->defaultValue(null)->comment('名前'),
    $table->column('sex')->tinyint()->defaultValue(0)->comment('性別', array(
        'unknown'   => array(0, '未選択'),
        'male'      => array(1, '男性'),
        'female'    => array(2, '女性'),
        'other'     => array(3, 'その他'),
    )),
    $table->column('mail_address')->varchar(191)->notNull()->comment('連絡先メールアドレス'),
    $table->column('star')->int()->defaultValue(0)->comment('いいねの数'),
    $table->column('remarks')->text()->comment('備考'),
    $table->index(array('secondary_id', 'name')),
    $table->index('mail_address')->unique()
);

$table->primaryKey('primary_id');

$table->innoDb();

$table->utf8mb4();

$table->collation(Collation::factory()->utf8mb4()->japanese()->ci());

$table->comment('簡易DDLビルダーサンプル');

echo $table->build();
```

実行結果：PHP5.4以降の場合

```
CREATE TABLE `test_table` (
  `primary_id`    int unsigned  NOT NULL              AUTO_INCREMENT  COMMENT 'プライマリID',
  `secondary_id`  int unsigned  NOT NULL                              COMMENT 'セカンダリID',
  `name`          varchar(50)             DEFAULT ''                  COMMENT '名前',
  `sex`           tinyint                 DEFAULT '0'                 COMMENT '性別 const:{"unknown":[0,"未選択"],"male":[1,"男性"],"female":[2,"女性"],"other":[3,"その他"]}',
  `mail_address`  varchar(191)  NOT NULL                              COMMENT '連絡先メールアドレス',
  `star`          int                     DEFAULT '0'                 COMMENT 'いいねの数',
  `remarks`       text                                                COMMENT '備考',
  PRIMARY KEY (`primary_id`),
  INDEX         idx_mul01_test_table        (`secondary_id`, `name`),
  UNIQUE INDEX  idx_mail_address_test_table (`mail_address`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 DEFAULT COLLATE=utf8mb4_japanese_ci COMMENT '簡易DDLビルダーサンプル';
```

実行結果：PHP5.3の場合

```
CREATE TABLE `test_table` (
  `primary_id`    int unsigned  NOT NULL              AUTO_INCREMENT  COMMENT 'プライマリID',
  `secondary_id`  int unsigned  NOT NULL                              COMMENT 'セカンダリID',
  `name`          varchar(50)             DEFAULT ''                  COMMENT '名前',
  `sex`           tinyint                 DEFAULT '0'                 COMMENT '性別 const:{"unknown":[0,"\u672a\u9078\u629e"],"male":[1,"\u7537\u6027"],"female":[2,"\u5973\u6027"],"other":[3,"\u305d\u306e\u4ed6"]}',
  `mail_address`  varchar(191)  NOT NULL                              COMMENT '連絡先メールアドレス',
  `star`          int                     DEFAULT '0'                 COMMENT 'いいねの数',
  `remarks`       text                                                COMMENT '備考',
  PRIMARY KEY (`primary_id`),
  INDEX         idx_mul01_test_table        (`secondary_id`, `name`),
  UNIQUE INDEX  idx_mail_address_test_table (`mail_address`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 DEFAULT COLLATE=utf8mb4_japanese_ci COMMENT '簡易DDLビルダーサンプル';
```

## 使い方

### 1 . インストール

#### composerを使用できる環境の場合

次のコマンドを実行し、インストールしてください。

`composer require fw3_for_old/builders`

### 2 . DDLの構築（必要最小限の場合）

**お知らせ**

`index`などの例外を除き、原則として設定メソッドは全てメソッドチェーンが有効となっています。

1. テーブル名を付けたテーブルインスタンスを生成します。

```
$table  = Table::factory('テーブル名');
```

2. カラムを追加します。

最低限、カラム名と型が必要です。

```
$table->add(
    $table->column('primary_id')->int()
);
```

3. ビルドします。

```
echo $table->build();
```

次のように表示されます。

```
CREATE TABLE `テーブル名` (
  `primary_id`  int
);
```

一息に次のように書くこともできます。

```
echo Table::factory('テーブル名')->add(function ($table) {
    return array(
        $table->column('primary_id')->int()
    );
})->build();
```

### 3. 細やかな設定

#### Table

この段落では`$table = Table::factory($table_name);`としてインスタンス生成済みとして解説します。

##### ストレージエンジンの指定

| 指定対象 | 指定の仕方 |
----|----
| ストレージエンジンとしてInnoDBを使用します。 | `$table->innoDb();` |
| ストレージエンジンとしてMyIsamを使用します。 | `$table->myIsam();` |
| ストレージエンジンとしてMEMORYを使用します。 | `$table->memory();` |
| ストレージエンジンとしてCSVを使用します。 | `$table->csv();` |
| ストレージエンジンとしてARCHIVEを使用します。 | `$table->archive();` |
| ストレージエンジンとしてBLACKHOLEを使用します。 | `$table->blackhole();` |
| ストレージエンジンとしてMERGEを使用します。	 | `$table->merge();` |
| ストレージエンジンとしてFEDERATEDを使用します。 | `$table->federated();` |
| ストレージエンジンとしてEXAMPLEを使用します。	 | ``$table->example();` |

##### デフォルト文字セットの指定

| 指定対象 | 指定の仕方 |
----|----
| デフォルト文字セットとしてlatin1を使用します。 | `$table->latin1();` |
| デフォルト文字セットとしてbinaryを使用します。 | `$table->binary();` |
| デフォルト文字セットとしてcp932を使用します。 | `$table->sjisWin();` |
| デフォルト文字セットとしてeuc-jpを使用します。 | `$table->eucJpWin();` |
| デフォルト文字セットとしてutf8mb4を使用します。 | `$table->utf8mb4();` |

##### 照合順序の設定

後述の[Collation](#Collation)で解説する`Collation`インスタンスを引数として与えます。

```
$table->collation(Collation::factory()->utf8mb4()->general()->ci());
```

##### テーブルコメントの設定

```
$table->comment('コメント');
```

##### カラムインスタンスの生成

カラムインスタンスを生成するのみで、追加は行いません。
追加は[`Table::add();`](#カラムやインデックスの追加)を使用してください。

```
$table->column('カラム名');
```

##### インデックスインスタンスの生成

インデックスインスタンスを生成するのみで、追加は行いません。
追加は[`Table::add();`](#カラムやインデックスの追加)を使用してください。

シングルカラムの場合

```
$table->index('対象カラム1', 'インデックス名');
```

マルチカラムの場合

```
$table->index(array('対象カラム1', '対象カラム2'), 'インデックス名');
```

##### プライマリキーの設定

シングルカラムの場合

```
$table->primaryKey('対象カラム1');
```

マルチカラムの場合

```
$table->primaryKey(array('対象カラム1', '対象カラム2'));
```

##### カラムやインデックスの追加

[`Table::column()`](#Column)メソッドや[`Table::index()`](#index)メソッドを用いて作成したインスタンスを追加する事で実現します。

複数の与え方があります。

即値評価

```
$table->add(array(
    $table->column('カラム1'),
    $table->index('カラム1'),
));
```

```
$table->add(
    $table->column('カラム1'),
    $table->index('カラム1'),
);
```

遅延評価

```
$table->add(function ($table) {
    return array(
        $table->column('カラム1'),
        $table->index('カラム1'),
    );
});
```

```
$table->add(function ($table) {
    $table->add(
        $table->column('カラム1'),
        $table->index('カラム1'),
    );
});
```

#### Collation

この段落では`$collation = Collation::factory();`としてインスタンス生成済みとして解説します。

##### 文字セットの指定

| 指定対象 | 指定の仕方 |
----|----
| 文字セットとしてlatin1を使用します。 | `$collation->latin1()` |
| 文字セットとしてbinaryを使用します。 | `$collation->binary()` |
| 文字セットとしてcp932を使用します。	 | `$collation->sjisWin()` |
| 文字セットとしてeuc-jpを使用します。 | `$collation->eucJpWin()` |
| 文字セットとしてutf8mb4を使用します。 | `$collation->utf8mb4()` |

##### 言語の指定

| 指定対象 | 指定の仕方 |
----|----
| 言語としてgeneralを使用します。 | `$collation->general()` |
| 言語としてjapaneseを使用します。 | `$collation->japanese()` |

##### 接尾辞の設定

| 指定対象 | 指定の仕方 |
----|----
| 接尾辞として`アクセントで区別しない`を使用します。	 | `$collation->accentInsensitive()` |
| 接尾辞として`アクセントで区別する`を使用します。	 | `$collation->accentSensitive()` |
| 接尾辞として`大文字小文字を区別しない`を使用します。 | `$collation->caseInsensitive()` |
| 接尾辞として`大文字小文字を区別しない`を使用します。 | `$collation->ci()` |
| 接尾辞として`大文字小文字を区別する`を使用します。	 | `$collation->caseSensitive()` |
| 接尾辞として`大文字小文字を区別する`を使用します。	 | `$collation->cs()` |
| 接尾辞として`バイナリコード順で取り扱う`を使用します。 | `$collation->bin()` |

#### Column

この段落では`$column = $table->column($column_name);`としてインスタンス生成済みとして解説します。

##### 型の設定

型の設定は必須です。

| 指定対象 | 指定の仕方 |
----|----
| このカラムをbit型とします。		 | `$column->bit($length = null);` |
| このカラムをtinyint型とします。	 | `$column->tinyint();` |
| このカラムをsmallint型とします。 | `$column->smallint();` |
| このカラムをmediumint型とします。 | `$column->mediumint();` |
| このカラムをbigint型とします。	 | `$column->bigint();` |
| このカラムをint型とします。		 | `$column->int();` |
| このカラムをreal型とします。	 | `$column->real($length = null, $decimals = null);` |
| このカラムをdouble型とします。	 | `$column->double($length = null, $decimals = null);` |
| このカラムをfloat型とします。	 | `$column->float($length = null, $decimals = null);` |
| このカラムをdecimal型とします。	 | `$column->decimal($length = null, $decimals = null);` |
| このカラムをnumeric型とします。	 | `$column->numeric($length = null, $decimals = null);` |
| このカラムをdate型とします。	 | `$column->date();` |
| このカラムをtime型とします。	 | `$column->time();` |
| このカラムをtimestamp型とします。 | `$column->timestamp();` |
| このカラムをdatetime型とします。 | `$column->datetime();` |
| このカラムをyear型とします。	 | `$column->year();` |
| このカラムをchar型とします。	 | `$column->char($length);` |
| このカラムをvarchar型とします。	 | `$column->varchar($length);` |
| このカラムをtext型とします。	 | `$column->text();` |
| このカラムをmediumtext型とします。 | `$column->mediumtext();` |
| このカラムをlongtext型とします。 | `$column->longtext();` |

##### 属性の設定

| 指定対象 | 指定の仕方 |
----|----
| このカラムを符号なしとします。 | `$column->unsigned();` |
| このカラムをバイナリとします。 | `$column->binary();` |
| このカラムをNOT NULLとします。 | `$column->notNull();` |
| このカラムをauto incrementとします。 | `$column->autoIncrement();` |
| このカラムにデフォルト値を設定します。 | `$column->defaultValue($value);` |

#### Index

この段落では`$index = $table->index($column_name);`としてインスタンス生成済みとして解説します。

##### インデックス対象カラムの指定

```
$index->column(column_name, $length, $order);
```

##### タイプの設定

| 指定対象 | 指定の仕方 |
----|----
| このインデックスをプライマリキーとします。 | `$index->primaryKey();` |
| このインデックスをユニークとします。 | `$index->unique();` |
| このインデックスをフルテキストとします。 | `$index->fulltext();` |