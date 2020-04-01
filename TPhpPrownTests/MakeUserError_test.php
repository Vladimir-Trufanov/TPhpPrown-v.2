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
      /*
      $Mode=rvsDialogWindow;
      $Mess='Текст сообщения в диалоговом окне через JQueryUI';
      $Result=prown\MakeUserError($Mess,'Test',$Mode);
      $this->assertTrue($Result);   
      MakeTestMessage('prown\MakeUserError("'.$Mess.'"'.",'Test',".'$Mode); ',
         'Сообщение в режиме $Mode=rvsDialogWindow',90);
      */
      $Mode=rvsCurrentPos;
      $Mess='Сообщение в текущей позиции сайта';
      $Result=\prown\MakeUserError($Mess.'<br>','Test',$Mode);
      $this->assertTrue($Result);   
      MakeTestMessage('prown\MakeUserError("'.$Mess.'"'.",'Test',".
         '$Mode); ',
         'Сообщение в режиме $Mode=rvsCurrentPos',90);

      $Mode=rvsMakeDiv;
      $Mess='Сообщение в дополнительном div-е';
      $Result=\prown\MakeUserError($Mess,'Test',$Mode,E_USER_ERROR,"Err");
      $this->assertTrue($Result);   
      MakeTestMessage('MakeUserError("'.$Mess.'"'.",'Test',".'$Mode'.',E_USER_ERROR,"Err"); ',
        'Сообщение в режиме $Mode=rvsMakeDiv',90);
      SimpleMessage();
   }
}

// ************************************************* MakeUserError_test.php ***
