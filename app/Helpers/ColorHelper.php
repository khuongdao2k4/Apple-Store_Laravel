<?php

namespace App\Helpers;

class ColorHelper
{
    /**
     * Map hex colors to human-readable Vietnamese names.
     *
     * @param string|null $hex
     * @return string
     */
    public static function resolve($hex)
    {
        if (!$hex) return '';

        $hex = trim($hex);

        // If it doesn't look like a hex code (doesn't start with # and isn't 3/6 chars of hex)
        // just return it as is.
        if (strpos($hex, '#') !== 0 && !preg_match('/^[0-9a-fA-F]{3}$|^[0-9a-fA-F]{6}$/', $hex)) {
            return $hex;
        }

        // Clean hex
        $cleanHex = strtolower($hex);
        if (strpos($cleanHex, '#') === 0) {
            $cleanHex = substr($cleanHex, 1);
        }

        // Expand short hex (e.g., #f00 -> #ff0000)
        if (strlen($cleanHex) === 3) {
            $cleanHex = $cleanHex[0] . $cleanHex[0] . $cleanHex[1] . $cleanHex[1] . $cleanHex[2] . $cleanHex[2];
        }

        $names = [
            "000000" => "Đen",
            "ffffff" => "Trắng",
            "f5f5f0" => "Trắng Ánh Sao",
            "e3e4e5" => "Bạc",
            "2c2c2e" => "Đen Không Gian",
            "d1d1d1" => "Titan Tự Nhiên",
            "e5e5e5" => "Titan Trắng",
            "4b4b4b" => "Titan Đen",
            "7d7d7d" => "Titan Xanh",
            "f2d1c1" => "Hồng",
            "ff0000" => "Đỏ",
            "c0c0c0" => "Bạc",
            "ffd700" => "Vàng",
            "3c3c3c" => "Xám Không Gian",
            "5c61f0" => "Xanh Lưu Ly",
            "b2d4c6" => "Lục Lam (Teal)",
            "00ffcc" => "Xanh Ngọc",
            "bf00ff" => "Tím Nhạt",
            "c29b83" => "Titan Sa Mạc",
            "808080" => "Xám",
            "0000ff" => "Xanh Biển",
            "00ff00" => "Xanh Lá",
            "ffff00" => "Vàng",
            "ffa500" => "Cam",
            "ffc0cb" => "Hồng",
            "800080" => "Tím",
            "a52a2a" => "Nâu",
            "00ffff" => "Xanh Da Trời",
            "f4f4fa" => "Trắng Tinh Khiết",
        ];

        // Direct match
        if (isset($names[$cleanHex])) {
            return $names[$cleanHex];
        }

        // Find closest color
        try {
            if (strlen($cleanHex) !== 6) return $hex;

            $r = hexdec(substr($cleanHex, 0, 2));
            $g = hexdec(substr($cleanHex, 2, 2));
            $b = hexdec(substr($cleanHex, 4, 2));

            $minDiff = PHP_INT_MAX;
            $bestName = $hex; 

            foreach ($names as $code => $name) {
                $nr = hexdec(substr($code, 0, 2));
                $ng = hexdec(substr($code, 2, 2));
                $nb = hexdec(substr($code, 4, 2));

                $diff = pow($r - $nr, 2) + pow($g - $ng, 2) + pow($b - $nb, 2);
                if ($diff < $minDiff) {
                    $minDiff = $diff;
                    $bestName = $name;
                }
            }
            
            return $bestName;
        } catch (\Exception $e) {
            return $hex;
        }
    }
}
