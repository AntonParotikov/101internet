<?php
/**
* @author Антон паротиков <novenok@mail.ua>
* @version 1.0
* @package Inquiry
*/ 

namespace App\Http\Models;
use Illuminate\Support\Facades\DB;

/**
* Модель Inquiry, выполняет запрос и обработку данных, которые отдает обратно в контроллер
*/

class Inquiry
{

	/**
	* Получение значения
	* @param string $url Параметр содержащий адрес домена для парсинга
	* @return void
	*/

	public function __construct($url)
	{
		$this->url = $url;
	}

	/**
	* В этом методе мы запрашиваем данные с 
	* урла и отдаем его на обработку в метод handler
	* @return array
	*/

	public function getInfo()
	{
		$data = $this->request(trim($this->url, '/'));
		return $this->handler($data);
	}	

	/**
	* Метод загрузки данных с удаленного адреса и устаноки кодировки
	* @param string $url Параметр содержащий адрес ресурса на который мы будем делать запрос
	* @return string
	*/

	private function request($url)
	{
		// Готовим cURL
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_URL, $url);

	    // Получаем html
	    $res = curl_exec($ch);
	    curl_close($ch);
	    return iconv('CP1251','UTF-8',$res);
	}

	/**
	* Главный метод который обрабатывает данные и записывает в бд. 
	* @param string $data содержит контент с странички сайта которую надо пропарсить
	* @return array
	*/

	private function handler($data) {
		$data = $this->cutData($data,'<!--Блок новостей-->','<!--Блок новостей END-->');
		$news_list = explode('<tr class="bizon_api_news_row">', $data);
		unset($news_list[0]);
		foreach ($news_list as $key => $value) {
			$this->data[$key] = array(
					'url' => $this->cutData($value,'href="','">',6),
					'title' => $this->cutData(stristr($value,'href="'),'">','</a>',2)
			);
			$date = $this->data[$key]['url'];
			// поскольку дата на главной страничке сайта не содержит времени то распаршиваем каждую страничку записи отдельно
			$date = $this->request($date);
			$date = $this->cutData($date,'news_timestamp">','</span>',16);
			$date = $this->convertDate($date,'news_timestamp">','</span>',16);
			$this->data[$key]['date'] = $date;
		}
		DB::table('parse_table')->insert($this->data);
		return $this->data;
	}

	/**
	* Вспомогательный метод конвертации даты в необходимый формат (год-месяц-день часы:минуты:секунды). 
	* @param string $data содержит распаршенную дату записи
	* @return string
	*/

	private function convertDate($data) {
		$data = explode(', ', $data);
		$date = explode(' ', $data[0]);		
		$date = array(
			'year' => '2017',	
			'month' => $date[1],	
			'day' => $date[0],	
			);
		$time = explode(':', $data[1]);			
		$time = array(	
			'hour' => $time[0],	
			'minutes' => $time[1],	
			'seconds' => '00'
			);	
		return implode('-',$date).' '.implode(':',$time);
	}

	/**
	* Вспомогательный метод обрезания лишнего контента). 
	* @param string $data содержит кусок текста из которого будем вырезать
	* @param string $first указывает с какой фразы надо обрезать
	* @param string $second указывает до какой фразы надо обрезать
	* @param string $cut Указывает надо ли отрезать первые символы запроса
	* @return string
	*/

	private function cutData($data,$first,$second,$cut = false) {
		$data = stristr($data,$first);
		$data = stristr($data,$second,true);
		if ($cut) $data = substr($data,$cut);
		return $data;
	}
}