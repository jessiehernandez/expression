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
 * Converts an expression to a JavaScript code block.
 *
 * @package    JessieHernandez\Expression
 * @subpackage Visitor
 * @author     Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
class Javascript extends AbstractVisitor
{
    /**
     * Constructor.
     *
     * @param array $options Options.
     */
    public function __construct(array $options = [])
    {
        $this->variablePrefix = ($options['variablePrefix'] ?? '');
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
        return $this->variablePrefix . $operands[1]->accept($this) . '.includes(' . $operands[0]->accept($this) . ')';
    }

    /**
     * {@inheritdoc}
     */
    public function visitTerminal(TerminalExpression $expr)
    {
        $result = $expr->evaluate(new BlackHole());
        return (empty($this->visitingVariableStack) ? json_encode($result) : $result);
    }

    /**
     * {@inheritdoc}
     */
    public function visitVariable(VariableExpression $expr)
    {
        // Push the "visiting variable" state to the stack
        $this->visitingVariableStack[] = 1;

        $result = $this->variablePrefix . $expr->getChildren()[0]->accept($this);

        // Pop the "visiting variable" state from the stack
        array_pop($this->visitingVariableStack);
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    protected function twoExpressionOperator(string $operator, array $operands)
    {
        return '(' . $operands[0]->accept($this) . $operator . $operands[1]->accept($this) . ')';
    }

    /**
     * The prefix to prepend for variable references.
     *
     * @var string
     */
    private $variablePrefix = '';

    /**
     * Stack that indicates if we are visiting a variable.
     *
     * @var array
     */
    private $visitingVariableStack = [];
}
