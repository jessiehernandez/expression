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
class Standard implements EvaluationContext
{
    /**
     * {@inheritdoc}
     */
    public function get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $name, $value) : void
    {
        $this->data[$name] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function setMultiple(array $variables) : void
    {
        $this->data = array_merge($this->data, $variables);
    }

    /**
     * Data.
     *
     * @var array
     */
    private $data = [];
}
