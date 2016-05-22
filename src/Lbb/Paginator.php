<?php
/**
 * LbbEngine (http://lbbniu.com/)
 * A development engine based on Phalcon Framework.
 *
 * @copyright Copyright (c) 2014-2015 LbbEngine Team (https://github.com/lbbniu/LbbEngine)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Lbb;

use Phalcon\Paginator\Adapter\QueryBuilder as PhalconPaginator;

/**
 * Paginator class based Phalcon QueryBuilder Paginator, more parameters support.
 * Class Paginator
 *
 * @package Lbb
 */
class Paginator extends PhalconPaginator
{
    /**
     * @var array
     */
    protected $query;

    /**
     * @var int
     */
    protected $pagerRange = 3;
    /**
     * @var \Phalcon\Paginator\Adapter\stdClass
     */
    protected $_paginate = null;

    /**
     * @param $number int
     *
     * @return $this
     */
    public function setPagerRange($number)
    {
        $this->pagerRange = $number;

        return $this;
    }

    /**
     * @return int
     */
    public function getPagerRange()
    {
        return $this->pagerRange;
    }

    /**
     * @param array $query
     *
     * @return $this
     */
    public function setQuery(array $query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * 注意：同一个 Paginator 对象一旦执行了 getPaginate 方法以后，
     * 即使修改了 paginator 的其他属性，获取的都是同一个 paginate.
     *
     * @return \Phalcon\Paginator\Adapter\stdClass
     */
    public function getPaginate()
    {
        if ($this->_paginate !== null) {
            return $this->_paginate;
        }
        $paginate = parent::getPaginate();
        $paginate->offset_start = 0;
        $paginate->offset_end = 0;
        if ($paginate->total_items > 0) {
            $paginate->offset_start = ($paginate->current - 1)
                * ceil($paginate->total_items / $paginate->total_pages) + 1;
            $paginate->offset_end
                = $paginate->offset_start + count($paginate->items) - 1;
        }

        $i = 0;
        $pageRange = $this->getPagerRange();
        $prevPageRange = array();
        $prevPageRangeSkip = false;
        if ($paginate->current > 1) {
            $i = $paginate->current - $pageRange;
            $i = $i <= 1 ? 1 : $i;
            for (; $i < $paginate->current; $i++) {
                $prevPageRange[] = $i;
            }
            if ($prevPageRange && $prevPageRange[0] > 1) {
                $prevPageRangeSkip = true;
            }
        }

        $nextPageRange = array();
        $nextPageRangeSkip = false;
        if ($paginate->current < $paginate->total_pages) {
            $limit = $paginate->current + $pageRange;
            $limit = $limit >= $paginate->total_pages
                ? $paginate->total_pages : $limit;
            $i = $paginate->current + 1;
            for (; $i <= $limit; $i++) {
                $nextPageRange[] = $i;
            }
            if ($nextPageRange
                && $nextPageRange[count($nextPageRange) - 1] < $paginate->total_pages
            ) {
                $nextPageRangeSkip = true;
            }
        }

        $paginate->page_range = $pageRange;
        $paginate->prev_skip = $prevPageRangeSkip;
        $paginate->prev_range = $prevPageRange;
        $paginate->next_skip = $nextPageRangeSkip;
        $paginate->next_range = $nextPageRange;
        $paginate->query = $this->getQuery();
        $this->_paginate = $paginate;

        return $this->_paginate;
    }
}
