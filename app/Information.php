<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = [
        'cms_content', 'anrede', 'titel', 'vorname', 'name', 'strasse', 'plz', 'ort', 
        'e_mail_adresse', 'ihre_nachricht', 'ich_bin_mit_der_speicherung_meiner_daten_einverstanden',
        'ich_erklare_mich_mit_den_nutzungsbedingungen_einverstanden', 'informationsmaterial', 'markup',
        'markup_01', 'markup_02', 'ich_bin_mit_der_speicherung_meiner_daten_und_den_nutzungsbedingu' 
    ];
}
