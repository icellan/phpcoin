<?php
/**
 * PHP coin (https://github.com/icellan/phpcoin/)
 *
 * @link      https://github.com/icellan/phpcoin/ (website does not yet exist)
 * @copyright Nope!
 * @license   Do-whatever-you-want-with-it
 *
 * If you find this library useful, your donation of Bitcoins to address
 * 19h6oF7fS9k3UvNxNSNyqCougdnRTWy4Vv would be greatly appreciated. Thanks!
 * 
 * This is free and unencumbered software released into the public domain.
 * 
 * Anyone is free to copy, modify, publish, use, compile, sell, or
 * distribute this software, either in source code form or as a compiled
 * binary, for any purpose, commercial or non-commercial, and by any
 * means.
 * 
 * In jurisdictions that recognize copyright laws, the author or authors
 * of this software dedicate any and all copyright interest in the
 * software to the public domain. We make this dedication for the benefit
 * of the public at large and to the detriment of our heirs and
 * successors. We intend this dedication to be an overt act of
 * relinquishment in perpetuity of all present and future rights to this
 * software under copyright law.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 * 
 * For more information, please refer to <http://unlicense.org/>
 * 
 * Remember: "Any fool can write code that a computer can understand.
 *            Good programmers write code that humans can understand.” - Martin Fowler, 2008 
 */
 
/**
 * Bitcoin Utils class
 *
 * This class contains static helper functions for working with Bitcoin. All derivitive
 * coin implementations (Litecoin, PPCoin, Namecoin) will extend this class.
 *
 * This class borrows (begs and steals) from the bitcoin-php library written by
 * Mike Gogulski: https://github.com/mikegogulski/bitcoin-php/
 */
class BitcoinUtils {
	private static $hexchars	= "0123456789ABCDEF";
	private static $base58chars	= "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";

	/**
	 * Decode the given base58 string into hex
	 *
	 * See https://en.bitcoin.it/wiki/Base58Check_encoding for details
	 *
	 * @return string Hexadecimal string
	 */
	public static function base58_decode($base58)
	{
		$dec = '0';
		$base58Values = @array_flip(str_split(self::$base58chars));
		for($i = 0; $i < strlen($base58); $i++) {
			$dec = bcadd(bcmul($dec, '58'), $base58Values[$base58[$i]]);
		}
		
		$hex = self::dechex($dec);
		
		// zero pad
		for($i = 0; $i < strlen($base58) && $base58[$i] == '1'; $i++) {
			$hex = '00'.$hex;
		}
		if (strlen($hex) % 2 !== 0) {
			$hex = '0'.$hex;
		}
		
		return $hex;
	}
	
	/**
	 * Encode hex number into a base58Check string.
	 *
	 * From Bitcoin source code: Why base-58 instead of standard base-64 encoding?
	 * - Don't want 0OIl characters that look the same in some fonts and could be used to create visually identical looking account numbers.
	 * - A string with non-alphanumeric characters is not as easily accepted as an account number.
	 * - E-mail usually won't line-break if there's no punctuation to break at.
	 * - Double-clicking selects the whole number as one word if it's all alphanumeric.
	 * 
	 * See https://en.bitcoin.it/wiki/Base58Check_encoding for details
	 *
	 * <pre>
	 * x = convert_bytes_to_big_integer(hash_result)
	 * output_string = ""
	 * while(x > 0) {
	 *   (x, remainder) = divide(x, 58)
	 *   output_string.append(code_string[remainder])
	 * }
	 *
	 * repeat(number_of_leading_zero_bytes_in_hash) {
	 *    output_string.append(code_string[0]);
	 * }
	 *
	 * output_string.reverse();
	 * </pre>
	 *
	 * @param string $hex Hexadecimal string number
	 *
	 * @return string Base58 string
	 */
	public static function base58_encode($hex)
	{
		$dec = self::hexdec($hex);
		$base58 = '';
		while(bccomp($dec, '0') == 1) {
      		$remainder		 = bcmod($dec, '58');
			$dec			 = bcdiv($dec, '58', 0);
			$base58			.= self::$base58chars[$remainder];
		}

		for ($i = 0; $i < strlen($hex) && substr($hex, $i, 2) == "00"; $i += 2) {
			$base58.= self::$base58chars[0];
		}
   
		return strrev($base58);
	}
	
	/**
	 * Convert a decimal number into hexadecimal using bcmath
	 *
	 * See http://www.php.net/manual/en/book.bc.php
	 *
	 * @param string $dec Decimal number
	 *
	 * @return string String representation of the decimal number
	 */ 
	public static function dechex($dec)
	{
		if (bccomp($dec, '0') == 0) return '0';
		$hex = '';
		while (bccomp($dec, '0') == 1) {
			$remainder	 = bcmod($dec, '16');
			$dec		 = bcdiv($dec, '16', 0);
			$hex		.= self::$hexchars[$remainder];
		}

	    return strrev($hex);
	}
	
	/**
	 * Convert a hexadecimal number into decimal using bcmath
	 *
	 * See http://www.php.net/manual/en/book.bc.php
	 *
	 * @param string $hex Hexadecimal number
	 *
	 * @return string String representation of the decimal number
	 */ 
	public static function hexdec($hex)
	{
		$dec = '';
		$length = strlen($hex);
    	for ($i = 1; $i <= $length; $i++) {
        	$dec = bcadd($dec, bcmul(strval(hexdec($hex[$i - 1])), bcpow('16', strval($length - $i))));
        }

	    return $dec;
	}
}