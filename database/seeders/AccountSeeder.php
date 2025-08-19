<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $accounts = [
    [
        'number' => '0500',
        'name' => 'unbebaute Grundstücke',
        'type' => 'Aktiv',
        'level' => 'AV',
    ],
    [
        'number' => '0510',
        'name' => 'bebaute Grundstücke',
        'type' => 'Aktiv',
        'level' => 'AV',

    ],
    [
        'number' => '0520',
        'name' => 'Gebäude',
        'type' => 'Aktiv',
        'level' => 'AV',
    ],


    [
        'number' => '0720',
        'name' => 'Anlagen und Maschinen',
        'type' => 'Aktiv',
        'level' => 'AV',
    ],

    [
        'number' => '0870',
        'name' => 'Betriebs- und Geschäftsausstattung',
        'type' => 'Aktiv',
        'level' => 'AV',
    ],

    [
        'number' => '0950',
        'name' => 'Anlagen im Bau',
        'type' => 'Aktiv',
        'level' => 'AV',
    ],

    [
        'number' => '2000',
        'name' => 'Rohstoffe',
        'type' => 'Aktiv',
    ],

    [
        'number' => '2010',
        'name' => 'Vorprodukte/Fremdbauteile',
        'type' => 'Aktiv',
    ],

    [
        'number' => '2200',
        'name' => 'Fertige Erzeugnisse',
        'type' => 'Aktiv',
    ],

    [
        'number' => '2400',
        'name' => 'Forderungen',
        'type' => 'Aktiv',
    ],

    [
        'number' => '2700',
        'name' => 'Wertpapiere',
        'type' => 'Aktiv',
    ],

    [
        'number' => '2800',
        'name' => 'Bank',
        'type' => 'Aktiv',
    ],

    [
        'number' => '3000',
        'name' => 'Eigenkapital',
        'type' => 'Passiv',
    ],

    [
        'number' => '3100',
        'name' => 'Kapitalrücklagen',
        'type' => 'Passiv',
    ],

    [
        'number' => '3210',
        'name' => 'gesetzliche Rücklagen',
        'type' => 'Passiv',
    ],

    [
        'number' => '3240',
        'name' => 'andere Gewinnrücklagen',
        'type' => 'Passiv',
    ],

    [
        'number' => '3300',
        'name' => 'Gewinn- und Verlustvortrag',
        'type' => 'Passiv',
    ],

    [
        'number' => '3350',
        'name' => 'Bilanzgewinn/Bilanzverlust',
        'type' => 'Passiv',
    ],

    [
        'number' => '4210',
        'name' => 'kurzfr. Bankverbindlichkeiten',
        'type' => 'Passiv',
    ],

    [
        'number' => '4250',
        'name' => 'langfr. Bankverbindlichkeiten',
        'type' => 'Passiv',
    ],

    [
        'number' => '4400',
        'name' => 'Verbindlichkeiten aus Lieferungen und Leistungen',
        'type' => 'Passiv',
    ],

    [
        'number' => '5000',
        'name' => 'Umsatzerlöse für eigene Erzeugnisse',
        'type' => 'Ertrag',
    ],

     [
        'number' => '5100',
        'name' => 'Umsatzerlöse für Handelswaren',
        'type' => 'Ertrag',
    ],
     [
        'number' => '5200',
        'name' => 'Bestandsveränderungen',
        'type' => 'Ertrag',
    ],

    [
        'number' => '5780',
        'name' => 'Erträge aus Wertpapierverkäufen',
        'type' => 'Ertrag',
    ],

    [
        'number' => '6000',
        'name' => 'Rohstoffaufwendungen',
        'type' => 'Aufwand',
    ],

    [
        'number' => '6300',
        'name' => 'Gehälter',
        'type' => 'Aufwand',
    ],

    [
        'number' => '6700',
        'name' => 'Mieten',
        'type' => 'Aufwand',
    ],

    [
        'number' => '6800',
        'name' => 'Büromaterial',
        'type' => 'Aufwand',
    ],

    [
        'number' => '6870',
        'name' => 'Aufwendungen für Werbung',
        'type' => 'Aufwand',
    ],

    [
        'number' => '6960',
        'name' => 'Verluste aus dem Abgang von Vermögensgegenständen',
        'type' => 'Aufwand',
    ],

    [
        'number' => '7510',
        'name' => 'Zinsaufwendungen',
        'type' => 'Aufwand',
    ],

    [
        'number' => '8000',
        'name' => 'Eröffnungsbilanzkonto',
        'type' => 'Eröffnungsbilanzkonto',
    ],

    [
        'number' => '8010',
        'name' => 'Schlussbilanzkonto',
        'type' => 'Schlussbilanzkonto',
    ],

    [
        'number' => '8020',
        'name' => 'Gewinn- und Verlustkonto',
        'type' => 'Gewinn- und Verlustkonto',
    ]];
    public function run(): void
    {
        foreach ($this->accounts as $account) {
            $accountObj = new Account();
            $accountObj->id = $account['number'];
            $accountObj->name = $account['name'];
            $accountObj->type = $account['type'];
            $accountObj->level = $account['level'] ?? null;
            $accountObj->save();
        }
    }
}
