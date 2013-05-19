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
 
require_once "Bitcoin.inc.php";
require_once "Litecoin/Utils.inc.php";

/**
 * Main Litecoin class
 *
 * This class contains static helper functions for working with Litecoin.
 *
 * see: https://en.bitcoin.it/wiki/Litecoin
 */
class Litecoin extends Bitcoin {
	
	/**
	 * Validate that the given address is a valid Litecoin address
	 *
	 * A Litecoin address, or simply address, is an identifier of 27-34 alphanumeric
	 * characters, beginning with the letter "L", that represents a possible
	 * destination for a Litecoin payment. Addresses can be generated at no cost by any
	 * user of Litecoin.
	 * https://en.bitcoin.it/wiki/Address
	 *
	 * @param string $address Litecoin address
	 *
	 * @return boolean
	 */
	public static function validateAddress($address)
	{
		if (!((strlen($address) >= 27 && strlen($address) <= 34) && substr($address, 0, 1) === "L")) {
			// basic check fails
			return false;
		}
		
		return parent::validateAddressChecksum($address);
	}
}