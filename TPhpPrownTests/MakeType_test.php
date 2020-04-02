<?php

// PHP7/HTML5, EDGE/CHROME                            *** MakeType_test.php ***

// ****************************************************************************
// * TPhpPrown                        Преобразовать значение к заданному типу *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  20.04.2019
// Copyright © 2019 tve                              Посл.изменение: 02.04.2020

require_once $SiteHost."/TPhpPrown/TPhpPrown/iniConstMem.php";

class test_MakeType extends UnitTestCase 
{
   // Преобразование строки к целому числу
   function test_MakeType_Simple()
   {
      MakeTitle("MakeType");
      $string="1958";
      $Result=prown\MakeType($string,tInt);
      $this->assertEqual($Result,1958);
      $this->assertNotEqual($Result,'1959');  
      MakeTestMessage(
         '$string="1958"; $Result=prown\MakeType($string,tInt); ',
         'Преобразование строчного "1958" к целому 1958',70);
      $string='3.1415926';
      $Result=prown\MakeType($string,tFloat);
      $this->assertEqual($Result,3.1415926);
      $this->assertNotEqual($Result,3.1415926+1959);  
      MakeTestMessage(
         '$string="3.1415926"; $Result=prown\MakeType($string,tFloat); ',
         'Преобразование строки "3.1415926" к числу 3.1415926',70);
   }
   // Преобразование строки, как числа по неверному типу
   function test_MakeType_Inpos()
   {
      $string='1958';
      $Result=prown\MakeType($string,135,rvsCurrentPos);
      $this->assertEqual($Result,null);
      SimpleMessage(); 
      MakeTestMessage(
         '$Result=prown\MakeType("1958",135,rvsCurrentPos); ',
         'Преобразование строчного "1958" к целому, но тип указан неверно',70);
   }
   // Преобразование целого числа к логической переменной
   function test_MakeType_Boolean()
   {
      $value=0; $Result=prown\MakeType($value,tBool);
      $this->assertFalse($Result);
      MakeTestMessage(
         '$value=0; $Result=prown\MakeType($value,tBool); ',
         'Преобразования целого = 0 к логическому типу: False',70);
      $value=1; $Result=prown\MakeType($value,tBool);
      $this->assertTrue($Result);
      MakeTestMessage(
         '$value=1; $Result=prown\MakeType($value,tBool); ',
         'Преобразования целого = 1 к логическому типу: True',70);
      $value=-1; $Result=prown\MakeType($value,tBool);
      $this->assertTrue($Result);
      MakeTestMessage(
         '$value=-1; $Result=prown\MakeType($value,tBool); ',
         'Преобразования целого = -1 к логическому типу: True',70);
      $value=-10; $Result=prown\MakeType($value,tBool);
      $this->assertTrue($Result);
      $Result=prown\MakeType(100,tBool);
      $this->assertTrue($Result);
      MakeTestMessage(
         '$Result=prown\MakeType(100,tBool); ',
         'Преобразования целого = 100 к логическому типу: True',70);
   }
   // Преобразование целого числа к символьному значению
   function test_MakeType_String()
   {
      $value=10; $Result=prown\MakeType($value,tStr);
      $this->assertEqual($Result,'10');  
      MakeTestMessage(
         '$value=10; $Result=prown\MakeType($value,tStr); ',
         'Преобразования целого = 10 к cимвольному значению: "10"',70);
      $value=0; $Result=prown\MakeType($value,tStr);
      $this->assertEqual($Result,'0'); 
      $this->assertNotEqual($Result,''); 
      MakeTestMessage(
         '$value=0; $Result=prown\MakeType($value,tStr); ',
         'Преобразования целого = 0 к cимвольному значению: "0"',70);
      SimpleMessage();
  }
}
// ****************************************************** MakeType_test.php ***
