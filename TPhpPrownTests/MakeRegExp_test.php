<?php

// PHP7/HTML5, EDGE/CHROME                          *** MakeRegExp_test.php ***
// ****************************************************************************
// * TPhpPrown      Тест функции MakeRegExp - отработать регулярное выражение *
// *                                       на тексте и оттрассировать разбор. *
// *                       Рекомендуется использовать только для трассировки. *
// *                                                                          *
// * v1.0, 06.04.2020                              Автор:       Труфанов В.Е. *
// * Copyright © 2019 tve                          Дата создания:  06.04.2020 *
// ****************************************************************************

class test_MakeRegExp extends UnitTestCase 
{
   // Внимание: Имя функции/метода теста не должно совпадать с именем класса

   function test_MakeRegExp_All()
   {
      MakeTitle("MakeRegExp");

      $string="В этой строке ищется 'это' функцией MakeRegExp";
      $preg="/это/u";
      $prefix='<br>MakeRegExp("'.$preg.'","'.$string.'"); ';
      $Result=prown\MakeRegExp($preg,$string,$matches,mriStandTracing);
      $this->assertEqual(2,$Result);
      $this->assertEqual('это',$matches[0][1][0]);
      $this->assertEqual(39,$matches[0][1][1]);
      MakeTestMessage($prefix,'Подстроки '.'"это"'.' найдены, стандартная трассировка',80);

      $string="В этой строке ищется 'эти' функцией MakeRegExp";
      $preg="/эти/u";
      $prefix='<br>MakeRegExp("'.$preg.'","'.$string.'"); ';
      $Result=prown\MakeRegExp($preg,$string,$matches,mriInstallTrace);
      $this->assertEqual(1,$Result);
      $this->assertEqual('эти',$matches[0][0][0]);
      $this->assertNotEqual(3,$matches[0][0][1]);
      $this->assertEqual(39,$matches[0][0][1]);
      MakeTestMessage($prefix,'Подстрока '.'"эти"'.' найдена, установленная трассировка MakeRegExp',80);

      $string="В этой строке ищется не 'это'";
      $preg="/этот/u";
      $prefix='<br>MakeRegExp("'.$preg.'","'.$string.'"); ';
      $Result=prown\MakeRegExp($preg,$string,$matches,mriTracingBlock);
      $this->assertEqual(0,$Result);
      $Result=prown\MakeRegExp($preg,$string,$matches,mriTracingBlock);
      $this->assertEqual(0,$Result);
      MakeTestMessage($prefix,'Подстроки '.'"этот"'.' не найдено',80);

      $string="Здесь ищется 'это'";
      $preg="/это/u";
      $prefix='MakeRegExp("'.$preg.'","'.$string.'"'.',$matches,mriTracingBlock); '; 
      $Result=prown\MakeRegExp($preg,$string,$matches,mriTracingBlock);
      $this->assertEqual(1,$Result);
      $this->assertEqual('это',$matches[0][0][0]);
      MakeTestMessage($prefix,'Подстрока '.'"это"'.' найдена,  трассировка заблокирована<br>',76);

      $string="Здесь ищется 'это'";
      $preg="/это/u";
      $prefix='<br>MakeRegExp("'.$preg.'","'.$string.'"); '; 
      $Result=prown\MakeRegExp($preg,$string);
      $this->assertEqual(1,$Result);
      $this->assertEqual('это',$matches[0][0][0]);
      MakeTestMessage($prefix,'Подстрока '.'"это"'.' найдена,  сообщение устаревшего использования',80);
   }
}
// **************************************************** MakeRegExp_test.php ***
