<?php

declare(strict_types=1);

use SFW\Data\Str;

// mb_str_pad test
(function () {
    $checkList = [
        ['aa', 10, 'aa        '],
        ['ああ', 10, 'ああ      '],
        ['aa', 10, '        aa', STR_PAD_LEFT],
        ['ああ', 10, '      ああ', STR_PAD_LEFT],
        ['aa', 10, '    aa    ', STR_PAD_BOTH],
        ['ああ', 10, '   ああ   ', STR_PAD_BOTH],
    ];

    foreach ($checkList as $idx => $row) {
        $input = $row[0];
        $pad_length = $row[1];
        $result = $row[2];
        $pad_type = $row[3] ?? null;
        if ($pad_type === null) {
            $this->check("mb_str_pad test {$idx} null [{$result}]", Str::mb_str_pad($input, $pad_length) === $result);
        } else {
            $this->check("mb_str_pad test {$idx} [{$result}]", Str::mb_str_pad($input, $pad_length, pad_type: $pad_type) === $result);
        }
    }
})();

// template test
(function () {
    $checkList = [
        ['xxxxx{val1}xxxxx', ['val1' => 'あああ', 'val2' => 'いいい'], 'xxxxxあああxxxxx', ['val2' => 'いいい']],
        ['{val1}xxxxx{val1}xxx{val1}xx', ['val1' => 'あああ'], 'あああxxxxxあああxxxあああxx', []],
        ['xxxxx{val1}xxxxx{val2}', ['val1' => 'あああ', 'val2' => 'いいい', 'val3' => 'ううう', 'val4' => 'えええ'], 'xxxxxあああxxxxxいいい', ['val3' => 'ううう', 'val4' => 'えええ']],
    ];

    foreach ($checkList as $idx => $row) {
        $input = $row[0];
        $vars = $row[1];
        $result = $row[2];
        $rest = $row[3];

        $this->check("template test {$idx} [{$result}]", Str::template($input, $vars) === $result);

        $ret = Str::template($input, $vars, true);
        $this->check("template test {$idx} [{$result}] detail text", $ret['text'] === $result);
        $this->check("template test {$idx} [{$result}] detail rest", $ret['rest'] === $rest);
    }
})();
