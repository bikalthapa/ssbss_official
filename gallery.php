<?php
include "script/php_scripts/header_and_footer.php";
require_once "script/php_scripts/database.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gallery | SSBSS</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="../../Style/style.css" />
  <link rel="icon" href="images/slogo.png" type="image/png" />
  <style>
    .gallery-section {
      padding: 4rem 1rem;
      background: #f8f9fa;
    }

    .gallery-title {
      font-size: 2.5rem;
      font-weight: 600;
      margin-bottom: 2rem;
      text-align: center;
      color: #343a40;
    }

    .masonry {
      column-count: 3;
      column-gap: 1rem;
    }

    @media (max-width: 768px) {
      .masonry {
        column-count: 2;
      }
    }

    @media (max-width: 576px) {
      .masonry {
        column-count: 1;
      }
    }

    .masonry-item {
      break-inside: avoid;
      margin-bottom: 1rem;
      border-radius: 1rem;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .masonry-item:hover {
      transform: translateY(-5px);
    }

    .gallery-img {
      width: 100%;
      height: auto;
      display: block;
    }
  </style>
</head>

<body>

  <?php print_header("gallery"); ?>

  <section class="gallery-section">
    <div class="container">
      <h2 class="gallery-title" data-i18n="menu.gallery">Gallery</h2>
      <div class="masonry">

        <?php
        $query = "SELECT * FROM news_img ORDER BY n_img_id DESC";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $imagePath = "uploads/images/" . htmlspecialchars($row['filename']);
            echo '
            <div class="masonry-item">
              <img src="' . $imagePath . '" alt="News Image" class="gallery-img">
            </div>';
          }
        } else {
          echo '<p class="text-center">No images found in the gallery.</p>';
        }
        ?>

      </div>
    </div>
  </section>

  <?php print_footer(); ?>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="data/translation.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
</body>

</html>
