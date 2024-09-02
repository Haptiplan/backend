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

    'accepted' => 'Das :attribute Feld muss akzepiert werden.',
    'accepted_if' => 'Das :attribute Feldmuss akzepiert werden, wenn :other :value beträgt.',
    'active_url' => 'Das :attribute Feld muss eine gültige URL sein.',
    'after' => 'Das :attribute Feld muss ein Datum nach :date sein.',
    'after_or_equal' => 'Das :attribute Feld muss das selbe oder ein Datum nach :date sein.',
    'alpha' => 'Das :attribute Feld darf nur Buchstaben enthalten.',
    'alpha_dash' => 'Das :attribute Feld darf nur Buchstaben, Nummern, Binde- und Unterstriche enthalten.',
    'alpha_num' => 'Das :attribute Feld darf nur Buchstaben und Nummern enthalten.',
    'array' => 'Das :attribute Feld muss ein Array sein.',
    'ascii' => 'Das :attribute Feld darf nur alphanumerische SingleByte-Zeichen enthalten.',
    'before' => 'Das :attribute Feld muss ein Datum vor :date sein.',
    'before_or_equal' => 'Das :attribute Feld muss das selbe oder ein Datum vor :date sein.',
    'between' => [
        'array' => 'Das :attribute Feld muss zwischen :min und :max Einheiten enthalten.',
        'file' => 'Der Inhalt des :attribute Feldes muss zwischen :min und :max Kilobytes liegen.',
        'numeric' => 'Das :attribute Feld muss zwischen :min und :max liegen.',
        'string' => 'Das :attribute Feld darf zwischen :min und :max Buchstaben besitzen.',
    ],
    'boolean' => 'Das :attribute Feld darf wahr oder falsch sein.',
    'can' => 'Das :attribute Feld enthält einen unauthorisierten Wert.',
    'companyUsedInGame' => 'Der Name des Unternehmens ist in diesem Spiel schon vergeben!',
    'confirmed' => 'Die :attribute Bestätigung ist stimmt nicht überein.',
    'current_password' => 'Das Passwort ist falsch.',
    'date' => 'Das :attribute Feld muss ein gültiges Datum sein.',
    'date_equals' => 'Das :attribute Feld muss das selbe Datum wie :date sein.',
    'date_format' => 'Das :attribute Feld muss im Format :format sein.',
    'decimal' => 'Das :attribute Feld muss :decimal Nachkommastellen haben.',
    'declined' => 'Das :attribute Feld muss abgelehnt sein.',
    'declined_if' => 'Das :attribute Feld muss abgelehnt sein, wenn :other :value beträgt.',
    'different' => 'Die Felder :attribute und :other müssen unterschiedlich sein.',
    'digits' => 'Das :attribute Feld muss :digits Ziffern betragen.',
    'digits_between' => 'Das :attribute Feld darf zwischen :min und :max Ziffern betragen.',
    'dimensions' => 'Das :attribute Feld hat eine ungültige Bildgröße.',
    'distinct' => 'Das :attribute Feld hat doppelte Inhalte.',
    'doesnt_end_with' => 'Das :attribute Feld darf nicht mit den folgenden Werten enden: :values.',
    'doesnt_start_with' => 'Das :attribute Feld darf nicht mit den folgenden Werten anfangen: :values.',
    'email' => 'Das :attribute Feld muss eine gültige Email Adresse enthalten.',
    'ends_with' => 'Das :attribute Feld muss mit folgenden Werten enden: :values.',
    'enum' => 'Der ausgewählte Wert für :attribute ist ungültig.',
    'exists' => 'Der ausgewählte Wert existiert nicht in :attribute.',
    'extensions' => 'Das :attribute Feld muss eine der folgenden Erwiterungen haben: :values.',
    'file' => 'Das :attribute Feld muss eine Datei sein.',
    'filled' => 'Das :attribute Feld muss einen Wert haben.',
    'gt' => [
        'array' => 'Das :attribute Feld muss mehr als :value Einheiten haben.',
        'file' => 'Die :attribute Datei muss größer als :value Kilobytes sein.',
        'numeric' => 'Die :attribute Nummer muss größer als :value sein.',
        'string' => 'Der Inhalt des :attribute Feldes muss länger als :value sein.',
    ],
    'gte' => [
        'array' => 'Das :attribute Feld muss mindestens :value Einheiten haben.',
        'file' => 'Die :attribute Datei muss mindestens :value Kilobytes groß sein.',
        'numeric' => 'Die :attribute Nummer muss mindestens :value groß sein.',
        'string' => 'Der Inhalt des :attribute Feldes muss mindestens :value Zeichen lang sein.',
    ],
    'hex_color' => 'Das :attribute Feld muss eine gültige Hexadezimal Farbe enthalten.',
    'image' => 'Das :attribute Feld muss eine Bilddatei enthalten.',
    'in' => 'Der ausgewählte Wert für :attribute ist ungültig.',
    'in_array' => 'Der Wer für :attribute muss in :other vorhanden sein.',
    'integer' => 'Der Wert für :attribute muss ein Integer Wert sein.',
    'ip' => 'Das :attribute Feld muss eine gültige IP Adresse enthalten.',
    'ipv4' => 'Das :attribute Feld muss eine gültige IPv4 Adresse enthalten.',
    'ipv6' => 'Das :attribute Feld muss eine gültige IPv6 Adresse enthalten.',
    'json' => 'Das :attribute Feld muss einen gültigen JSON String enthalten.',
    'list' => 'Das :attribute Feld muss eine Liste enthalten.',
    'lowercase' => 'Das :attribute Feld muss aus Kleinbuchstaben bestehen.',
    'lt' => [
        'array' => 'Das :attribute Feld muss weniger als :value Einheiten haben.',
        'file' => 'Die :attribute Datei muss kleiner als :value Kilobytes sein.',
        'numeric' => 'Die :attribute Nummer muss kleiner als :value sein.',
        'string' => 'Der Inhalt des :attribute Feldes muss kürzer als :value sein.',
    ],
    'lte' => [
        'array' => 'Das :attribute darf nicht mehr als :value Einheiten haben.',
        'file' => 'Die :attribute Datei darf nicht größer als :value Kilobytes sein.',
        'numeric' => 'Die :attribute Nummer darf höchstens :value sein.',
        'string' => 'Der Inhalt des :attribute Feldes darf höchstens :value Zeichen haben.',
    ],
    'mac_address' => 'Das :attribute Feld muss eine gültige MAC Adresse enthalten.',
    'max' => [
        'array' => 'Das :attribute darf maximal :max Einheiten haben.',
        'file' => 'Die :attribute Datei darf maximal :max Kilobytes groß sein.',
        'numeric' => 'Die :attribute Nummer darf maximal :max groß sein.',
        'string' => 'Der Inhalt des :attribute Feldes darf maximal :max Zeichen haben.',
    ],
    'max_digits' => 'Das :attribute Feld darf maximal :max Ziffern enhalten.',
    'mimes' => 'Das :attribute Feld muss Dateien der Dateitypen: :values haben.',
    'mimetypes' => 'Das :attribute Feld muss Dateien der Dateitypen: :values haben.',
    'min' => [
        'array' => 'Das :attribute muss mindestens :min Einheiten haben.',
        'file' => 'Die :attribute Datei muss mindestens :min Kilobytes groß sein.',
        'numeric' => 'Die :attribute Nummer muss mindestens :min groß sein.',
        'string' => 'Der Inhalt des :attribute Feldes muss mindestens :min Zeichen haben.',
    ],
    'min_digits' => 'Das :attribute Feld muss mindestens :min Ziffern haben.',
    'missing' => 'Das :attribute Feld muss leer sein.',
    'missing_if' => 'Das :attribute Feld muss leer sein, wenn :other :value beträgt.',
    'missing_unless' => 'Das :attribute Feld muss fehlen, außer :other beträgt :value.',
    'missing_with' => 'Das :attribute Feld muss fehlen, solange :values vorhanden ist.',
    'missing_with_all' => 'Das :attribute Feld muss Fehlen, solange alle :values vorhanden sind.',
    'multiple_of' => 'Der Inhalt des :attribute Feldes muss ein Vielfaches von :value sein.',
    'not_in' => 'Der ausgewählte Wert von :attribute ist ungültig.',
    'not_regex' => 'Das Format im :attribute Feld ist ungültig.',
    'numeric' => 'Der Inhalt vom :attribute Feld muss eine Nummer sein.',
    'password' => [
        'letters' => 'Es muss mindestens ein Buchstabe im :attribute Feld vorhanden sein.',
        'mixed' => 'Es muss mindestens ein Groß- und ein Kleinbuchstabe im :attribute Feld vorhanden sein.',
        'numbers' => 'Es muss mindestens eine Nummer im :attribute Feld vorhanden sein.',
        'symbols' => 'Es muss mindestens ein Symbol im :attribute Feld vorhanden sein.',
        'uncompromised' => 'Das eingegebene :attribute ist in einem Datenleck aufgetreten. Bitte verwenden Sie etwas anderes für :attribute.',
    ],
    'present' => 'Das :attribute Feld muss vorhanden sein.',
    'present_if' => 'Das :attribute Feld muss vorhanden sein, wenn :other :value beträgt.',
    'present_unless' => 'Das :attribute Feld muss vorhanden sein, außer :other beträgt :value.',
    'present_with' => 'Das  :attribute Feld muss vorhanden sein, wenn :values vorhanden ist.',
    'present_with_all' => 'Das :attribute Feld muss vorhanden sein, wenn alle :values vorhanden sind.',
    'prohibited' => 'Das :attribute Feld ist verboten.',
    'prohibited_if' => 'Das :attribute Feld ist verboten, wenn :other :value beträgt.',
    'prohibited_unless' => 'Das :attribute Feld ist verboten, außer :other beträgt :values.',
    'prohibits' => 'Das :attribute Feld verbietet :other vorhanden zu sein.',
    'regex' => 'Das Format des :attribute Feldes ist ungültig.',
    'required' => 'Das :attribute Feld ist benötigt.',
    'required_array_keys' => 'Das :attribute Feld muss Einträge für: :values enthalten.',
    'required_if' => 'Das :attribute Feld ist notwendig, wenn :other :value beträgt.',
    'required_if_accepted' => 'Das :attribute Feld ist notwendig, wenn :other akzeptiert wurde.',
    'required_unless' => 'Das :attribute Feld ist notwendig, außer :other beträgt :values.',
    'required_with' => 'Das :attribute Feld ist benötigt, wenn :values vorhanden ist.',
    'required_with_all' => 'Das :attribute ist benötigt, wenn alle :values vorhanden sind.',
    'required_without' => 'Das :attribute Feld ist benötigt, wenn :values nicht vorhanden sind.',
    'required_without_all' => 'Das :attribute Feld ist benötigt, wenn alle :values vorhanden sind.',
    'same' => 'Das :attribute muss mit :other übereinstimmen.',
    'size' => [
        'array' => 'Das :attribute muss :size Einheiten besitzen.',
        'file' => 'Die :attribute Datei muss :size Kilobytes groß sein.',
        'numeric' => 'Die :attribute Nummer muss groß :size sein.',
        'string' => 'Der :attribute Inhalt muss :size Zeichen lang sein.',
    ],
    'starts_with' => 'Das :attribute Feld muss mit: :values beginnen.',
    'string' => 'Das :attribute Feld muss ein String enthalten.',
    'timezone' => 'Das :attribute Feld muss eine gültige Zeitzone sein.',
    'unique' => 'Das :attribute ist schon vergeben.',
    'uploaded' => 'Fehler beim Upload von :attribute.',
    'uppercase' => 'Das :attribute Feld muss in Großbuchstaben sein.',
    'url' => 'Das :attribute Feld muss eine gültige URL sein.',
    'ulid' => 'Das :attribute Feld muss eine gültige ULID sein.',
    'uuid' => 'Das :attribute Feld muss eine gültige UUID sein.',

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

    'attributes' => [
        'company_id' => 'Unternehmens ID',
        'created_at' => 'erstellt am',
        'current_period_number' => 'aktuelle Perioden Nummer',
        'email' => 'E-Mail Adresse',
        'game_id' => 'Spiel ID',
        'id' => 'ID',
        'name' => 'Name',
        'password' => 'Passwort',
        'role' => 'Rolle',
        'updated_at' => 'aktualisiert am',
    ],

];
