<?php

/* Copyright (c) 2019 Sebastian Nohn
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use, copy,
 * modify, merge, publish, distribute, sublicense, and/or sell copies
 * of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS
 * BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN
 * ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Nohn;

class CTFR {

    public static function query($domain, $only_return_valid_certs = true) {
        $raw_json = file_get_contents('https://crt.sh/?q=%.' . $domain . '&output=json');
        if ($only_return_valid_certs) {
            $filtered_json = array();
            $certs = json_decode($raw_json);
            foreach ($certs as $cert) {
                if (
                        (strtotime($cert->not_after) > time()) &&
                        (strtotime($cert->not_before) < time())
                ) {
                    $filtered_json[] = $cert;
                }
            }
            return $filtered_json;
        } else {
            return json_decode($raw_json);
        }
    }

}
