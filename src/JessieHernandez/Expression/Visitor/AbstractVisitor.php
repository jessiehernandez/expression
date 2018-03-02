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
namespace JessieHernandez\Expression\Visitor;

use JessieHernandez\Expression\Equals as EqualsExpression;
use JessieHernandez\Expression\Expression;
use JessieHernandez\Expression\GreaterThan as GreaterThanExpression;
use JessieHernandez\Expression\GreaterThanOrEqualTo as GreaterThanOrEqualToExpression;
use JessieHernandez\Expression\LessThanOrEqualTo as LessThanOrEqualToExpression;
use JessieHernandez\Expression\LogicalAnd as LogicalAndExpression;
use JessieHernandez\Expression\Mul as MulExpression;

/**
 * Convenience base class for visitors.
 *
 * @package    JessieHernandez\Expression
 * @subpackage Visitor
 * @author     Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
abstract class AbstractVisitor implements Visitor
{
    /**
     * {@inheritdoc}
     */
    public function visitEquals(EqualsExpression $expr)
    {
        return $this->twoExpressionOperator('==', $expr->getChildren());
    }

    /**
     * {@inheritdoc}
     */
    public function visitGreaterThan(GreaterThanExpression $expr)
    {
        return $this->twoExpressionOperator('>', $expr->getChildren());
    }

    /**
     * {@inheritdoc}
     */
    public function visitGreaterThanOrEqualTo(GreaterThanOrEqualToExpression $expr)
    {
        return $this->twoExpressionOperator('>=', $expr->getChildren());
    }

    /**
     * {@inheritdoc}
     */
    public function visitLessThanOrEqualTo(LessThanOrEqualToExpression $expr)
    {
        return $this->twoExpressionOperator('<=', $expr->getChildren());
    }

    /**
     * {@inheritdoc}
     */
    public function visitLogicalAnd(LogicalAndExpression $expr)
    {
        return $this->twoExpressionOperator('&&', $expr->getChildren());
    }

    /**
     * {@inheritdoc}
     */
    public function visitMul(MulExpression $expr)
    {
        return $this->twoExpressionOperator('*', $expr->getChildren());
    }

    /**
     * Generic processor for a two-expression operator expression.
     *
     * @param  string $operator The operator.
     * @param  Expression[] $operands The operands.
     * @return mixed Result.
     */
    protected abstract function twoExpressionOperator(string $operator, array $operands);
}
