<?php
namespace App\Controller\Component;
use App\Controller\AppController;
use Cake\Controller\Component;
class NumbersComponent extends Component
{
   function convertNumberToWord($number) {

		$hyphen      = '-';
		$conjunction = ' and ';
		$separator   = ' ';
		$negative    = 'negative ';
		$decimal     = ' and ';
		$dictionary  = array(
			0                   => 'Zero',
			1                   => 'One',
			2                   => 'Two',
			3                   => 'Three',
			4                   => 'Four',
			5                   => 'Five',
			6                   => 'Six',
			7                   => 'Seven',
			8                   => 'Eight',
			9                   => 'Nine',
			10                  => 'Ten',
			11                  => 'Eleven',
			12                  => 'Twelve',
			13                  => 'Thirteen',
			14                  => 'Fourteen',
			15                  => 'Fifteen',
			16                  => 'Sixteen',
			17                  => 'Seventeen',
			18                  => 'Eighteen',
			19                  => 'Nineteen',
			20                  => 'Twenty',
			30                  => 'Thirty',
			40                  => 'Fourty',
			50                  => 'Fifty',
			60                  => 'Sixty',
			70                  => 'Seventy',
			80                  => 'Eighty',
			90                  => 'Ninety',
			100                 => 'Hundred',
			1000                => 'Thousand',
			100000             => 'Lakh',
			10000000          => 'Crore'
		);

		if (!is_numeric($number)) {
			return false;
		}

		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}

		if ($number < 0) {
			return $negative . $this->convertNumberToWord(abs($number));
		}

		$string = $fraction = null;

		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}

		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . $this->convertNumberToWord($remainder);
				}
				break;
			case $number < 100000:
				$thousands   = ((int) ($number / 1000));
				$remainder = $number % 1000;

				$thousands = $this->convertNumberToWord($thousands);

				$string .= $thousands . ' ' . $dictionary[1000];
				if ($remainder) {
					$string .= $separator . $this->convertNumberToWord($remainder);
				}
				break;
			case $number < 10000000:
				$lakhs   = ((int) ($number / 100000));
				$remainder = $number % 100000;

				$lakhs = $this->convertNumberToWord($lakhs);

				$string = $lakhs . ' ' . $dictionary[100000];
				if ($remainder) {
					$string .= $separator . $this->convertNumberToWord($remainder);
				}
				break;
			case $number < 1000000000:
				$crores   = ((int) ($number / 10000000));
				$remainder = $number % 10000000;

				$crores = $this->convertNumberToWord($crores);

				$string = $crores . ' ' . $dictionary[10000000];
				if ($remainder) {
					$string .= $separator . $this->convertNumberToWord($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = $this->convertNumberToWord($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= $this->convertNumberToWord($remainder);
				}
				break;
		}

		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}

		return $string;
	}
	
}
?>