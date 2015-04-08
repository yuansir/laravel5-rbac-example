<?php namespace App\Foundation\Pagination;

use Illuminate\Pagination\BootstrapThreePresenter;

class Paginator extends BootstrapThreePresenter {

    /**
     * Convert the URL window into Bootstrap HTML.
     *
     * @return string
     */
    public function render()
    {
        if ($this->hasPages()) {
            return sprintf(
                '<ul class="am-pagination">%s %s %s</ul>', $this->getPreviousButton(), $this->getLinks(), $this->getNextButton()
            );
        }

        return '';
    }

    /**
     * Get HTML wrapper for disabled text.
     *
     * @param  string  $text
     * @return string
     */
    protected function getDisabledTextWrapper($text)
    {
        return '<li class="am-disabled"><span>'.$text.'</span></li>';
    }

    /**
     * Get HTML wrapper for active text.
     *
     * @param  string  $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        return '<li class="am-active"><span>'.$text.'</span></li>';
    }


}