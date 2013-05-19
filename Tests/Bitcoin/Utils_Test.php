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
  * Just run the phpunit command in the top level folder to run these tests
  * For complete documentation see: http://phpunit.de/manual/current/en/
  */
 class BitcoinUtils_Test extends PHPUnit_Framework_TestCase {
	protected function setUp()
	{
	}

	protected function tearDown()
	{
	}
	
	public function test_base58_decode()
	{
		// from https://github.com/ThePiachu/Bitcoin-Unit-Tests/
		$this->assertEquals('00010966776006953D5567439E5E39F86A0D273BEED61967F6', BitcoinUtils::base58_decode('16UwLL9Risc3QfPqBUvKofHmBQ7wMtjvM'));
		$this->assertEquals('003A91CC0AF51BE125369A25FAC9CE5A950EF491AB06B2C8FB', BitcoinUtils::base58_decode('16LgrHNVKbrySfS97wegnWWA5P8fb62FQN'));
		$this->assertEquals('00714076A39428B9B904F4007DCD1519EF97B8784775C992F5', BitcoinUtils::base58_decode('1BKpag8kykZNTxR2mw5qTEwUwmZX71c3JU'));
		$this->assertEquals('00B9E57DF33679BCAABF4F7318082B703E4859AFCEDC276FCE', BitcoinUtils::base58_decode('1HwvvsZjbAATRm5V1mw6i7g8sZ8gRqQQfX'));
	}
	
	public function test_base58_encode()
	{
		// from https://github.com/ThePiachu/Bitcoin-Unit-Tests/
		$this->assertEquals('16UwLL9Risc3QfPqBUvKofHmBQ7wMtjvM', BitcoinUtils::base58_encode('00010966776006953D5567439E5E39F86A0D273BEED61967F6'));
		$this->assertEquals('16LgrHNVKbrySfS97wegnWWA5P8fb62FQN', BitcoinUtils::base58_encode('003A91CC0AF51BE125369A25FAC9CE5A950EF491AB06B2C8FB'));
		$this->assertEquals('1BKpag8kykZNTxR2mw5qTEwUwmZX71c3JU', BitcoinUtils::base58_encode('00714076A39428B9B904F4007DCD1519EF97B8784775C992F5'));
		$this->assertEquals('1HwvvsZjbAATRm5V1mw6i7g8sZ8gRqQQfX', BitcoinUtils::base58_encode('00B9E57DF33679BCAABF4F7318082B703E4859AFCEDC276FCE'));
	}
	
	public function test_dechex()
	{
		$actual = BitcoinUtils::dechex('0');
        $this->assertInternalType('string', $actual);
		$this->assertEquals('0', $actual);

		$actual = BitcoinUtils::dechex('255');
        $this->assertInternalType('string', $actual);
		$this->assertEquals('FF', $actual);

		$actual = BitcoinUtils::dechex('4722366482869645213695');
        $this->assertInternalType('string', $actual);
		$this->assertEquals('FFFFFFFFFFFFFFFFFF', $actual);
	}

	public function test_hexdec()
	{
		$actual = BitcoinUtils::hexdec('0');
        $this->assertInternalType('string', $actual);
		$this->assertEquals('0', $actual);

		$actual = BitcoinUtils::hexdec('FF');
        $this->assertInternalType('string', $actual);
		$this->assertEquals('255', $actual);

		$actual = BitcoinUtils::hexdec('FFFFFFFFFFFFFFFFFF');
        $this->assertInternalType('string', $actual);
		$this->assertEquals('4722366482869645213695', $actual);
	}
 }