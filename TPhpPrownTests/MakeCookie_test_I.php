<?php
// PHP7/HTML5, EDGE/CHROME                        *** MakeCookie_test_I.php ***

// ****************************************************************************
// * TPhpPrown-test           ���� ������������ ������������ ����� MakeCookie *
// ****************************************************************************

//                                                   �����:       �������� �.�.
//                                                   ���� ��������:  13.01.2019
// Copyright � 2020 tve                              ����.���������: 17.03.2020

// ****************************************************************************
// *                  ������ ��������� ������ ������� ��� �����               *
// ****************************************************************************
function MakeCookieTest()
{
   $Result=true;
   $ModeError=rvsCurrentPos;
   // ���� ������� MakeCookie � ���� ������� �������� MakeCookie, 
   // �� ������� ������ �������� ������� � ��������� ������������ ��������
   if (isChecked('formDoor','MakeCookie')&&(IsSet($_SESSION['CookTrack']))) 
   {
      // ������������ ��������� ������
      $s_CookTrack=$_SESSION['CookTrack'];  
      //echo 'CookTrack='.$s_CookTrack.'<br>';
      // �� ������� ������� ���������� ������ ��������� �����
      // � ������ ������ ��� �� �������� �� 1 �������
      if ($s_CookTrack==0)
      {
         $aCookMessa=array(); // ������� ������ ������
         $s_CookMessa=prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      
         //echo 'CookMessa='.$s_CookMessa.'<br>';
         // ������ ������� ������ ����� ��� � ��������
         $Result=prown\MakeCookie('cookTypeStr','��������');
         $Result=prown\MakeCookie('cookTypeInt',137);
         $Result=prown\MakeCookie('cookTypeFloat',3.1415926);
         //$Result=prown\MakeCookie('cookTypeZero',0,tInt,true);
      }
      // ������� ��������� ������
      $s_CookTrack++;  
      prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
      echo 'CookTrack='.$s_CookTrack.'<br>';
      
      // ���� ��� ������� ���������, �� ������������� ������������ �������
      if (($s_CookTrack>3)||($s_CookTrack<0))
      {
            $s_CookTrack=0;  
            prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
            echo 'STOP CookTrack='.$s_CookTrack.'<br>';
      }
      else
      // ������������� �������� ��� ������ ������� 
      {
         $page="/index.php?formDoor%5B%5D=MakeCookie&".
            "formSubmit=%D0%9F%D1%80%D0%BE%D1%82%D0%B5%D1%81%D1%82%".
            "D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D1%82%D1%8C";
         //echo "Location: http://".$_SERVER['HTTP_HOST'].$page;
         Header("Location: http://".$_SERVER['HTTP_HOST'].$page,true);
      }


      /*
     //$CookCount=count($aCookMessa);   // ������ ��������� ����������� �������
      //$s_CookCount=prown\MakeSession('CookCount',$CookCount,tInt); 
  
   }

      // �������� ������ ������ ��� ����������� � ������������ ���������� �������
      if (IsSet($_SESSION))
      {
         // ������������ ��������� ������
         if (IsSet($_SESSION['CookTrack']))
         {
            $s_CookTrack=$_SESSION['CookTrack']+1;  
            prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
            echo 'CookTrack='.$s_CookTrack.'<br>';
         }
         // ����������� ������ � ����� ���������� ����������
         if (IsSet($_SESSION['CookMessa']))
         {
            $s_CookMessa=$_SESSION['CookMessa'];  
            echo 'CookMessa='.$s_CookMessa.'<br>';
            // ��������� ������ ���������
            $aCookMessa=unserialize($s_CookMessa);
            $CookCount=count($aCookMessa);
            for ($i=0; $i<$CookCount; $i++)
            {
               echo $i.': '.$aCookMessa[$i].'<br>';
            } 
         }
      }

   */

   }


   
   /*
   // ���������� ������ ��������� �����
   if ($NumTest==0)
   {
      $aCookMessa=array();             // ������� ������ ������
      //$aCookMessa[0] = '������ �����'; 
      //$aCookMessa[1] = '������ ghfdsq'; 
      $s_CookMessa=prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      
      //$CookCount=count($aCookMessa);   // ������ ��������� ����������� �������
      //$s_CookCount=prown\MakeSession('CookCount',$CookCount,tInt); 
   }
   elseif ($NumTest==1)
   {
      //$Result=prown\MakeCookie('cookTypical','��������',null,null,null,null,$ModeError);
      // ������� ������� ������ ����� ��� � ��������
      $Result=prown\MakeCookie('cookTypeStr','��������');
      $Result=prown\MakeCookie('cookTypeInt',137);
      $Result=prown\MakeCookie('cookTypeFloat',3.1415926);
      $Result=prown\MakeCookie('cookTypeZero',0,tInt,true);
   }
   */
   return $Result;  
}
// ************************************************** MakeCookie_test_I.php ***
