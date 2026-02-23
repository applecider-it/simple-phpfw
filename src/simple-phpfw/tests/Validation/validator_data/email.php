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
        ['val' => ['email'],],
        ['val' => 'label',],
        false,
        1,
    ],
    [
        ['val' => 'aaa@bbb.ccc',],
        ['val' => ['email'],],
        ['val' => 'label',],
        true,
        null,
    ],
    [
        ['val' => '',],
        ['val' => ['required', 'email'],],
        ['val' => 'label',],
        false,
        2,
    ],
    [
        ['val' => '',],
        ['val' => ['nullable', 'required', 'email'],],
        ['val' => 'label',],
        true,
        null,
    ],
    [
        ['val' => 'a',],
        ['val' => ['nullable', 'required', 'email'],],
        ['val' => 'label',],
        false,
        1,
    ],
    [
        ['val' => 'aaa@bbb.ccc',],
        ['val' => ['nullable', 'required', 'email'],],
        ['val' => 'label',],
        true,
        null,
    ],
];
