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

use JessieHernandez\Expression\EvaluationContext\EvaluationContext;
use JessieHernandez\Expression\Visitor\Visitor;

/**
 * Expression interface.
 *
 * @package JessieHernandez\Expression
 * @author  Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
interface Expression
{
    /**
     * Accepts a visitor which will visit this expression and its children.
     *
     * @param  Visitor $visitor Visitor.
     * @return mixed The result of the visit.
     */
    public function accept(Visitor $visitor);

    /**
     * Evaluates this expression against an evaluation context.
     *
     * @param  EvaluationContext $context Evaluation context.
     * @return mixed Value.
     */
    public function evaluate(EvaluationContext $context);

    /**
     * Returns any child expressions for this expression.
     *
     * @return Expression[] Child expressions.
     */
    public function getChildren() : array;
}
