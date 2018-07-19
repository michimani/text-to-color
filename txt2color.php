<?php
    class TextToColor
    {
        // random value
        private $rand_str = 'some strings';
        private $rand = '0';

        public function __construct()
        {
            $this->rand = (int)substr(preg_replace('/[^1-9]/', '', md5($this->rand_str)), 2, 5);
        }

        /**
         * generate color code hex from string
         * @param  string $str a string
         * @return string   color code hex
         */
        public function generateColorHexFromString($str)
        {
            $rgb = $this->__stringToRgb($str);
            $hex = $this->__rgbToHex($rgb);

            return $hex;
        }

        /**
         * generaet color code hex from string list
         * @param  array $str_list {string, string, ...} string list
         * @return array {[string, $hex], [string, $hex], ...}
         */
        public function generateColorHexFromStringList($str_list)
        {
            $list = [];
            foreach ($str_list as $str)
            {
                $list[] = [
                    'str' => $str,
                    'hex' => $this->generateColorHexFromString($str)
                ];
            }

            return $list;
        }

        /**
         * generate RGB value from string
         * @param  string $stirng a string
         * @return array {int, int, int} RGB value
         */
        private function __stringToRgb($stirng)
        {
            $rgb = [0, 0, 0];
            $len = strlen($stirng);
            if ($len === 0)
            {
                return $rgb;
            }

            $base = (int)substr(preg_replace('/[^1-9]/', '', md5($stirng.$len)), 2, 4);
            $ord = 0;
            for ($i = 0; $i < $len; $i++)
            {
                $c = substr($stirng, $i, 1);
                $ord += ord($c);
            }

            $coef_tmp = [
                round((($ord % 7) / 6), 2),
                round((($ord % 11) / 10), 2),
                1 + round((($ord % 13) / 12), 2),
            ];

            $coef[($len % 5) % 3] = $coef_tmp[0];
            $coef[(($len % 5) + 1) % 3] = $coef_tmp[1];
            $coef[(($len % 5) + 2) % 3] = $coef_tmp[2];

            foreach ($rgb as $k => &$v)
            {
                $tmpv = round($base * $coef[(($ord % 7) + $k) % 3] * (1 + $this->rand), 0);
                $v = $tmpv - (255 * floor($tmpv / 255));
            }

            return $rgb;
        }

        /**
         * convert RGB to Hex value
         * @param  array $rgb RGB value
         * @return string hex
         */
        private function __rgbToHex($rgb)
        {
            $color = '#000000';
            $hex = '#';
            foreach ($rgb as $i => $v)
            {
                $h = dechex($v);
                if (strlen($h) == 1)
                {
                    $h = "0{$h}";
                }
                $hex = $hex.$h;
            }
            if (preg_match('/^#[0-9a-f]{6}$/', $hex))
            {
                $color = $hex;
            }

            return $color;
        }
    }