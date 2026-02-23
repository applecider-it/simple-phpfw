<?php

return [
    [
        ['val' => '',],
        ['val' => ['required'],],
        ['val' => 'label',],
        false,
        1,
    ],
    [
        ['val' => '',],
        ['val' => ['numeric'],],
        ['val' => 'label',],
        false,
        1,
    ],
    [
        ['val' => '1',],
        ['val' => ['numeric'],],
        ['val' => 'label',],
        true,
        null,
    ],
    [
        ['val' => '',],
        ['val' => ['required', 'numeric'],],
        ['val' => 'label',],
        false,
        2,
    ],
    [
        ['val' => '',],
        ['val' => ['nullable', 'required', 'numeric'],],
        ['val' => 'label',],
        true,
        null,
    ],
    [
        ['val' => 'a',],
        ['val' => ['nullable', 'required', 'numeric'],],
        ['val' => 'label',],
        false,
        1,
    ],
    [
        ['val' => '0',],
        ['val' => ['nullable', 'required', 'numeric'],],
        ['val' => 'label',],
        true,
        null,
    ],
];
