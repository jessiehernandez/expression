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
use JessieHernandez\Expression\Terminal as TerminalExpression;
use JessieHernandez\Expression\Variable as VariableExpression;

/**
 * Converts an expression to a functional JavaScript code block.
 *
 * @package    JessieHernandez\Expression
 * @subpackage Visitor
 * @author     Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
class FunctionalJavascript extends AbstractVisitor
{
    /**
     * {@inheritdoc}
     */
    public function visit(Expression $expr, Expression ...$subexpressions)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function visitTerminal(TerminalExpression $expr)
    {
        return json_encode($expr->evaluate(new BlackHole()));
    }

    /**
     * {@inheritdoc}
     */
    public function visitVariable(VariableExpression $expr)
    {
        return $this->className . '.variable(' . $expr->getChildren()[0]->accept($this) . ')';
    }

    /**
     * {@inheritdoc}
     */
    protected function twoExpressionOperator(string $operator, array $operands)
    {
        return $this->className . '.' . self::$operatorMap[$operator]
            . '('
            . $operands[0]->accept($this)
            . ','
            . $operands[1]->accept($this)
            . ')';
    }

    /**
     * Operator to function map.
     *
     * @var array
     */
    private static $operatorMap = [
        '='  => 'equals',
        '>'  => 'greaterThan',
        '>=' => 'greaterThanOrEqualTo',
        '<=' => 'lessThanOrEqualTo',
        '&&' => 'logicalAnd',
        '*'  => 'mul'
    ];

    /**
     * Name of the JavaScript class that holds all the operator functions.
     *
     * @var string
     */
    private $className = 'Expr';
}
