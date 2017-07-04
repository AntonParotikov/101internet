<?php

/**
* @author Антон паротиков <novenok@mail.ua>
* @version 1.0
* @package Inquiry
*/ 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Inquiry;

/**
* Контроллер ParserController, берет указанный url и отдается запрос в модель для парсинга
*/

class ParserController extends Controller
{

  /**
  * Shows request page
  * @param string $url Параметр содержащий адрес домена для парсинга
  * @return json
  */

  public function parse(Request $request)
  {
    $parse = new Inquiry($request->input('url', 'http://www.bills.ru/'));
    return $parse->getInfo();
  }  
}