<?php
/*
 * This file is part of the jessiehernandez/expression package.
 *
 * (c) Jessie Hernandez <jessie.hernandez@protonmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);
namespace JessieHernandez\Expression\EvaluationContext;

use PHPUnit\Framework\TestCase;

/**
 * Black hole evaluation context tester.
 *
 * @package    JessieHernandez\Expression
 * @subpackage EvaluationContext
 * @author     Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
class BlackHoleTest extends TestCase
{
    /**
     * Tests that all variable accesses return null.
     *
     * @return void
     */
    public function testAllVariableAccessesReturnNull() : void
    {
        $context = new BlackHole();
        $context->set('test', 'value');

        $this->assertNull($context->get('test'));
        $this->assertNull($context->get('other'));
    }
}
