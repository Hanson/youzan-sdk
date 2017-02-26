<?php

namespace Hanson\Youzan\Tag;


use Hanson\Youzan\Core\AbstractAPI;
use Illuminate\Support\Collection;

class Tag extends AbstractAPI
{
    const API_UPDATE = 'https://open.youzan.com/api/entry/kdt.itemcategories.tag/1.0.0/update';
    const API_ADD = 'https://open.youzan.com/api/entry/kdt.itemcategories.tag/1.0.0/add';
    const API_DELETE = 'https://open.youzan.com/api/entry/kdt.itemcategories.tag/1.0.0/delete';
    const API_GET = 'https://open.youzan.com/api/entry/kdt.itemcategories.tags/1.0.0/get';
    const API_GET_CATEGORY = 'https://open.youzan.com/api/entry/kdt.itemcategories/1.0.0/get';
    const API_GET_BY_PAGE = 'https://open.youzan.com/api/entry/kdt.itemcategories.tags/1.0.0/getpage';

    /**
     * update a tag
     *
     * @param $params
     * @return bool
     */
    public function update($params)
    {
        $result = $this->parseJSON('post', 'kdt.itemcategories.tag.update', [self::API_UPDATE, $params]);

        return $result['response']['is_success'];
    }

    /**
     * get tags by page
     * 
     * @param $params
     * @return Collection
     */
    public function paginate($params = [])
    {
        $result = $this->parseJSON('post', 'kdt.itemcategories.tags.getpage', [self::API_GET_BY_PAGE, $params]);

        return new Collection($result['response']['tags']);
    }

    /**
     * get tags
     *
     * @param bool $isSort
     * @return Collection
     */
    public function get($isSort = false)
    {
        $result = $this->parseJSON('post', 'kdt.itemcategories.tags.get', [self::API_GET, ['is_sort' => $isSort ? 1 : 0]]);

        return new Collection($result['response']['tags']);
    }

    /**
     * get all categories
     *
     * @return Collection
     */
    public function getCategories()
    {
        $result = $this->parseJSON('post', 'kdt.itemcategories.get', [self::API_GET_CATEGORY, []]);

        return new Collection($result['response']['categories']);
    }

    /**
     * add a tag
     *
     * @param $name
     * @return Collection
     */
    public function add($name)
    {
        $result = $this->parseJSON('post', 'kdt.itemcategories.tag.add', [self::API_ADD, ['name' => $name]]);

        return new Collection($result['response']['tag']);
    }

    /**
     * delete a tag
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $result = $this->parseJSON('post', 'kdt.itemcategories.tag.delete', [self::API_DELETE, ['tag_id' => $id]]);

        return $result['response']['is_success'];
    }

}