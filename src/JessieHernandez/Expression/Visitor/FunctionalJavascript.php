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
 * Converts an expression to a functional JavaScript code block.
 *
 * @package    JessieHernandez\Expression
 * @subpackage Visitor
 * @author     Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
class FunctionalJavascript extends AbstractVisitor
{
    /**
     * Constructor.
     *
     * @param array $options Options.
     */
    public function __construct(array $options = [])
    {
        $this->className = ($options['className'] ?? $this->className);
    }

    /**
     * {@inheritdoc}
     */
    public function visit(Expression $expr, Expression ...$subexpressions)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function visitInArray(InArrayExpression $expr)
    {
        $operands = $expr->getChildren();
        return $this->className . '.inArray(' . $operands[0]->accept($this) . ',' . $operands[1]->accept($this) . ')';
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
        '==' => 'equals',
        '>'  => 'greaterThan',
        '>=' => 'greaterThanOrEqualTo',
        'in' => 'inArray',
        '<'  => 'lessThan',
        '<=' => 'lessThanOrEqualTo',
        '&&' => 'logicalAnd',
        '||' => 'logicalOr',
        '*'  => 'mul',
        '!=' => 'notEquals',
    ];

    /**
     * Name of the JavaScript class that holds all the operator functions.
     *
     * @var string
     */
    private $className = 'Expr';
}
