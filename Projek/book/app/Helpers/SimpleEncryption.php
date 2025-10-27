<?php

namespace App\Helpers;

class SimpleEncryption
{
    // ENCRYPT
    public static function encrypt($text, $pin)
    {
        if (empty($pin)) {
            throw new \Exception('PIN tidak boleh kosong!');
        }

        // Lapisan 1: Scytale Cipher 
        $scytale = self::scytaleEncrypt($text, strlen($pin));

        // Lapisan 2: Vigenere Cipher (ASCII) 
        $vigenere = self::vigenereEncrypt($scytale, $pin);

        // Lapisan 3: Columnar Transposition Cipher 
        $columnar = self::columnarEncrypt($vigenere, $pin);

        // Encode agar aman disimpan di database
        return base64_encode($columnar);
    }

    // DECRYPT 
    public static function decrypt($encodedText, $pin)
    {
        if (empty($pin)) {
            throw new \Exception('PIN tidak boleh kosong!');
        }

        $decoded = base64_decode($encodedText);

        $step1 = self::columnarDecrypt($decoded, $pin);
        $step2 = self::vigenereDecrypt($step1, $pin);
        $step3 = self::scytaleDecrypt($step2, strlen($pin));

        return $step3;
    }

    // SCYTALE CIPHER 
    private static function scytaleEncrypt($text, $key)
    {
        $cols = $key;
        $rows = ceil(strlen($text) / $cols);
        $matrix = array_fill(0, $rows, array_fill(0, $cols, ''));

        $index = 0;
        for ($r = 0; $r < $rows; $r++) {
            for ($c = 0; $c < $cols; $c++) {
                if ($index < strlen($text)) {
                    $matrix[$r][$c] = $text[$index++];
                } else {
                    $matrix[$r][$c] = '_'; 
                }
            }
        }

        $result = '';
        for ($c = 0; $c < $cols; $c++) {
            for ($r = 0; $r < $rows; $r++) {
                $result .= $matrix[$r][$c];
            }
        }

        return $result;
    }

    private static function scytaleDecrypt($cipher, $key)
    {
        $cols = $key;
        $rows = ceil(strlen($cipher) / $cols);
        $matrix = array_fill(0, $rows, array_fill(0, $cols, ''));

        $index = 0;
        for ($c = 0; $c < $cols; $c++) {
            for ($r = 0; $r < $rows; $r++) {
                if ($index < strlen($cipher)) {
                    $matrix[$r][$c] = $cipher[$index++];
                }
            }
        }

        // Rekonstruksi urutan baris kembali ke teks asli
        $result = '';
        for ($r = 0; $r < $rows; $r++) {
            for ($c = 0; $c < $cols; $c++) {
                $result .= $matrix[$r][$c];
            }
        }

        return rtrim($result, '_');
    }

    // VIGENERE (ASCII) 
    private static function vigenereEncrypt($text, $key)
    {
        $res = '';
        for ($i = 0; $i < strlen($text); $i++) {
            $res .= chr((ord($text[$i]) + ord($key[$i % strlen($key)])) % 256);
        }
        return $res;
    }

    private static function vigenereDecrypt($cipher, $key)
    {
        $res = '';
        for ($i = 0; $i < strlen($cipher); $i++) {
            $res .= chr((ord($cipher[$i]) - ord($key[$i % strlen($key)]) + 256) % 256);
        }
        return $res;
    }

    // COLUMNAR TRANSPOSITION 
    private static function columnarEncrypt($text, $key)
    {
        $keyLen = strlen($key);
        $keyOrder = self::getKeyOrder($key);

        $rows = ceil(strlen($text) / $keyLen);
        $matrix = array_fill(0, $rows, array_fill(0, $keyLen, ''));

        $index = 0;
        for ($r = 0; $r < $rows; $r++) {
            for ($c = 0; $c < $keyLen; $c++) {
                $matrix[$r][$c] = $index < strlen($text) ? $text[$index++] : '_';
            }
        }

        $result = '';
        foreach ($keyOrder as $c) {
            for ($r = 0; $r < $rows; $r++) {
                $result .= $matrix[$r][$c];
            }
        }

        return $result;
    }

    private static function columnarDecrypt($cipher, $key)
    {
        $keyLen = strlen($key);
        $keyOrder = self::getKeyOrder($key);

        $rows = ceil(strlen($cipher) / $keyLen);
        $matrix = array_fill(0, $rows, array_fill(0, $keyLen, ''));

        $index = 0;
        foreach ($keyOrder as $c) {
            for ($r = 0; $r < $rows; $r++) {
                if ($index < strlen($cipher)) {
                    $matrix[$r][$c] = $cipher[$index++];
                }
            }
        }

        $result = '';
        for ($r = 0; $r < $rows; $r++) {
            for ($c = 0; $c < $keyLen; $c++) {
                $result .= $matrix[$r][$c];
            }
        }

        return rtrim($result, '_');
    }

    // Mendapatkan urutan kolom berdasarkan abjad karakter key
    private static function getKeyOrder($key)
    {
        $chars = str_split($key);
        $indexed = [];
        foreach ($chars as $i => $ch) {
            $indexed[] = ['char' => $ch, 'index' => $i];
        }

        usort($indexed, function ($a, $b) {
            return $a['char'] <=> $b['char'];
        });

        return array_column($indexed, 'index');
    }
}
