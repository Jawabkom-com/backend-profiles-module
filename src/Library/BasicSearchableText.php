<?php

namespace Jawabkom\Backend\Module\Profile\Library;

use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberFormat;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ISearchableText;

class BasicSearchableText implements ISearchableText
{
    protected $arabicLettersReplacables = [
        "\u{061A}" => '', // kasra
        "\u{0619}" => '', // damma
        "\u{0618}" => '', // fatha qaseer
        "\u{0622}" => 'ا', // mad
        "\u{0623}" => 'ا', // qate3
        "\u{0625}" => 'ا', // hamzat kaser
        "\u{0671}" => 'ا', // alef wasla
        "\u{0672}" => 'ا', // alef heavy hamza
        "\u{0673}" => 'ا', // alef heavy hamza
        "\u{0675}" => 'ا', // alef heavy hamza
        "\u{0629}" => 'ه', // ta marboota
        "\u{0640}" => '', // arabic taweel -
        "\u{064B}" => '', // tanween fateh
        "\u{064C}" => '', // tanween dam
        "\u{064D}" => '', // tanween kaser
        "\u{064E}" => '', // fatha taweel
        "\u{064F}" => '', // damma
        "\u{0650}" => '', // kasra
        "\u{0651}" => '', // shadda
        "\u{0652}" => '', // sokoon
        "\u{0653}" => '', // mad
        "\u{0656}" => '', // subscription alef
        "\u{0657}" => '', // inverted damma
        "\u{0658}" => '', // noon ghonna
        "\u{0659}" => '', // mad
        "\u{065A}" => '', // vowel sign down
        "\u{065B}" => '', // vowel sign above
        "\u{065C}" => '', // vowel dot
        "\u{065D}" => '', // reverse damma
        "\u{065E}" => '', // fatha with two dots
        "\u{065F}" => '', // wavy hamza
        "\u{0670}" => '', // subscription
        "\u{0660}" => '0', // digital zero
        "\u{0661}" => '1',
        "\u{0662}" => '2',
        "\u{0663}" => '3',
        "\u{0664}" => '4',
        "\u{0665}" => '5',
        "\u{0666}" => '6',
        "\u{0667}" => '7',
        "\u{0668}" => '8',
        "\u{0669}" => '9'
    ];

    public function prepare(string $text): string
    {
        return trim(preg_replace('/[\s]+/', ' ', str_replace(array_keys($this->arabicLettersReplacables), array_values($this->arabicLettersReplacables), $text)));
    }
}
