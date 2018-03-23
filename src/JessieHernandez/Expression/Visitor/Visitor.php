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
use JessieHernandez\Expression\InArray as InArrayExpression;
use JessieHernandez\Expression\LessThan as LessThanExpression;
use JessieHernandez\Expression\LessThanOrEqualTo as LessThanOrEqualToExpression;
use JessieHernandez\Expression\LogicalAnd as LogicalAndExpression;
use JessieHernandez\Expression\Mul as MulExpression;
use JessieHernandez\Expression\Terminal as TerminalExpression;
use JessieHernandez\Expression\Variable as VariableExpression;

/**
 * Expression visitor interface.
 *
 * @package    JessieHernandez\Expression
 * @subpackage Visitor
 * @author     Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
interface Visitor
{
    /**
     * Visits a generic expression.
     *
     * @param  Expression $expr Expression.
     * @return mixed The result of the visit.
     */
    public function visit(Expression $expr);

    /**
     * Visits an Equals expression.
     *
     * @param  EqualsExpression $expr Expression.
     * @return mixed The result of the visit.
     */
    public function visitEquals(EqualsExpression $expr);

    /**
     * Visits a GreaterThan expression.
     *
     * @param  GreaterThanExpression $expr Expression.
     * @return mixed The result of the visit.
     */
    public function visitGreaterThan(GreaterThanExpression $expr);

    /**
     * Visits a GreaterThanOrEqualTo expression.
     *
     * @param  GreaterThanOrEqualToExpression $expr Expression.
     * @return mixed The result of the visit.
     */
    public function visitGreaterThanOrEqualTo(GreaterThanOrEqualToExpression $expr);

    /**
     * Visits an InArray expression.
     *
     * @param  InArrayExpression $expr Expression.
     * @return mixed The result of the visit.
     */
    public function visitInArray(InArrayExpression $expr);

    /**
     * Visits a LessThan expression.
     *
     * @param  LessThan $expr Expression.
     * @return mixed The result of the visit.
     */
    public function visitLessThan(LessThanExpression $expr);

    /**
     * Visits a LessThanOrEqualTo expression.
     *
     * @param  LessThanOrEqualToExpression $expr Expression.
     * @return mixed The result of the visit.
     */
    public function visitLessThanOrEqualTo(LessThanOrEqualToExpression $expr);

    /**
     * Visits a LogicalAnd expression.
     *
     * @param  LogicalAndExpression $expr Expression.
     * @return mixed The result of the visit.
     */
    public function visitLogicalAnd(LogicalAndExpression $expr);

    /**
     * Visits a Mul expression.
     *
     * @param  MulExpression $expr Expression.
     * @return mixed The result of the visit.
     */
    public function visitMul(MulExpression $expr);

    /**
     * Visits a Terminal expression.
     *
     * @param  TerminalExpression $expr Expression.
     * @return mixed The result of the visit.
     */
    public function visitTerminal(TerminalExpression $expr);

    /**
     * Visits a Variable expression.
     *
     * @param  VariableExpression $expr Expression.
     * @return mixed The result of the visit.
     */
    public function visitVariable(VariableExpression $expr);
}
