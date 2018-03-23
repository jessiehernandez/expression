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
namespace JessieHernandez\Expression;

use JessieHernandez\Expression\Visitor\Visitor;

/**
 * Trait used for expressions which have two operands.
 *
 * @package JessieHernandez\Expression
 * @author  Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
trait TwoOperandExpression
{
    /**
     * Constructor.
     *
     * @param Expression $exprA Left operand.
     * @param Expression $exprB Right operand.
     */
    public function __construct(Expression $exprA, Expression $exprB)
    {
        $this->exprA = $exprA;
        $this->exprB = $exprB;
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren() : array
    {
        return [$this->exprA, $this->exprB];
    }

    /**
     * Left operand.
     *
     * @var Expression
     */
    private $exprA = null;

    /**
     * Right operand.
     *
     * @var Expression
     */
    private $exprB = null;
}
