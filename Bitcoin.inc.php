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

require_once "Bitcoin/Utils.inc.php";

/**
 * Main Bitcoin class
 *
 * This class contains static helper functions for working with Bitcoin. All derivitive
 * coin implementations (Litecoin, PPCoin, Namecoin) will extend this class.
 *
 * This class borrows (begs and steals) from the bitcoin-php library written by
 * Mike Gogulski: https://github.com/mikegogulski/bitcoin-php/
 */
class Bitcoin {
	
	/**
	 * Validate that the given address is a valid Bitcoin address
	 *
	 * A Bitcoin address, or simply address, is an identifier of 27-34 alphanumeric
	 * characters, beginning with the number 1 or 3, that represents a possible
	 * destination for a Bitcoin payment. Addresses can be generated at no cost by any
	 * user of Bitcoin.
	 * https://en.bitcoin.it/wiki/Address
	 *
	 * @param string $address Bitcoin address
	 *
	 * @return boolean
	 */
	public static function validateAddress($address)
	{
		if (!((strlen($address) >= 27 && strlen($address) <= 34) && (substr($address, 0, 1) === "1" || substr($address, 0, 1) === "3"))) {
			// basic check fails
			return false;
		}
		
		return self::validateAddressChecksum($address);
	}
	
	protected static function validateAddressChecksum($address)
	{
		// get the hex value of the address
		$hexAddress = BitcoinUtils::base58_decode($address);
		if (strlen($hexAddress) !== 50) return false;
		
		// get the checksum from the address, which consists of the last 4 bytes
		$checksum	= substr($hexAddress, 42, 8);

		// compute the checksum of the public key + version byte
		$sha256_1	= hash('sha256', pack('H*', substr($hexAddress, 0, 42)), true);
		$sha256_2	= strtoupper(hash('sha256', $sha256_1));
		
		return ($checksum === substr($sha256_2, 0, 8));
	}
	
	/**
	 * Sign the message string with the private Key
	 *
	 * @param string $message    Message to sign
	 * @param string $privateKey Bitcoin PrivateKey in base58 string format
	 *
	 * @return string Message signature
	 */
	public static function signMessage($message, $privateKey)
	{
	
	}
	
	/**
	 * Verify that the message given was signed by the private key of the address
	 *
	 * @param string $message   Message that was signed
	 * @param string $address   Bitcoin address
	 * @param string $signature Signature 
	 *
	 * @return boolean
	 */
	public static function verifyMessageSignature($message, $address, $signature)
	{
	
	}
}