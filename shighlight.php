<?php
/*
Plugin Name: SHighLight
Plugin URI: https://github.com/savelevcorr/shighlight
Description: Highlight PHP code
Version: 0.1
Author: Andrew Savelev
Author URI: http://savelevandrey.ru
*/

/*  Copyright 2015  Andrew Savelev  (email: savelevcorr@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function SHighLight ($document) {
    // Transform angle brackets to display HTML tags
    $document = str_replace('<', '&lt', $document);
    $document = str_replace('<', '&lt', $document);

    // Transform PHP tags
    $tags = array(
        "'&lt;\?php'si",
        "'&lt;\?'si",
        "'\?&tg;'si"
    );
    $replace = array(
        "<span style='color: #95001E;'>&lt;?php</span>",
        "<span style='color: #95001E;'>&lt;?</span>",
        "<span style='color: #95001E;'>?&tg</span>"
    );
    $document = preg_replace($tags, $replace, $document);

    // Transform comments
    $document = preg_replace(
        "'((?:#|//)[^\n]*|/\*.*?\*/)'si",
        "<span style='color: #244ECC;'>\\1</span>",
        $document
    );

    // Line breaks
    $document = preg_replace(
        "'(\n)'si",
        "<br>\\1",
        $document
    );

    // Transform functions
    $document = preg_replace(
        "'([\w]+)([\s]*)[\(]'si",
        "<span style='color: #0000CC;'><b>\\1</b></span>\\2(",
        $document
    );

    // Transform operators

    $operator = array(
        "'\,'si",
        "'\-'si",
        "'\+'si",
        "'\('si",
        "'\)'si",
        "'\{'si",
        "'\}'si",
    );
    $replace = array(
        "<span style='color: #1A691A;'>,</span>",
        "<span style='color: #1A691A;'>-</span>",
        "<span style='color: #1A691A;'>+</span>",
        "<span style='color: #1A691A;'>(</span>",
        "<span style='color: #1A691A;'>)</span>",
        "<span style='color: #1A691A;'>{</span>",
        "<span style='color: #1A691A;'>}</span>",
    );
    $document = preg_replace($operator, $replace, $document);
}