<?php

namespace App\Application\Interfaces;

interface OrderRepositoryInterface
{
    public function create(array $data);
    // public function findById(int $id);
    // public function update(int $id, array $data);
    public function getAll();
    // public function delete(int $id);
    public function getRecentSales();
}
