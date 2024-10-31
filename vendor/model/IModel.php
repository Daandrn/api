<?php

namespace Vendor\model;

require __DIR__ . '/../autoload.php';

interface IModel
{
    public function select(array $params): array;
    public function insert(array $data): bool;
    public function update(array $data, int $id): bool;
    public function delete(int $id): bool;
}
