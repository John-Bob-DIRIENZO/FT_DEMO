<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function getAll(): array;

    public function getById(int $id): object;

    public function create(object $object): object;

    public function update(object $object): bool;

    public function deleteById(int $id): bool;
}
