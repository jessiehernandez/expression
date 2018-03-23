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
 * Variable expression.
 *
 * @package JessieHernandez\Expression
 * @author  Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
class Variable implements Expression
{
    /**
     * Constructor.
     *
     * @param mixed $name Variable name (either a literal name or an expression that evaluates to a name).
     */
    public function __construct($name)
    {
        if (is_scalar($name)) {
            $name = new Terminal($name);
        }

        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function accept(Visitor $visitor)
    {
        return $visitor->visitVariable($this);
    }

    /**
     * {@inheritdoc}
     */
    public function evaluate(EvaluationContext $context)
    {
        return $context->get((string) $this->name->evaluate($context));
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren() : array
    {
        return [$this->name];
    }

    /**
     * Variable name.
     *
     * @var \JessieHernandez\Expression\Expression
     */
    private $name = null;
}
