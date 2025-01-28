<?php
namespace App\Application\Interfaces;

interface ProductRepositoryInterface
{
    public function getAll();
    public function create(array $data);
    public function find($productId);
    public function delete($productId);
    public function findByCategory(string $category);
}
