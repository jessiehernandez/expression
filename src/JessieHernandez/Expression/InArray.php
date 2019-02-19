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
 * In-array expression.
 *
 * @package JessieHernandez\Expression
 * @author  Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
class InArray implements Expression
{
    use TwoOperandExpression;

    /**
     * {@inheritdoc}
     */
    public function accept(Visitor $visitor)
    {
        return $visitor->visitInArray($this);
    }

    /**
     * {@inheritdoc}
     */
    public function evaluate(EvaluationContext $context)
    {
        $array = $this->exprB->evaluate($context);
        return in_array($this->exprA->evaluate($context), (array) ($array ?? []));
    }
}
