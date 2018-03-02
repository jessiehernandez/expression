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
 * Between expression.
 *
 * @package JessieHernandez\Expression
 * @author  Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
class Between implements Expression
{
    /**
     * Constructor.
     *
     * @param Expression $expr The expression that will be compared.
     * @param Expression $low The low value.
     * @param Expression $high The high value.
     */
    public function __construct(Expression $expr, Expression $low, Expression $high)
    {
        $this->exprA   = new GreaterThanOrEqualTo($expr, $low);
        $this->exprB   = new LessThanOrEqualTo($expr, $high);
        $this->andExpr = new LogicalAnd($this->exprA, $this->exprB);
    }

    /**
     * {@inheritdoc}
     */
    public function accept(Visitor $visitor)
    {
        return $visitor->visit($this->andExpr);
    }

    /**
     * {@inheritdoc}
     */
    public function evaluate(EvaluationContext $context)
    {
        return $this->andExpr->evaluate($context);
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren() : array
    {
        return [$this->exprA, $this->exprB];
    }

    /**
     * And expression.
     *
     * @var LogicalAnd
     */
    private $andExpr = null;

    /**
     * Greater-than expression.
     *
     * @var Expression
     */
    private $exprA = null;

    /**
     * Less-than expression.
     *
     * @var Expression
     */
    private $exprB = null;
}
