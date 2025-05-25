<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Masonry with Limit & Overlay</title>
  <style>
    body {
      font-family: sans-serif;
      background: #f4f4f4;
      padding: 20px;
    }

    .container {
      width: 800px;
      height: 500px;
      border: 2px solid #ddd;
      border-radius: 8px;
      padding: 10px;
      background: white;
      overflow: hidden;
    }

    .masonry {
      column-count: 3;
      column-gap: 10px;
      height: 100%;
    }

    .masonry .photo-item {
      position: relative;
      break-inside: avoid;
      margin-bottom: 10px;
    }

    .masonry img {
      width: 100%;
      border-radius: 6px;
      display: block;
    }

    .overlay {
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      color: white;
      font-size: 2em;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 6px;
    }
  </style>
</head>
<body>

<h2>Masonry Layout with +N Overlay (No Scroll)</h2>

<div class="container">
  <div class="masonry" id="masonry"></div>
</div>

<script>
  const imageUrls = [
    'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=400',
    'https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?w=400',
    'https://images.unsplash.com/photo-1589571894960-20bbe2828d0a?w=400',
    'https://images.unsplash.com/photo-1523413651479-597eb2da0ad6?w=400',
    'https://images.unsplash.com/photo-1518806118471-f28b20a1d79d?w=400',
    'https://images.unsplash.com/photo-1535930749574-1399327ce78f?w=400',
    'https://images.unsplash.com/photo-1541696432-82c6da8ce7bf?w=400',
  ];

  const maxVisible = 5;
  const masonry = document.getElementById('masonry');

  imageUrls.slice(0, maxVisible).forEach((url, i) => {
    const item = document.createElement('div');
    item.className = 'photo-item';

    const img = document.createElement('img');
    img.src = url;
    item.appendChild(img);

    // Add overlay if it's the last visible one AND more images exist
    if (i === maxVisible - 1 && imageUrls.length > maxVisible) {
      const overlay = document.createElement('div');
      overlay.className = 'overlay';
      overlay.textContent = `+${imageUrls.length - maxVisible}`;
      item.appendChild(overlay);
    }

    masonry.appendChild(item);
  });
</script>

</body>
</html>
