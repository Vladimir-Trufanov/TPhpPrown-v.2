<?php namespace prown;

// PHP7/HTML5, EDGE/CHROME                            *** Number1string.php ***

// ****************************************************************************
// * KwinFlat.ru                Преобразовать число в порядковое числительное *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  09.03.2018
// Copyright © 2018 tve                              Посл.изменение: 13.03.2018

function number1string($number,$Mode='men') 
{
    // Обозначаем словарь в виде статичного переменного массива, чтобы 
    // при повторном использовании функции его не определять заново
    static $dic = array
    (
	   1	=> 'первый',
	   2	=> 'второй',
	   3	=> 'третий',
	   4	=> 'четвертый',
	   5	=> 'пятый',
	   6	=> 'шестой',
	   7	=> 'седьмой',
	   8	=> 'восьмой',
	   9	=> 'девятый',
	   10	=> 'десятый',
	   11	=> 'одиннадцатый',
	   12	=> 'двенадцатый',
	   13	=> 'тринадцатый',
	   14	=> 'четырнадцатый' ,
	   15	=> 'пятнадцатый',
	   16	=> 'шестнадцатый',
	   17	=> 'семнадцатый',
	   18	=> 'восемнадцатый',
	   19	=> 'девятнадцатый',
	   20	=> 'двадцатый',
    );
    $result='неопределенный';
    foreach($dic as $i=>$part) 
    {
        if ($i==$number)
        {
            $result=$part;
            break;
        }
    }
	return $result;
}

// ****************************************************** Number1string.php *** 