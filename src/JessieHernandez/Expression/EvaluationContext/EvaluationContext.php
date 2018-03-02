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
 * Interface for evaluation contexts.
 *
 * @package    JessieHernandez\Expression
 * @subpackage EvaluationContext
 * @author     Jessie Hernandez <jessie.hernandez@protonmail.com>
 */
interface EvaluationContext
{
    /**
     * Returns the value of a variable.
     *
     * @param  string $name The name of the variable.
     * @return mixed The value of the variable, or null if it is not set.
     */
    public function get(string $name);

    /**
     * Sets a variable.
     *
     * @param  string $name The name of the variable to set.
     * @param  mixed $value The value of the variable.
     * @return void
     */
    public function set(string $name, $value);
}
