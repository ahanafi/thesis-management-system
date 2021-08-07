<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted" => "Isian :attribute harus diterima.",
    "active_url" => "Isian :attribute bukan URL yang valid.",
    "after" => "Isian :attribute harus tanggal setelah :date.",
    'after_or_equal' => 'Isian :attribute harus tanggal setelah atau sama dengan :date.',
    "alpha" => "Isian :attribute hanya boleh berisi huruf.",
    "alpha_dash" => "Isian :attribute hanya boleh berisi huruf, angka, dan strip.",
    "alpha_num" => "Isian :attribute hanya boleh berisi huruf dan angka.",
    "array" => "Isian :attribute harus berupa sebuah array.",
    "before" => "Isian :attribute harus tanggal sebelum :date.",
    'before_or_equal' => 'Isian :attribute harus tanggal sebelum atau sama dengan :date.',
    "between" => [
        "numeric" => "Isian :attribute harus antara :min dan :max.",
        "file" => "Isian :attribute harus antara :min dan :max kilobytes.",
        "string" => "Isian :attribute harus antara :min dan :max karakter.",
        "array" => "Isian :attribute harus antara :min dan :max item.",
    ],
    'boolean' => 'Isian :attribute harus berupa true atau false.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'date' => 'Isian :attribute bukan tanggal yang valid.',
    'date_equals' => 'Isian :attribute harus sama dengan tanggal :date.',
    'date_format' => 'Isian :attribute tidak cocok dengan format :format.',
    'different' => 'Isian :attribute dan :other harus berbeda.',
    "digits" => "Isian :attribute harus berupa angka :digits.",
    "digits_between" => "Isian :attribute harus antara angka :min dan :max.",
    'dimensions' => 'Dimensi gambar :attribute tidak valid.',
    'distinct' => 'Isian :attribute terduplikat.',
    "email" => "Isian :attribute harus berupa alamat surel yang valid.",
    "exists" => "Isian :attribute yang dipilih tidak valid.",
    'ends_with' => 'Isian :attribute harus diakhiri dengan: :values.',
    'file' => 'Isian :attribute harus berupa file.',
    "filled" => "Bidang isian :attribute wajib diisi.",
    'gt' => [
        'numeric' => 'Isian :attribute harus lebih besar dari :value.',
        'file' => 'Ukuran :attribute harus lebih besar dari :value kilobytes.',
        'string' => 'Isian :attribute harus lebih besar dari :value karakter.',
        'array' => 'Isian :attribute harus lebih besar dari item :value.',
    ],
    'gte' => [
        'numeric' => 'Isian :attribute harus lebih besar atau sama dengan :value.',
        'file' => 'Isian :attribute harus lebih besar atau sama dengan :value kilobytes.',
        'string' => 'Isian :attribute harus lebih besar atau sama dengan :value karakter.',
        'array' => 'Isian :attribute harus sama sama atau lebih dengan item :value.',
    ],
    "image" => "Isian :attribute harus berupa gambar.",
    "in" => "Isian :attribute yang dipilih tidak valid.",
    'in_array' => 'Isian :attribute tidak terdapat pada :other.',
    "integer" => "Isian :attribute harus merupakan bilangan bulat.",
    "ip" => "Isian :attribute harus berupa alamat IP yang valid.",
    'ipv4' => 'Isian :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => 'Isian :attribute harus berupa alamat IPv6 yang valid.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'Isian :attribute harus kurang dari :value.',
        'file' => 'Isian :attribute harus kurang dari :value kilobytes.',
        'string' => 'Isian :attribute harus kurang dari :value karakter.',
        'array' => 'Isian :attribute must have less than :value item.',
    ],
    'lte' => [
        'numeric' => 'Isian :attribute harus kurang dari or equal :value.',
        'file' => 'Isian :attribute harus kurang dari or equal :value kilobytes.',
        'string' => 'Isian :attribute harus kurang dari or equal :value karakter.',
        'array' => 'Isian :attribute tidak boleh lebih dari :value item.',
    ],
    'max' => [
        'numeric' => 'Isian :attribute tidak boleh lebih besar dari :max.',
        'file' => 'Isian :attribute tidak boleh lebih besar dari :max kilobytes.',
        'string' => 'Isian :attribute tidak boleh lebih besar dari :max karakter.',
        'array' => 'Isian :attribute tidak boleh lebih besar dari :max item.',
    ],
    "mimes" => "Isian :attribute harus dokumen berjenis : :values.",
    'mimetypes' => 'Isian :attribute harus dokumen berjenis : :values.',
    "min" => [
        "numeric" => "Isian :attribute harus minimal :min.",
        "file" => "Isian :attribute harus minimal :min kilobytes.",
        "string" => "Isian :attribute harus minimal :min karakter.",
        "array" => "Isian :attribute harus minimal :min item.",
    ],
    "not_in" => "Isian :attribute yang dipilih tidak valid.",
    'not_regex' => 'Format isian :attribute tidak valid.',
    'numeric' => 'Isian :attribute harus berupa angka.',
    'password' => 'Kata sandi salah.',
    'present' => 'Isian :attribute harus ada.',
    'regex' => 'Format isian :attribute tidak valid.',
    'required' => 'Isian :attribute harus diisi.',
    "required_if" => "Bidang isian :attribute wajib diisi bila :other adalah :value.",
    'required_unless' => 'Bidang isian :attribute wajib diisi kecuali :other berisi :values.',
    "required_with" => "Bidang isian :attribute wajib diisi bila terdapat :values.",
    "required_with_all" => "Bidang isian :attribute wajib diisi bila terdapat :values.",
    "required_without" => "Bidang isian :attribute wajib diisi bila tidak terdapat :values.",
    "required_without_all" => "Bidang isian :attribute wajib diisi bila tidak terdapat ada :values.",
    "same" => "Isian :attribute dan :other harus sama.",
    "size" => [
        "numeric" => "Isian :attribute harus berukuran :size.",
        "file" => "Isian :attribute harus berukuran :size kilobyte.",
        "string" => "Isian :attribute harus berukuran :size karakter.",
        "array" => "Isian :attribute harus mengandung :size item.",
    ],
    'starts_with' => 'Isian :attribute harus diawali dengan: :values.',
    'string' => 'Isian :attribute harus berupa string.',
    "timezone" => "Isian :attribute harus berupa zona waktu yang valid.",
    "unique" => "Isian :attribute sudah ada sebelumnya.",
    'uploaded' => 'Isian :attribute gagal diupload.',
    "url" => "Format isian :attribute tidak valid.",
    'uuid' => 'Isian :attribute harus berupa UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
