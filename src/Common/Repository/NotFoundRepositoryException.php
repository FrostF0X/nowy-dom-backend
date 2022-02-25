<?php

namespace App\Common\Repository;

use JetBrains\PhpStorm\Pure;
use RuntimeException;

class NotFoundRepositoryException extends RuntimeException
{
    #[Pure] public static function any(string $class): self
    {
        return new self(sprintf('Cannot find any "%s"', $class));
    }

    /**
     * @template T of object
     * @param ?T $entity
     * @param class-string<T> $class
     * @param string $id
     * @return T
     */
    public static function throwIfNotFound(mixed $entity, string $class, string $id): object
    {
        if (!$entity instanceof $class) {
            throw self::id($class, $id);
        }
        return $entity;
    }

    #[Pure] public static function id(string $class, string $id): self
    {
        return new self(sprintf('Cannot find "%s" with id "%s"', $class, $id));
    }

    /**
     * @template T of object
     * @param ?T $entity
     * @param class-string<T> $class
     * @param array<bool|float|int|string|null> $withArgs
     * @return T
     */
    public static function throwIfNotFoundWith(mixed $entity, string $class, string $with, array $withArgs): object
    {
        if (!$entity instanceof $class) {
            throw self::with($class, $with, $withArgs);
        }
        return $entity;
    }

    /**
     * @param array<bool|float|int|string|null> $withArgs
     */
    #[Pure] public static function with(string $class, string $with, array $withArgs): self
    {
        return new self(sprintf('Cannot find "%s" with ' . $with, $class, ...$withArgs));
    }

}
