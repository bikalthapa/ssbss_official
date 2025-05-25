<?php
class Paginator
{
    private $conn;
    private $table;
    private $conditions;
    private $perPage;
    private $currentPage;
    private $totalRows;

    public function __construct(mysqli $conn, string $table, int $perPage = 10, int $currentPage = 1, string $conditions = '1')
    {
        $this->conn = $conn;
        $this->table = $table;
        $this->perPage = $perPage;
        $this->currentPage = max(1, $currentPage);
        $this->conditions = $conditions;

        $this->totalRows = $this->getTotalRows();
    }

    private function getTotalRows(): int
    {
        $sql = "SELECT COUNT(*) AS total FROM {$this->table} WHERE {$this->conditions}";
        $result = $this->conn->query($sql);
        if ($result && $row = $result->fetch_assoc()) {
            return (int) $row['total'];
        }
        return 0;
    }

    public function getData(string $orderBy = 'id DESC'): mysqli_result|false
    {
        $offset = ($this->currentPage - 1) * $this->perPage;
        $sql = "SELECT * FROM {$this->table} WHERE {$this->conditions} ORDER BY {$orderBy} LIMIT {$offset}, {$this->perPage}";
        return $this->conn->query($sql);
    }

    public function getTotalPages(): int
    {
        return ceil($this->totalRows / $this->perPage);
    }

    public function renderLinks(string $baseUrl = '?page='): string
    {
        $totalPages = $this->getTotalPages();
        if ($totalPages <= 1)
            return ''; // No need for pagination

        $html = '<ul class="pagination justify-content-center">';

        $prevPage = $this->currentPage - 1;
        $nextPage = $this->currentPage + 1;

        // First page link
        $html .= '<li class="page-item ' . ($this->currentPage <= 1 ? 'disabled' : '') . '">';
        $html .= '<a class="page-link" href="' . ($this->currentPage > 1 ? "{$baseUrl}1" : '#') . '">&laquo;</a></li>';

        // Previous page link
        $html .= '<li class="page-item ' . ($this->currentPage <= 1 ? 'disabled' : '') . '">';
        $html .= '<a class="page-link" href="' . ($this->currentPage > 1 ? "{$baseUrl}{$prevPage}" : '#') . '">&lsaquo;</a></li>';

        // Determine start and end page (max 4 page numbers shown)
        $start = max(1, $this->currentPage - 1);
        $end = min($totalPages, $start + 3);
        if ($end - $start < 3) {
            $start = max(1, $end - 3);
        }

        for ($i = $start; $i <= $end; $i++) {
            $active = ($i == $this->currentPage) ? 'active' : '';
            $html .= "<li class='page-item {$active}'><a class='page-link' href='{$baseUrl}{$i}'>{$i}</a></li>";
        }

        // Next page link
        $html .= '<li class="page-item ' . ($this->currentPage >= $totalPages ? 'disabled' : '') . '">';
        $html .= '<a class="page-link" href="' . ($this->currentPage < $totalPages ? "{$baseUrl}{$nextPage}" : '#') . '">&rsaquo;</a></li>';

        // Last page link
        $html .= '<li class="page-item ' . ($this->currentPage >= $totalPages ? 'disabled' : '') . '">';
        $html .= '<a class="page-link" href="' . ($this->currentPage < $totalPages ? "{$baseUrl}{$totalPages}" : '#') . '">&raquo;</a></li>';

        $html .= '</ul>';
        return $html;
    }

}
?>