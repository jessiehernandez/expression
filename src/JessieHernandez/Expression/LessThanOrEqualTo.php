<?php
/**
 * @package JessieHernandez\Expression
 */

declare(strict_types=1);
namespace JessieHernandez\Expression;

use JessieHernandez\Expression\EvaluationContext\EvaluationContext;
use JessieHernandez\Expression\Visitor\Visitor;

/**
 * Less-than-or-equals expression.
 *
 * @package JessieHernandez\Expression
 * @author  Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
class LessThanOrEqualTo implements Expression
{
    use TwoOperandExpression;

    /**
     * {@inheritdoc}
     */
    public function accept(Visitor $visitor)
    {
        return $visitor->visitLessThanOrEqualTo($this);
    }

    /**
     * {@inheritdoc}
     */
    public function evaluate(EvaluationContext $context)
    {
        return ($this->exprA->evaluate($context) <= $this->exprB->evaluate($context));
    }
}
