<?php

declare(strict_types=1);

use SFW\Validation\Validator;
use SFW\Validation\BasicValidations;

class TestValidator extends Validator
{
    use BasicValidations;
}

// TestValidator::make Test
(function () {
    $checkList = [];

    // 別ファイルにある設定は、ローカル変数を保護するためクロージャで囲って、読み込んでいる

    $checkList = array_merge($checkList, (fn() => include(__DIR__ . '/validator_data/numeric.php'))());
    $checkList = array_merge($checkList, (fn() => include(__DIR__ . '/validator_data/email.php'))());

    foreach ($checkList as $idx => $row) {
        $data = $row[0];
        $rules = $row[1];
        $labels = $row[2];
        $valid = $row[3];
        $errorsCnt = $row[4];

        $v = TestValidator::make($data, $rules, $labels);

        $result = $v->valid() === $valid;

        $info = json_encode($row);

        $this->check("TestValidator::make Test {$idx} result : " . $info, $result);

        if ($errorsCnt) {
            $errors = $v->errors();
            $cntResult = count($errors['val']) === $errorsCnt;

            $info .= json_encode($errors);

            $this->check("TestValidator::make Test {$idx} cntResult : " . $info, $cntResult);
        }
    }
})();
