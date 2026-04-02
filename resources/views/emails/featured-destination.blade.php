<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #0B1426, #1a2744); padding: 30px; text-align: center; color: #fff; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { color: #F4A261; margin: 8px 0 0; }
        .content { padding: 30px; }
        .destination-name { font-size: 22px; color: #0B1426; margin: 0 0 8px; }
        .location { color: #666; margin: 0 0 16px; }
        .description { color: #333; line-height: 1.6; }
        .badge { display: inline-block; background: #FF6B6B; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .footer { background: #f8f8f8; padding: 20px; text-align: center; color: #999; font-size: 13px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌍 Wanderlust Guides</h1>
            <p>New Featured Destination</p>
        </div>
        <div class="content">
            <span class="badge">⭐ Featured</span>
            <h2 class="destination-name" style="margin-top: 16px;">{{ $destination->name }}</h2>
            <p class="location">📍 {{ $destination->location }}</p>
            <p class="description">{{ $destination->short_description }}</p>
            @if($destination->category)
                <p style="margin-top: 16px;"><strong>Category:</strong> {{ $destination->category->name }}</p>
            @endif
            @if($destination->rating)
                <p><strong>Rating:</strong> {{ $destination->rating }}/5.0 ⭐</p>
            @endif
        </div>
        <div class="footer">
            <p>This is an automated notification from Wanderlust Guides CMS.</p>
        </div>
    </div>
</body>
</html>
