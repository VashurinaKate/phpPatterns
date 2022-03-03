<?php
/** Применение IdentityMap */

declare(strict_types = 1);

namespace Model\Repository;

use Model\Entity;

class Product
{
    private $identityMap = [];

    // Добавление в identityMap

    public function add($product)
    {
        $key = $this->getGlobalKey(get_class($product), $product->getId());
 
        $this->identityMap[$key] = $product;
    }

    // Получение из identityMap

    public function get(string $classname, int $id)
    {
        $key = $this->getGlobalKey($classname, $id);
 
        if (isset($this->identityMap[$key])) {
            return $this->identityMap[$key];
        } else {
            // Обращение к БД, возвращаем продукт
        }
    }
 
    private function getGlobalKey(string $classname, int $id)
    {
        return sprintf('%s.%d', $classname, $id);
    }


    public function search(array $ids = []): array
    {
        if (!count($ids)) {
            return [];
        }

        $productList = [];
        foreach ($this->getDataFromSource(['id' => $ids]) as $item) {
            $productList[] = new Entity\Product($item['id'], $item['name'], $item['price']);
        }

        return $productList;
    }

    public function fetchAll(): array
    {
        $productList = [];
        foreach ($this->getDataFromSource() as $item) {
            $productList[] = new Entity\Product($item['id'], $item['name'], $item['price']);
        }

        return $productList;
    }

    private function getDataFromSource(array $search = [])
    {
        $dataSource = $this->identityMap;
        // $dataSource = [
        //     [
        //         'id' => 1,
        //         'name' => 'PHP',
        //         'price' => 15300,
        //     ],
        //     [
        //         'id' => 2,
        //         'name' => 'Python',
        //         'price' => 20400,
        //     ],
        //     [
        //         'id' => 3,
        //         'name' => 'C#',
        //         'price' => 30100,
        //     ],
        //     [
        //         'id' => 4,
        //         'name' => 'Java',
        //         'price' => 30600,
        //     ],
        //     [
        //         'id' => 5,
        //         'name' => 'Ruby',
        //         'price' => 18600,
        //     ],
        //     [
        //         'id' => 8,
        //         'name' => 'Delphi',
        //         'price' => 8400,
        //     ],
        //     [
        //         'id' => 9,
        //         'name' => 'C++',
        //         'price' => 19300,
        //     ],
        //     [
        //         'id' => 10,
        //         'name' => 'C',
        //         'price' => 12800,
        //     ],
        //     [
        //         'id' => 11,
        //         'name' => 'Lua',
        //         'price' => 5000,
        //     ],
        // ];

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return in_array($dataSource[key($search)], current($search), true);
        };

        return array_filter($dataSource, $productFilter);
    }
}
