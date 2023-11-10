<?php

namespace NinjaTiktokFeed\Application\Hooks\Handlers;

use NinjaTiktokFeed\Application\Services\Platforms\Feeds\Tiktok\TiktokFeed;
use WPSocialReviews\Framework\Foundation\App;
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Helper as GlobalHelper;
use WPSocialReviews\App\Services\GlobalSettings;
use NinjaTiktokFeed\Application\Traits\LoadView;

class TiktokTemplateHandler
{
    /**
     *
     * Render parent opening div for the template item
     *
     * @param $template_meta
     *
     * @since 3.7.0
     *
     **/
    use LoadView;
    public function renderTemplateItemWrapper($template_meta = []){
        $app = App::getInstance();

        $desktop_column = Arr::get($template_meta, 'responsive_column_number.desktop');
        $tablet_column = Arr::get($template_meta, 'responsive_column_number.tablet');
        $mobile_column = Arr::get($template_meta, 'responsive_column_number.mobile');

        $classes = 'wpsr-mb-30 wpsr-col-' . esc_attr($desktop_column) . ' wpsr-col-sm-' . esc_attr($tablet_column) . ' wpsr-col-xs-' . esc_attr($mobile_column);
        $app->view->render('public.feeds-templates.tiktok.elements.item-parent-wrapper', array(
            'classes' => $classes,
        ));
    }

    public function renderFeedAuthor($feed = [], $template_meta = [], $displayStatistics = false)
    {
        $app = App::getInstance();
        $app->view->render('public.feeds-templates.tiktok.elements.author', array(
            'feed'          => $feed,
            'account'       => Arr::get($feed, 'user'),
            'template_meta' => $template_meta,
            'displayStatistics' => $displayStatistics
        ));
    }

    public function renderFeedDescription($feed = [], $template_meta = [])
    {
        if (Arr::get($template_meta, 'post_settings.display_description') === 'false') {
            return;
        }
        $app = App::getInstance();
        $allowed_tags = GlobalHelper::allowedHtmlTags();

        $app->view->render('public.feeds-templates.tiktok.elements.description', array(
            'feed'          => $feed,
            'allowed_tags'  => $allowed_tags,
            'message'       => Arr::get($feed, 'description'),
            'content_length'    => Arr::get($template_meta, 'post_settings.content_length' , 15),
        ));
    }

    public function renderFeedMedia($feed = [], $template_meta = [])
    {
        $app = App::getInstance();

        $app->view->render('public.feeds-templates.tiktok.elements.media', array(
            'feed'          => $feed,
            'template_meta' => $template_meta,
        ));
    }

    public function renderFeedIcon($class = '')
    {
        $app = App::getInstance();
        $app->view->render('public.feeds-templates.tiktok.elements.icon', array(
            'class' => $class
        ));
    }

    public function renderFeedDate($feed = [])
    {
        $translations =  GlobalSettings::getTranslations();

        $app = App::getInstance();
        $app->view->render('public.feeds-templates.tiktok.elements.date', array(
            'feed'  => $feed
        ));
    }

    public function getPaginatedFeedHtml($templateId = null, $page = null , $feed_id = null , $feed_type = '')
    {
        $app = App::getInstance();
        $shortcodeHandler = new ShortcodeHandler();
        $template_meta = $shortcodeHandler->templateMeta($templateId, 'tiktok');
        $feed = (new TiktokFeed())->getTemplateMeta($template_meta, $templateId);
        $settings = $shortcodeHandler->formatFeedSettings($feed);
        $pagination_settings = $shortcodeHandler->formatPaginationSettings($feed);
        $sinceId = (($page - 1) * $pagination_settings['paginate']);
        $maxId = ($sinceId + $pagination_settings['paginate']) - 1;

        return (string)$app->view->make('public.feeds-templates.tiktok.template1', array(
            'templateId' => $templateId,
            'feeds' => $settings['feeds'],
            'template_meta' => $settings['feed_settings'],
            'paginate' => $pagination_settings['paginate'],
            'sinceId' => $sinceId,
            'maxId' => $maxId,
            'translations' => GlobalSettings::getTranslations()
        ));
    }

    public function renderLoadMoreButton ($template_meta = null, $templateId = null, $paginate = null, $layout_type = "", $total = null, $feed_type = "", $feed = null)
    {
        $app = App::getInstance();
        $app->view->render('public.feeds-templates.tiktok.elements.load-more', array(
            'template_meta' => $template_meta,
            'templateId' => $templateId,
            'paginate' => $paginate,
            'layout_type' => $layout_type,
            'feed_type' => $feed_type,
            'feed' => $feed,
            'total' => $total
        ));
    }
    public function loadTokTokView($fileName, $data)
    {
        $html = $this->loadView('html_code', $data);
        header("Content-Type: text/html");
        echo $html;
    }
}