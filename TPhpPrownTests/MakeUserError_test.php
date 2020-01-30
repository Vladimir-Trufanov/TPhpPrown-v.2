<?php
// PHP7/HTML5, EDGE/CHROME                       *** MakeUserError_test.php ***
// ****************************************************************************
// * TPhpPrown    Тест функции MakeUserError - Вывести сообщение разработчика *
// *                      об ошибке в программируемом модуле или сформировать *
// *                                              пользовательское исключение *
// *                                                                          *
// * v1.1, 02.01.2020                              Автор:       Труфанов В.Е. *
// * Copyright © 2019 tve                          Дата создания:  27.12.2019 *
// ****************************************************************************

class test_MakeUserError extends UnitTestCase 
{
   function test_MakeUserError_First()
   {
      MakeTitle("MakeUserError");
      SimpleMessage();
      /*
      $Mode=rvsDialogWindow;
      $Mess='Текст сообщения в диалоговом окне через JQueryUI';
      $Result=\prown\MakeUserError($Mess,'Test',$Mode);
      $this->assertTrue($Result);   
      MakeTestMessage('\prown\MakeUserError("'.$Mess.'"'.",'Test',".'$Mode); ',
         'Сообщение в режиме $Mode=rvsDialogWindow',90);
      */
      $Mode=rvsCurrentPos;
      $Mess='Сообщение в текущей позиции сайта';
      $Result=\prown\MakeUserError($Mess.'<br>','Test',$Mode);
      $this->assertTrue($Result);   
      MakeTestMessage('\prown\MakeUserError("'.$Mess.'"'.",'Test',".
         '$Mode); ',
         'Сообщение в режиме $Mode=rvsCurrentPos',90);

      $Mode=rvsMakeDiv;
      $Mess='Сообщение в дополнительном div-е';
      $Result=\prown\MakeUserError($Mess,'Test',$Mode,E_USER_ERROR,"Err");
      $this->assertTrue($Result);   
      //MakeTestMessage('\prown\MakeUserError("'.$Mess.'"'.",'Test',".$Mode.',E_USER_ERROR,"Err"); ',
      MakeTestMessage('MakeUserError("'.$Mess.'"'.",'Test',".'$Mode'.',E_USER_ERROR,"Err"); ',
        'Сообщение в режиме $Mode=rvsMakeDiv',90);
   }
   /*
   function test_MakeUserError_Second()
   {
      $Mode=95;
      $Mess='Сообщение c неверно указанным режимом';
      $Result=\prown\MakeUserError($Mess,'Test',$Mode);
      $this->assertFalse($Result);   
      MakeTestMessage('\prown\MakeUserError("'.$Mess.'"'.",'Test',".'$Mode); ',
         'Исключение при $Mode=95. Это нормально!',90);

      $Mess='Сообщение через исключение';
      $Result=\prown\MakeUserError($Mess);
      $this->assertFalse($Result);   
      MakeTestMessage('\prown\MakeUserError("'.$Mess.'"); ',
         'Сообщение по умолчанию, как исключение. Это нормально!',90);
   }
   */
}

// ************************************************* MakeUserError_test.php ***
