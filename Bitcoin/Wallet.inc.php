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
 * Bitcoin wallet class
 *
 * @uses BitcoinKeyPair
 */
class BitcoinWallet {
	
	/**
	 * Constructor
	 *
	 * @param mixed  $walletLocation File location of wallet or wallet blob (if from DB)
	 * @param string $password       Encryption password of the wallet
	 */
	public __construct ($walletLocation, $password)
	{
		if (file_exists($walletLocation)) {
			$wallet = file_get_contents($walletLocation);
		} else {
			$wallet = $walletLocation;
		}
		
		$decryptedWallet = $this->decryptWallet($wallet, $password);

		if (!is_array($decryptedWallet))
			throw new Exception('Failed to decrypt wallet');
			
		$this->wallet = $decryptedWallet;
	}
	
	/**
	 * Save the wallet to the location given
	 */
	public function saveWallet($walletLocation, $password)
	{
		$encryptedWallet = $this->encryptWallet($this->wallet, $password);
	}
	
	public funtion isOwnAddress($address)
	{
		if (!$this->wallet)
			throw new Exception('Wallet has not been loaded.');
			
		return array_key_exists($address, $this->wallet);
	}
	
	/**
	 * Create new private key in the wallet
	 */
	public function newKey()
	{
		// from https://en.bitcoin.it/wiki/Base58Check_encoding
		// 1 - Take the version/application byte and payload bytes, and concatenate them together (bytewise).
		
		// 2 - Take the first four bytes of SHA256(SHA256(results of step 1))
		
		// 3 - Concatenate the results of step 1 and the results of step 2 together (bytewise).

		// 4 - Treating the results of step 3 - a series of bytes - as a single big-endian bignumber,
		// convert to base-58 using normal mathematical steps (bignumber division) and the
		// base-58 alphabet described at https://en.bitcoin.it/wiki/Base58Check_encoding#Base58_symbol_chart.
		// The result should be normalized to not have any leading base-58 zeroes (character '1').

		// 5 - The leading character '1', which has a value of zero in base58, is reserved
		// for representing an entire leading zero byte, as when it is in a leading position,
		// has no value as a base-58 symbol. There can be one or more leading '1's when necessary
		// to represent one or more leading zero bytes. Count the number of leading zero bytes
		// that were the result of step 3 (for old Bitcoin addresses, there will always be
		// at least one for the version/application byte; for new addresses, there will never
		// be any). Each leading zero byte shall be represented by its own character '1' in
		// the final result.

		// 6 - Concatenate the 1's from step 5 with the results of step 4.	
	}
}