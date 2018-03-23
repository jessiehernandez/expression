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

use JessieHernandez\Expression\EvaluationContext\BlackHole;
use JessieHernandez\Expression\Expression;
use JessieHernandez\Expression\InArray as InArrayExpression;
use JessieHernandez\Expression\Terminal as TerminalExpression;
use JessieHernandez\Expression\Variable as VariableExpression;

/**
 * Processes an expression and converts it to a literal PHP expression.
 *
 * @package    JessieHernandez\Expression
 * @subpackage Visitor
 * @author     Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
class Literal extends AbstractVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(Expression $expr, Expression ...$subexpressions)
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function visitInArray(InArrayExpression $expr)
    {
        $operands = $expr->getChildren();
        return 'in_array(' . $operands[0]->accept($this) . ',' . $operands[1]->accept($this) . ')';
    }

    /**
     * {@inheritdoc}
     */
    public function visitTerminal(TerminalExpression $expr)
    {
        $result = $expr->evaluate(new BlackHole());

        if (is_string($result) && !is_numeric($result)) {
            $result = "'" . addslashes($result) . "'";
        } elseif (is_array($result)) {
            $result = json_encode($result);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function visitVariable(VariableExpression $expr)
    {
        return '$' . preg_replace('/^\'|\'$/', '', $expr->getChildren()[0]->accept($this));
    }

    /**
     * {@inheritdoc}
     */
    protected function twoExpressionOperator(string $operator, array $operands)
    {
        return '(' . $operands[0]->accept($this) . $operator . $operands[1]->accept($this) . ')';
    }
}
