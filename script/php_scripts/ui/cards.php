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
    <div class="card mb-3 border-0 shadow-sm hover-shadow transition" style="background-color: #fefbea;">
        <a href="{$relPath}category/individual_content.php?notice_id={$id}" class="text-decoration-none text-dark">
            <div class="row g-0">
                <!-- Date -->
                <div class="col-md-4 bg-info d-flex flex-column justify-content-center align-items-center text-white py-3">
                    <i class="bi bi-calendar-event fs-6 mb-1"></i>
                    <small class="fw-semibold">{$date}</small>
                </div>
                <!-- Title -->
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text fw-semibold" style="font-size: 16px;">{$title}</p>
                    </div>
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
    <div class="card mb-3 border-0 shadow-sm hover-shadow transition" style="background-color: #fefbea;">
        <a href="{$relPath}category/individual_content.php?doc_id={$id}" class="text-decoration-none text-dark">
            <div class="row g-0">
                <!-- Date and PDF Badge -->
                <div class="col-md-4 bg-info text-white d-flex flex-column justify-content-center align-items-center position-relative py-3">
                    <i class="bi bi-file-earmark-pdf fs-6 mb-2"></i>
                    <small class="fw-semibold">{$date}</small>
                    <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger">
                        PDF
                    </span>
                </div>

                <!-- Title -->
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text fw-semibold" style="font-size: 16px;">{$title}</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    HTML;
    }

}
?>