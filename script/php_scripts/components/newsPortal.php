<?php
include __DIR__.'/../ui/pagination.php';

class NewsPortal
{
    private mysqli $conn;
    private int $limit = 10;
    private bool $isLimitSet = false;
    private int $currentPage = 1;

    public function __construct(Database $db)
    {
        $this->conn = $db->getConnection();
    }

    public function setLimit(int $limit): void
    {
        $this->isLimitSet = true;
        $this->limit = $limit;
    }

    public function setCurrentPage(int $page): void
    {
        $this->currentPage = max(1, $page);
    }

    private function fetchWithPagination(string $table, string $conditions, string $orderBy = 'id DESC', string $baseUrl = '?page='): array
    {
        $paginator = new Paginator($this->conn, $table, $this->limit, $this->currentPage, $conditions);

        if ($this->isLimitSet == false) {
            $sql = "SELECT * FROM {$table} WHERE {$conditions} ORDER BY {$orderBy}";
            $data = $this->conn->query($sql);
            return ['data' => $data, 'pagination' => null];
        } else {
            $data = $paginator->getData($orderBy);
            $pagination = $paginator->renderLinks($baseUrl);
            return ['data' => $data, 'pagination' => $pagination];
        }
    }

    public function getNews(string $baseUrl = '?page='): array
    {
        return $this->fetchWithPagination('news', "type = 'news'", 'news_id DESC', $baseUrl);
    }

    public function getNotices(string $baseUrl = '?page='): array
    {
        return $this->fetchWithPagination('news', "type = 'notice'", 'news_id DESC', $baseUrl);
    }

    public function getDocuments(string $baseUrl = '?page='): array
    {
        return $this->fetchWithPagination('documents', '1', 'doc_id DESC', $baseUrl);
    }
}
?>