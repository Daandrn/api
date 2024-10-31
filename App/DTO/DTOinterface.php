<?php declare(strict_types=1);

namespace App\DTO;

interface DTOinterface
{
    public static function make(object $object): self;
    public function toArray(): array;
}