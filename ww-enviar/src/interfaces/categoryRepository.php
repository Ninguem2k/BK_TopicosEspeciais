<?php
// categoryRepository.php

interface ICategoriesRepository {
    public function findOneById(string $id): ?Category;
    public function findOneByName(string $name): ?Category;
    public function find(int $skip = null, int $take = null): ?array;
    public function create(ICreateCategoryDTO $categoryDTO): void;
    public function update(Category $category, IUpdateCategoryDTO $categoryDTO): void;
    public function delete(string $id): void;
}
?>
