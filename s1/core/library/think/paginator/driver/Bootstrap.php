<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: zhangyajun <448901948@qq.com>
// +----------------------------------------------------------------------

namespace think\paginator\driver;

use think\Paginator;

class Bootstrap extends Paginator
{
    /**
     * 首页按钮
     * @param string $text
     * @return string
     */
    protected function getFirstButton($text = "&laquo;")
    {

        if ($this->currentPage() <= 1) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url(1);

        return $this->getPageLinkWrapper($url, $text);
    }
    /**
     * 上一页按钮
     * @param string $text
     * @return string
     */
    protected function getPreviousButton($text = "&laquo;")
    {

        if ($this->currentPage() <= 1) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url(
            $this->currentPage() - 1
        );

        return $this->getPageLinkWrapper($url, $text);
    }

    /**
     * 下一页按钮
     * @param string $text
     * @return string
     */
    protected function getNextButton($text = '&raquo;')
    {
        if (!$this->hasMore) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url($this->currentPage() + 1);

        return $this->getPageLinkWrapper($url, $text);
    }
    /**
     * 末页按钮
     * @param string $text
     * @return string
     */
    protected function getLastButton($text = '&raquo;')
    {
        if (!$this->hasMore) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url($this->lastPage);

        return $this->getPageLinkWrapper($url, $text);
    }

    /**
     * 共N页 N条
     * @param string $text
     * @return string
     */
    protected function getTotalResult()
    {
        return '共'.$this->lastPage.'页/共'.$this->total.'条';
    }
    /**
     * 页码按钮
     * @return string
     */
    protected function getLinks($side=3)
    {
        if ($this->simple)
            return '';

        $block = [
            'first'  => null,
            'slider' => null,
            'last'   => null
        ];

        //$side   = 3;
        $window = $side * 2;

//        if ($this->lastPage < $window + 1) {
//            $block['first'] = $this->getUrlRange(1, $this->lastPage);
//        } elseif ($this->currentPage <= $window) {
//            $block['first'] = $this->getUrlRange(1, $window + 2);
//            $block['last']  = $this->getUrlRange($this->lastPage - 1, $this->lastPage);
//        } elseif ($this->currentPage > ($this->lastPage - $window)) {
//            $block['first'] = $this->getUrlRange(1, 2);
//            $block['last']  = $this->getUrlRange($this->lastPage - ($window + 2), $this->lastPage);
//        } else {
//            $block['first']  = $this->getUrlRange(1, 2);
//            $block['slider'] = $this->getUrlRange($this->currentPage - $side, $this->currentPage + $side);
//            $block['last']   = $this->getUrlRange($this->lastPage - 1, $this->lastPage);
//        }
//
//        $html = '';
//
//        if (is_array($block['first'])) {
//            $html .= $this->getUrlLinks($block['first']);
//        }
//
//        if (is_array($block['slider'])) {
//            //$html .= $this->getDots();
//            $html .= $this->getUrlLinks($block['slider']);
//        }
//
//        if (is_array($block['last'])) {
//            //$html .= $this->getDots();
//            $html .= $this->getUrlLinks($block['last']);
//        }
        if ($this->lastPage < $window +1) {
            $block['slider'] = $this->getUrlRange(1, $this->lastPage);

        } elseif ($this->currentPage <= $window-1) {

            $block['slider'] = $this->getUrlRange(1, $window + 1);
        } elseif ($this->currentPage > ($this->lastPage - $window+1)) {
            $block['slider']  = $this->getUrlRange($this->lastPage - ($window), $this->lastPage);

        } else {

            $block['slider'] = $this->getUrlRange($this->currentPage - $side, $this->currentPage + $side);
        }

        $html = '';

        if (is_array($block['first'])) {
            $html .= $this->getUrlLinks($block['first']);
        }

        if (is_array($block['slider'])) {
            $html .= $this->getUrlLinks($block['slider']);
        }

        if (is_array($block['last'])) {
            $html .= $this->getUrlLinks($block['last']);
        }
        return $html;
    }

    /**
     * 渲染分页html
     * @return mixed
     */
    public function render($listitem = '', $listsize = '')
    {
        if ($this->hasPages()) {
            if ($this->simple) {
                return sprintf(
                    '<ul class="pager">%s %s</ul>',
                    $this->getPreviousButton(),
                    $this->getNextButton()
                );
            } else {
                $listitemArr = explode(',', $listitem);
                foreach ($listitemArr as $key => $val) {
                    $listitemArr[$key] = trim($val);
                }

                $pageArr = array();
                if (in_array('index', $listitemArr)) {
                    array_push($pageArr, $this->getFirstButton('首页'));
                }

                if (in_array('pre', $listitemArr)) {
                    array_push($pageArr, $this->getPreviousButton('上一页'));
                }

                if (in_array('pageno', $listitemArr)) {
                    array_push($pageArr, $this->getLinks($listsize));
                }

                if (in_array('next', $listitemArr)) {
                    array_push($pageArr, $this->getNextButton('下一页'));
                }

                if (in_array('end', $listitemArr)) {
                    array_push($pageArr, $this->getLastButton('尾页'));
                }
                if (in_array('info', $listitemArr)) {
                    array_push($pageArr, $this->getTotalResult());
                }

                $pageStr = '<ul class="pagination">'.implode(' ', $pageArr).'</ul>';

                return $pageStr;

//                return sprintf(
//                    '<ul class="pagination">%s %s %s</ul>',
//                    $this->getPreviousButton(),
//                    $this->getLinks(),
//                    $this->getNextButton()
//                );

            }
        }
    }

    /**
     * 生成一个可点击的按钮
     *
     * @param  string $url
     * @param  int    $page
     * @return string
     */
    protected function getAvailablePageWrapper($url, $page)
    {
        return '<li><a href="' . htmlentities($url) . '">' . $page . '</a></li>';
    }

    /**
     * 生成一个禁用的按钮
     *
     * @param  string $text
     * @return string
     */
    protected function getDisabledTextWrapper($text)
    {
        return '<li class="disabled"><span>' . $text . '</span></li>';
    }

    /**
     * 生成一个激活的按钮
     *
     * @param  string $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        return '<li class="active"><span>' . $text . '</span></li>';
    }

    /**
     * 生成省略号按钮
     *
     * @return string
     */
    protected function getDots()
    {
        return $this->getDisabledTextWrapper('...');
    }

    /**
     * 批量生成页码按钮.
     *
     * @param  array $urls
     * @return string
     */
    protected function getUrlLinks(array $urls)
    {
        $html = '';

        foreach ($urls as $page => $url) {
            $html .= $this->getPageLinkWrapper($url, $page);
        }

        return $html;
    }

    /**
     * 生成普通页码按钮
     *
     * @param  string $url
     * @param  int    $page
     * @return string
     */
    protected function getPageLinkWrapper($url, $page)
    {
        if ($page == $this->currentPage()) {
            return $this->getActivePageWrapper($page);
        }

        return $this->getAvailablePageWrapper($url, $page);
    }
}
