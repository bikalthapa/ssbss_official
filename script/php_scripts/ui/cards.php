<?php
class Card
{
    public static function get_news_card(array $news, string $relPath = ''): string
    {
        $id = (int) $news['news_id'];
        $title = htmlspecialchars($news['title']);
        $displayTitle = strlen($title) > 35 ? substr($title, 0, 32) . '...' : $title;
        $thumbnail = htmlspecialchars($news['thumbnail']);
        $date = htmlspecialchars($news['upload_date']);
        $imageFullPath = $relPath . 'uploads/images/' . $thumbnail;

        return <<<HTML
    <div class="col">
        <div class="card h-100 shadow-sm border-0 hover-shadow transition rounded-4">
            <a href="{$relPath}category/individual_content.php?news_id={$id}" class="text-decoration-none text-dark">
                <img src="{$imageFullPath}" class="card-img-top rounded-top-4" alt="News Thumbnail" style="height: 200px; object-fit: cover;">
            </a>
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h5 class="card-title fw-semibold">
                        <a href="{$relPath}category/individual_content.php?news_id={$id}" class="text-decoration-none text-dark">{$displayTitle}</a>
                    </h5>
                    <p class="card-text text-muted mb-2">
                        <i class="bi bi-calendar-event me-1"></i>&nbsp;&nbsp;<small>{$date}</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
    HTML;
    }


    public static function get_notice_card(array $notice, string $relPath = ''): string
    {
        $id = (int) $notice['news_id'];
        $title = htmlspecialchars($notice['title']);
        $date = htmlspecialchars($notice['upload_date']);

        return <<<HTML
        <div class="mb-3" style="border: 1px solid lightgrey; max-height: 100px;">
            <a class="row" style="text-decoration: none;" href="{$relPath}category/individual_content.php?notice_id={$id}">
                <div class="col-md-4 bg-info text-light">
                    <p class="text-center text-dark">{$date}</p>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text">{$title}</p>
                    </div>
                </div>
            </a>
        </div>
        HTML;
    }

    public static function get_document_card(array $document, string $relPath = ''): string
    {
        $id = (int) $document['doc_id'];
        $title = htmlspecialchars($document['doc_title']);
        $date = htmlspecialchars($document['upload_date']);

        return <<<HTML
        <div class="mb-3" style="max-height:100px; border:1px solid lightgrey;">
            <a class="row" style="text-decoration: none;" href="{$relPath}category/individual_content.php?doc_id={$id}">
                <div class="col-md-4 bg-info text-light position-relative">
                    <span class="position-absolute top-0 start-100 translate-middle badge bg-danger">PDF</span>
                    <p class="text-center text-dark">{$date}</p>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text">{$title}</p>
                    </div>
                </div>
            </a>
        </div>
        HTML;
    }
}
?>