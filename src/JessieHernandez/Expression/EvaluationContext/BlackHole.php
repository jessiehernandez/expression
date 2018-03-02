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
namespace JessieHernandez\Expression\EvaluationContext;

/**
 * Black hole evaluation context.
 *
 * @package    JessieHernandez\Expression
 * @subpackage EvaluationContext
 * @author     Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
class BlackHole implements EvaluationContext
{
    /**
     * {@inheritdoc}
     */
    public function get(string $name)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $name, $value)
    {
    }
}
