<?php
function currency_format($number, $suffix = 'đ')
{
    return number_format($number) . $suffix;
}
// function rename_number(){
//     if()

// }
function jam_read_num_forvietnamese($num = false)
{
    $str = '';
    $num  = trim($num);

    $arr = str_split($num);
    $count = count($arr);

    $f = number_format($num);
    //KHÔNG ĐỌC BẤT KÌ SỐ NÀO NHỎ DƯỚI 999 ngàn
    if ($count < 7) {
        $str = $num;
    } else {
        // từ 6 số trở lên là triệu, ta sẽ đọc nó !
        // "32,000,000,000"
        $r = explode(',', $f);
        switch (count($r)) {
            case 4:
                $str = $r[0] . ' tỷ';
                if ((int) $r[1]) {
                    $str .= ' ' . $r[1] . ' Tr';
                }
                break;
            case 3:
                $str = $r[0] . ' Triệu';
                if ((int) $r[1]) {
                    $str .= ' ' . $r[1] . 'K';
                }
                break;
        }
    }
    return ($str);
}
