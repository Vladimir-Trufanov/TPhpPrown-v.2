<?php namespace prown;

// PHP7/HTML5, EDGE/CHROME                          *** ViewSimpleArray.php ***

// ****************************************************************************
// * TPHPPROWN                                    Показать содержимое массива *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  30.01.2018
// Copyright © 2018 tve                              Посл.изменение: 22.02.2018

function ViewSimpleArray($fill,$Caption='')
{
    echo "<br>";
    // Если массив пуст, то информируем об этом
    if (count($fill)==0) echo "Массив ".$Caption." пуст!<br>";
    // Иначе проходим по массиву и показываем ключи и значения 
    else
    {
        foreach($fill as $key => $value)
        {
            if ($Caption=='') echo $key."=".$value."<br>";
            else echo $Caption.": ".$key."=".$value."<br>";
        }
    }
}
// **************************************************** ViewSimpleArray.php ***

