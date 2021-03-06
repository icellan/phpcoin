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
 
 require_once "Litecoin.inc.php";
 
 /**
  * Just run the phpunit command in the top level folder to run these tests
  * For complete documentation see: http://phpunit.de/manual/current/en/
  */
 class Litecoin_Test extends PHPUnit_Framework_TestCase {
	protected function setUp()
	{
	}

	protected function tearDown()
	{
	}
	
	public function test_validateAddress()
	{
		$this->AssertTrue(Litecoin::validateAddress('LWaFezDtucfCA4xcVEfs3R3xfgGWjSwcZr'), 'LWaFezDtucfCA4xcVEfs3R3xfgGWjSwcZr fails');
		$this->AssertTrue(Litecoin::validateAddress('LXwHM6mRd432EzLJYwuKQMPhTzrgr7ur9K'), 'LXwHM6mRd432EzLJYwuKQMPhTzrgr7ur9K fails');
		$this->AssertTrue(Litecoin::validateAddress('LZWK8h7C166niP6GmpUmiGrvn4oxPqQgFV'), 'LZWK8h7C166niP6GmpUmiGrvn4oxPqQgFV fails');
		$this->AssertTrue(Litecoin::validateAddress('Lgb6tdqmdW3n5E12johSuEAqRMt4kAr7yu'), 'Lgb6tdqmdW3n5E12johSuEAqRMt4kAr7yu fails');
		
		// invalid addresses
		$this->AssertFalse(Litecoin::validateAddress('LRjyUS2uuieEPkhZNdQz8hE5YycxVEqSX'), 'LRjyUS2uuieEPkhZNdQz8hE5YycxVEqSX does not fail');
		$this->AssertFalse(Litecoin::validateAddress('test'), '"test" does not fail');
	}
 }