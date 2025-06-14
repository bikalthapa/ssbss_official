<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Faculties</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .faculty-card img {
      height: 180px;
      object-fit: cover;
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }
    .faculty-card {
      transition: transform 0.3s ease;
      border-radius: 0.5rem;
    }
    .faculty-card:hover {
      transform: translateY(-5px);
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="text-center mb-5">
    <h2 class="fw-bold text-primary">हाम्रो विद्यालयका संकायहरू</h2>
    <p class="text-muted">शिक्षाका विभिन्न तहहरू र तिनका विशेषताहरू</p>
  </div>

  <div class="row g-4">

    <!-- Engineering -->
    <div class="col-md-6 col-lg-4">
      <div class="card faculty-card shadow border-0 h-100">
        <img src="images/faculties/engineering.jpg" class="card-img-top" alt="Engineering Faculty">
        <div class="card-body">
          <h5 class="card-title fw-semibold text-warning">इन्जिनियरिङ (कक्षा ९–१२)</h5>
          <p class="card-text text-secondary">कम्प्युटर इन्जिनियरिङ विषय सहितको प्राविधिक शिक्षा, स्मार्ट बोर्ड प्रयोग सहित।</p>
        </div>
      </div>
    </div>

    <!-- English Medium -->
    <div class="col-md-6 col-lg-4">
      <div class="card faculty-card shadow border-0 h-100">
        <img src="images/faculties/english_medium.jpg" class="card-img-top" alt="English Medium">
        <div class="card-body">
          <h5 class="card-title fw-semibold text-info">English Medium (Nursery–10)</h5>
          <p class="card-text text-secondary">विद्यालयको अंग्रेजी माध्यम कक्षा नर्सरीदेखि कक्षा १० सम्मका लागि।</p>
        </div>
      </div>
    </div>

    <!-- +2 Education & Management -->
    <div class="col-md-6 col-lg-4">
      <div class="card faculty-card shadow border-0 h-100">
        <img src="images/faculties/management.jpg" class="card-img-top" alt="Management Faculty">
        <div class="card-body">
          <h5 class="card-title fw-semibold text-success">+2 शिक्षा तथा व्यवस्थापन</h5>
          <p class="card-text text-secondary">कक्षा ११ र १२ मा शिक्षा तथा व्यवस्थापन विषयहरूको पढाइ।</p>
        </div>
      </div>
    </div>

    <!-- Nepali Medium -->
    <div class="col-md-6 col-lg-4">
      <div class="card faculty-card shadow border-0 h-100">
        <img src="images/faculties/nepali_medium.jpg" class="card-img-top" alt="Nepali Medium">
        <div class="card-body">
          <h5 class="card-title fw-semibold text-secondary">नेपाली माध्यम</h5>
          <p class="card-text text-secondary">नर्सरीदेखि माध्यमिक तहसम्म नेपाली भाषामा अध्ययन व्यवस्था।</p>
        </div>
      </div>
    </div>

    <!-- +2 Science -->
    <div class="col-md-6 col-lg-4">
      <div class="card faculty-card shadow border-0 h-100">
        <img src="images/faculties/science.jpg" class="card-img-top" alt="+2 Science">
        <div class="card-body">
          <h5 class="card-title fw-semibold text-danger">+2 विज्ञान</h5>
          <p class="card-text text-secondary">कक्षा ११ र १२ मा भौतिक, रसायन र जीवविज्ञान विषयमा विशेष ध्यान।</p>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
