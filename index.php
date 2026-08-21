<?php
header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
require_once __DIR__ . '/config.php';
$landing_slug  = 'dji-osmo-pocket-3';
$nombre_marca  = 'DJI';
$landing_token = obtenerOCrearTokenLanding($landing_slug, "DJI Osmo Pocket 3 Creator Combo | Cámara Gimbal 4K 120fps Sensor 1\"", 1850000);
$precio_num    = 1850000;
$precio_fmt    = '1.850.000';
$es_modo_edicion = isset($_GET['modo_edicion']) && $_GET['modo_edicion'] == '1';
$app_version   = file_exists(__FILE__) ? md5_file(__FILE__) : (string)time();

// ─── Cargar Productos de Otras Landings o Productos Demo ───
$otros_productos = [];
try {
    if (isset($pdo)) {
        $stmt = $pdo->prepare("SELECT slug, producto, precio, imagenes FROM landings WHERE slug != ? ORDER BY id DESC LIMIT 12");
        $stmt->execute([$landing_slug]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $r) {
            $other_slug = $r['slug'];
            $imgs = is_array($r['imagenes']) ? $r['imagenes'] : (json_decode($r['imagenes'] ?? '{}', true) ?: []);
            $raw_img = $imgs['img_1'] ?? ($imgs['producto'] ?? ($imgs['desktop'] ?? 'img/img_1.webp'));
            
            $final_img = (strpos($raw_img, 'http') === 0) ? $raw_img : "../{$other_slug}/" . ltrim($raw_img, '/');
            $otros_productos[] = [
                'slug'   => $other_slug,
                'nombre' => $r['producto'],
                'precio' => '$ ' . number_format($r['precio'], 0, ',', '.'),
                'url'    => "../{$other_slug}/",
                'img'    => $final_img
            ];
            if (count($otros_productos) >= 6) break;
        }
    }
} catch (Exception $e) {}

// Fallback con productos demo de alta calidad para previsualización
if (empty($otros_productos)) {
    $otros_productos = [
        [
            'nombre' => 'DJI Mic 2 Transmisor Inalámbrico con Cancelación de Ruido Inteligente',
            'precio' => '$ 490.000',
            'url'    => '#',
            'img'    => 'https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%203.webp'
        ],
        [
            'nombre' => 'DJI Mini 4 Pro Drone Ultraligero 4K HDR con Detección Omnidireccional',
            'precio' => '$ 3.450.000',
            'url'    => '#',
            'img'    => 'https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%204.webp'
        ],
        [
            'nombre' => 'DJI Osmo Mobile 6 Estabilizador Gimbal Inteligente para Smartphone',
            'precio' => '$ 620.000',
            'url'    => '#',
            'img'    => 'https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%202.webp'
        ],
        [
            'nombre' => 'DJI Action 4 Cámara Deportiva Sumergible 4K 120fps Sensor 1/1.3"',
            'precio' => '$ 1.420.000',
            'url'    => '#',
            'img'    => 'https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%205.webp'
        ],
        [
            'nombre' => 'Batería de Alta Capacidad y Hub de Carga Rápida Osmo Series',
            'precio' => '$ 280.000',
            'url'    => '#',
            'img'    => 'https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%206.webp'
        ],
        [
            'nombre' => 'Estuche Rígido Impermeable de Transporte Premium para Osmo Pocket',
            'precio' => '$ 145.000',
            'url'    => '#',
            'img'    => 'https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%201.webp'
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= htmlspecialchars("DJI Osmo Pocket 3 Creator Combo | Cámara Gimbal 4K 120fps Sensor 1\"") ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.cdnfonts.com">
    <link href="https://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0071e3;
            --primary-hover: #0077ed;
            --accent: #0071e3;
            --btn-bg: #0071e3;
            --topbar-bg: #000000;
            --body-bg: #f5f5f7;
            --card-bg: #ffffff;
            --text-main: #1d1d1f;
            --text-muted: #86868b;
            --border-color: #d2d2d7;
            --border-light: #e5e5ea;
            --star-color: #f5a623;
            --font-heading: 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'SF Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            --font-body: 'SF Pro Text', 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'SF Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        /* ─── RESET Y CONTROL ESTRICTO DE OVERFLOW HORIZONTAL ─── */
        *, *::before, *::after {
            box-sizing: border-box !important;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            max-width: 100% !important;
            overflow-x: hidden !important;
            position: relative;
            font-family: var(--font-body);
            background-color: var(--body-bg);
            color: var(--text-main);
            line-height: 1.47059;
            letter-spacing: -0.011em;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        @media (max-width: 991px) {
            body { padding-bottom: 85px; }
        }

        /* ─── TOPBAR ESTÁTICO (ENVÍOS A TODO COLOMBIA) ─── */
        .top-announcement {
            background-color: var(--topbar-bg, #000000);
            color: #ffffff;
            font-family: var(--font-heading);
            font-size: 11px;
            font-weight: 700;
            padding: 7px 12px;
            line-height: 1.2;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100% !important;
            box-sizing: border-box;
            user-select: none;
        }

        /* ─── NAVBAR CON LOGO CENTRADO (APPLE FROSTED GLASS Y SCROLL DINÁMICO) ─── */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
            min-height: 70px;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box;
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.2s ease, box-shadow 0.2s ease;
            will-change: transform;
        }
        .navbar.nav-hidden {
            transform: translateY(-100%) !important;
        }
        .nav-left { width: 44px; flex-shrink: 0; }
        .nav-center-logo { flex: 1; display: flex; justify-content: center; align-items: center; text-align: center; }
        .brand-logo-img { height: 56px; max-height: 60px; max-width: 220px; width: auto; object-fit: contain; transition: transform 0.2s ease; display: block; margin: 0 auto; }
        .brand-logo-img:hover { transform: scale(1.02); }
        .brand-logo-text { font-family: var(--font-heading); font-size: 26px; font-weight: 700; letter-spacing: -0.02em; color: var(--text-main); text-transform: uppercase; text-decoration: none; display: inline-block; }
        .nav-right { width: 44px; display: flex; justify-content: flex-end; align-items: center; flex-shrink: 0; }
        .cart-trigger { position: relative; background: none; border: none; cursor: pointer; color: #1d1d1f; padding: 6px; }
        .cart-badge-count { position: absolute; top: -2px; right: -4px; background-color: var(--primary); color: #ffffff; font-size: 10px; font-weight: 700; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid #ffffff; }
        @media (min-width: 768px) {
            .navbar { padding: 12px 28px; min-height: 80px; }
            .brand-logo-img { height: 68px; max-height: 72px; max-width: 280px; }
            .brand-logo-text { font-size: 30px; letter-spacing: -0.02em; }
        }

        /* ─── PÁGINA FULL WIDTH (SIN CONTAINER ESTRECHO) ─── */
        .landing-container {
            max-width: 100% !important;
            width: 100% !important;
            margin: 0;
            padding: 0 0 30px 0;
            box-sizing: border-box;
            overflow-x: hidden;
        }
        @media (min-width: 992px) {
            .landing-container { padding: 24px 36px 40px 36px; }
        }

        .product-grid-layout {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            background: transparent;
            border-radius: 0;
            padding: 0;
            box-shadow: none;
            border: none;
            margin: 0;
        }
        @media (min-width: 992px) {
            .product-grid-layout {
                display: grid;
                grid-template-columns: 1.1fr 1fr;
                gap: 48px;
                align-items: start;
                max-width: 100%;
                padding: 0;
            }
        }

        /* ─── GALLERY SECTION CON SLIDE Y PUNTICOS INDICADORES ─── */
        .gallery-wrapper-desktop {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .gallery-slider-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            margin: 0;
            padding: 0;
        }
        .main-image-wrap {
            order: 1;
            width: 100%;
            aspect-ratio: 1 / 1;
            background-color: #fbfbfd;
            border-radius: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: none;
            border: none;
            cursor: pointer;
            box-sizing: border-box;
            touch-action: pan-y pinch-zoom;
            margin: 0;
            padding: 0;
        }
        @media (min-width: 992px) {
            .gallery-wrapper-desktop {
                max-width: 680px;
                margin: 0 auto;
            }
            .main-image-wrap {
                border-radius: 18px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
                border: 1px solid rgba(0, 0, 0, 0.06);
            }
        }
        .gallery-dots-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 14px;
            width: 100%;
            padding: 4px 0;
        }
        .gallery-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #d2d2d7;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.2, 0.8, 0.2, 1);
        }
        .gallery-dot.active {
            background: #59595e;
            width: 24px;
            border-radius: 999px;
        }
        .gallery-dot:hover:not(.active) {
            background: #86868b;
        }
        .main-image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.22s ease-out, transform 0.25s ease-out;
            user-select: none;
            -webkit-user-drag: none;
            display: block;
        }

        /* ─── BOTONES DE MODO VISUALIZACIÓN (LIGHTBOX) ─── */
        .lightbox-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.9) !important;
            border: none !important;
            border-radius: 50%;
            color: #1d1d1f !important;
            font-size: 20px;
            font-weight: 700;
            cursor: pointer;
            display: flex !important;
            align-items: center;
            justify-content: center;
            z-index: 20;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3) !important;
            opacity: 1 !important;
            visibility: visible !important;
            transition: transform 0.15s ease;
        }
        .lightbox-nav-btn:active {
            transform: translateY(-50%) scale(0.92);
        }
        .lightbox-nav-btn.prev { left: 14px; }
        .lightbox-nav-btn.next { right: 14px; }
        @media (min-width: 992px) {
            .lightbox-nav-btn.prev { left: 30px; }
            .lightbox-nav-btn.next { right: 30px; }
        }

        @media (min-width: 1025px) and (hover: hover) {
            .main-image-wrap:hover img {
                transform: scale(1.03);
            }
        }
        @media (max-width: 1024px) {
            .main-image-wrap img {
                transform: none !important;
            }
        }

        .thumbnails-strip { order: 2; display: flex; gap: 10px; overflow-x: auto; padding-bottom: 6px; scrollbar-width: none; -webkit-overflow-scrolling: touch; }
        .thumbnails-strip::-webkit-scrollbar { display: none; }
        .thumb-item { flex: 0 0 68px; height: 68px; border-radius: 12px; overflow: hidden; border: 1.5px solid var(--border-light); cursor: pointer; transition: all 0.2s ease; background: #fbfbfd; }
        .thumb-item.active { border-color: var(--primary); box-shadow: 0 0 0 1px var(--primary); }
        .thumb-item img { width: 100%; height: 100%; object-fit: cover; }

        /* ─── PRODUCT INFORMATION (APPLE MINIMALIST) ─── */
        .product-info { padding: 0 20px; box-sizing: border-box; }
        @media (min-width: 992px) {
            .product-info { padding: 0; }
        }
        .product-title {
            font-family: var(--font-heading);
            font-size: 24px;
            font-weight: 700;
            color: #1d1d1f;
            line-height: 1.25;
            letter-spacing: -0.02em;
            margin-bottom: 10px;
        }
        .rating-row { display: flex; align-items: center; gap: 6px; margin-bottom: 14px; }
        .stars-container { display: flex; color: var(--star-color); font-size: 14px; letter-spacing: 1px; }
        .rating-number { font-size: 13px; font-weight: 600; color: #1d1d1f; }
        .reviews-count { font-size: 13px; color: var(--text-muted); }

        .price-row { display: flex; align-items: baseline; gap: 12px; margin-bottom: 14px; flex-wrap: wrap; }
        .current-price {
            font-family: var(--font-heading);
            font-size: 30px;
            font-weight: 700;
            color: #1d1d1f;
            letter-spacing: -0.025em;
        }
        .old-price {
            font-size: 16px;
            color: var(--text-muted);
            text-decoration: line-through;
            font-weight: 500;
        }
        .discount-pill {
            background: rgba(0, 113, 227, 0.08);
            color: #0071e3;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 980px;
            letter-spacing: -0.01em;
        }

        /* ─── CAJA DE ENVÍO URGENTE Y CONTADOR (ESTILO MERCADOLIBRE / APPLE) ─── */
        .apple-shipping-urgency-box {
            background: #fbfbfd;
            border: 1px solid rgba(0, 166, 80, 0.25);
            border-radius: 12px;
            padding: 12px 14px;
            margin-bottom: 18px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .shipping-lead-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .shipping-flash-icon {
            flex-shrink: 0;
        }
        .shipping-lead-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .shipping-badge-highlight {
            color: #00a650;
            font-size: 14.5px;
            font-weight: 600;
            letter-spacing: -0.01em;
        }
        .shipping-badge-highlight b {
            font-weight: 800;
        }
        .shipping-timer-subtext {
            font-size: 12.5px;
            color: #6e6e73;
            font-weight: 400;
        }
        .shipping-countdown-val {
            color: #d9383a;
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .variant-block { margin-bottom: 16px; border-top: 1px solid var(--border-light); padding-top: 14px; }
        .variant-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; font-size: 13px; }
        .variant-label { font-weight: 600; color: #1d1d1f; letter-spacing: -0.01em; }
        .variant-label span { font-weight: 400; color: var(--text-muted); }
        .swatches-row { display: flex; gap: 12px; align-items: center; }
        .swatch-circle { width: 34px; height: 34px; border-radius: 50%; cursor: pointer; position: relative; border: 2px solid transparent; box-shadow: inset 0 0 0 1px rgba(0,0,0,0.12); transition: all 0.2s ease; }
        .swatch-circle.active { border-color: var(--primary); transform: scale(1.08); }

        .size-block { margin-bottom: 20px; }
        .size-pills-row { display: flex; gap: 10px; }
        .size-pill {
            padding: 8px 18px;
            border: 1.5px solid var(--primary);
            background: rgba(0, 113, 227, 0.05);
            color: var(--primary);
            border-radius: 980px;
            font-size: 13px;
            font-weight: 600;
            font-family: var(--font-body);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .size-pill:hover {
            background: rgba(0, 113, 227, 0.1);
        }

        .desktop-action-row { display: none; gap: 12px; align-items: center; margin-bottom: 22px; }
        .qty-controls-desktop {
            display: flex;
            align-items: center;
            border: 1px solid var(--border-color);
            border-radius: 980px;
            overflow: hidden;
            height: 48px;
            background: #f5f5f7;
        }
        .qty-btn-desktop {
            background: transparent;
            border: none;
            width: 40px;
            height: 100%;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            color: #1d1d1f;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s;
        }
        .qty-btn-desktop:hover { background: #e5e5ea; }
        .qty-val-desktop { width: 40px; text-align: center; font-size: 14px; font-weight: 700; color: #1d1d1f; }
        .btn-add-desktop {
            flex: 1;
            height: 48px;
            background-color: var(--btn-bg, #0071e3);
            color: #ffffff;
            border: none;
            border-radius: 980px;
            font-family: var(--font-heading);
            font-size: 15px;
            font-weight: 600;
            letter-spacing: -0.01em;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 14px rgba(0, 113, 227, 0.28);
        }
        .btn-add-desktop:hover {
            background-color: var(--primary-hover, #0077ed);
            transform: scale(1.015);
            box-shadow: 0 6px 20px rgba(0, 113, 227, 0.38);
        }

        .accordion-item { border-top: 1px solid var(--border-light); background: transparent; }
        .accordion-item:last-of-type { border-bottom: 1px solid var(--border-light); }
        .accordion-header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            background: none;
            border: none;
            font-family: var(--font-heading);
            font-size: 14.5px;
            font-weight: 600;
            color: #1d1d1f;
            cursor: pointer;
            text-align: left;
            letter-spacing: -0.01em;
        }
        .accordion-body { display: none; padding-bottom: 15px; font-size: 13.5px; color: #424245; line-height: 1.55; }
        .accordion-body.open { display: block; }

        .secure-trust-box {
            background: #fbfbfd;
            border: 1px solid var(--border-light);
            border-radius: 12px;
            padding: 14px 18px;
            margin-top: 20px;
        }
        .secure-trust-header { display: flex; align-items: center; gap: 8px; font-family: var(--font-heading); font-size: 13.5px; font-weight: 700; color: #1d1d1f; margin-bottom: 8px; }
        .secure-trust-header svg { flex-shrink: 0; }
        .secure-trust-list { list-style: none; display: flex; flex-direction: column; gap: 6px; padding: 0; margin: 0; }
        .secure-trust-list li { display: flex; align-items: flex-start; gap: 8px; font-size: 12.5px; color: #6e6e73; line-height: 1.4; }
        .secure-trust-list .check-icon { color: #00a650; font-weight: 800; font-size: 13px; line-height: 1.3; }

        /* ─── BANNER MERCADOLIBRE ─── */
        .ml-promo-banner-wrap { max-width: 1200px; width: 100%; margin: 25px auto 10px auto; padding: 0 16px; box-sizing: border-box; cursor: pointer; overflow-x: hidden; }
        .ml-banner-inner { background: #ffe600; border-radius: 50px; padding: 8px 24px; display: flex; align-items: center; justify-content: space-between; gap: 16px; box-shadow: 0 4px 15px rgba(255, 230, 0, 0.25); transition: transform 0.2s, box-shadow 0.2s; overflow: hidden; }
        .ml-banner-inner:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(255, 230, 0, 0.35); }
        .ml-banner-left { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
        .ml-logo-img { height: 38px; max-width: 140px; object-fit: contain; }
        .ml-banner-divider { width: 1px; height: 28px; background: rgba(0, 0, 0, 0.15); flex-shrink: 0; }
        .ml-banner-center { flex: 1; display: flex; align-items: center; gap: 10px; overflow: hidden; white-space: nowrap; }
        .ml-brand-name { font-family: var(--font-heading); font-weight: 800; font-size: 14.5px; color: #111111; letter-spacing: 0.5px; text-transform: uppercase; }
        .ml-product-name { font-family: var(--font-heading); font-weight: 700; font-size: 13.5px; color: #111111; text-transform: uppercase; overflow: hidden; text-overflow: ellipsis; }
        .ml-stripes { color: #d97706; font-weight: 900; font-size: 16px; letter-spacing: -2px; display: flex; }
        .ml-banner-right { flex-shrink: 0; }
        .ml-free-shipping-pill { display: flex; align-items: center; border-radius: 20px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.15); font-family: var(--font-heading); font-size: 11px; font-weight: 800; }
        .pill-dark { background: #0a1945; color: #ffffff; padding: 8px 14px; display: flex; align-items: center; gap: 4px; }
        .pill-white { background: #ffffff; color: #0a1945; padding: 8px 12px; }

        @media (max-width: 768px) {
            .ml-banner-inner { border-radius: 16px; padding: 10px 14px; flex-wrap: wrap; gap: 8px; }
            .ml-banner-divider { display: none; }
            .ml-free-shipping-pill { font-size: 10px; }
            .pill-dark, .pill-white { padding: 6px 10px; }
        }

        /* ─── CUSTOMER REVIEWS SECTION ─── */
        .customer-reviews-section { max-width: 1200px; width: 100%; margin: 36px auto 26px auto; padding: 0 16px; box-sizing: border-box; overflow-x: hidden; font-family: var(--font-body); }
        .reviews-header-block { text-align: center; margin-bottom: 20px; }
        .reviews-main-title { font-family: var(--font-heading); font-size: 24px; font-weight: 700; color: #1d1d1f; margin-bottom: 6px; letter-spacing: -0.02em; }
        .overall-rating-wrap { display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 20px; }
        .overall-rating-num { font-size: 24px; font-weight: 700; color: #1d1d1f; }
        .overall-stars-gold { color: var(--star-color); font-size: 18px; letter-spacing: 2px; }
        .reviews-filters-row { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; padding-bottom: 14px; border-bottom: 1px solid var(--border-light); margin-bottom: 10px; }
        .filters-left-group { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .filters-right-group { display: flex; align-items: center; gap: 8px; }
        .review-filter-pill { display: inline-flex; align-items: center; gap: 6px; font-size: 12px; color: #374151; font-weight: 600; }
        .filter-select-box { border: 1px solid var(--border-color); border-radius: 8px; padding: 6px 24px 6px 10px; font-size: 12px; color: #1d1d1f; background: #ffffff; appearance: none; cursor: pointer; font-weight: 500; }
        .review-card-item { display: grid; grid-template-columns: 220px 1fr auto; gap: 20px; padding: 20px 0; border-bottom: 1px solid var(--border-light); align-items: start; }
        @media (max-width: 768px) { .review-card-item { grid-template-columns: 1fr; gap: 8px; } }
        .reviewer-col { display: flex; border-right: none; flex-direction: column; gap: 3px; }
        .reviewer-name { font-weight: 700; font-size: 13.5px; color: #1d1d1f; }
        .reviewer-meta { font-size: 11.5px; color: var(--text-muted); }
        .review-content-col { display: flex; flex-direction: column; gap: 6px; }
        .review-stars-row { color: var(--star-color); font-size: 13px; letter-spacing: 1px; }
        .review-comment-text { font-size: 13px; color: #1d1d1f; line-height: 1.5; font-weight: 400; }
        .review-date-badge { font-size: 11px; color: var(--text-muted); white-space: nowrap; text-align: right; }
        @media (max-width: 768px) { .review-date-badge { text-align: left; } }
        .reviews-pagination-row { display: flex; justify-content: flex-end; align-items: center; gap: 8px; margin-top: 20px; font-size: 12px; color: var(--text-muted); }
        .page-btn { width: 28px; height: 28px; border: 1px solid transparent; background: transparent; border-radius: 50%; cursor: pointer; font-size: 12px; font-weight: 600; color: #1d1d1f; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s; }
        .page-btn.active { background: #1d1d1f; color: #ffffff; }
        .page-btn:hover:not(.active) { background: #e5e5ea; }

        /* ─── MÁS PRODUCTOS RECOMENDADOS (CRUZADOS) ─── */
        /* ─── QUIENES VIERON ESTE PRODUCTO TAMBIÉN COMPRARON (SLIDE SINGLE-ROW) ─── */
        .more-to-love-section {
            max-width: 1240px;
            width: 100%;
            margin: 36px auto 44px auto;
            padding: 0 20px;
            box-sizing: border-box;
            text-align: center;
            position: relative;
        }
        .section-heading-center {
            font-family: var(--font-heading);
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.015em;
            color: #1d1d1f;
            margin-bottom: 20px;
        }
        .more-slider-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }
        .more-grid {
            display: flex !important;
            flex-wrap: nowrap !important;
            gap: 16px;
            overflow-x: auto !important;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            padding: 8px 4px 14px 4px;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            width: 100%;
        }
        .more-grid::-webkit-scrollbar {
            display: none;
        }
        .more-card {
            flex: 0 0 200px !important;
            min-width: 200px !important;
            max-width: 200px !important;
            scroll-snap-align: start;
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 16px;
            overflow: hidden;
            padding: 12px;
            text-align: left;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            transition: all 0.25s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }
        .more-card:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            transform: translateY(-2px);
            border-color: var(--primary);
        }
        @media (max-width: 640px) {
            .more-card {
                flex: 0 0 155px !important;
                min-width: 155px !important;
                max-width: 155px !important;
                padding: 10px;
            }
        }
        .more-card-img { width: 100%; aspect-ratio: 1/1; border-radius: 10px; object-fit: cover; background: #fbfbfd; }
        .more-card-title { font-size: 13px; font-weight: 600; color: #1d1d1f; margin: 8px 0 4px 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.35; }
        .more-card-stars { font-size: 12px; color: var(--star-color); margin-bottom: 4px; }
        .more-card-price { font-weight: 700; font-size: 14.5px; color: #1d1d1f; margin-top: auto; letter-spacing: -0.01em; }

        .more-products-dots {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 14px;
            width: 100%;
        }
        .more-prod-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #d2d2d7;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.2, 0.8, 0.2, 1);
        }
        .more-prod-dot.active {
            background: #59595e;
            width: 22px;
            border-radius: 999px;
        }

        /* ─── 7. FOOTER MODERNO (ESTILO SHEGLAM / AMAZON) ─── */
        .generic-footer {
            background: #000000;
            color: #ffffff;
            padding: 40px 20px 34px 20px;
            margin-top: 45px;
            width: 100%;
            box-sizing: border-box;
            overflow-x: hidden;
        }
        .footer-content-wrap {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 22px;
            position: relative;
        }
        /* ─── BARRA DE 3 PILARES DE CONFIANZA EN EL FOOTER ─── */
        .footer-trust-benefits-bar {
            width: 100%;
            max-width: 860px;
            margin: 0 auto 10px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 58px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            box-sizing: border-box;
        }
        .trust-benefit-col {
            display: flex;
            align-items: center;
            gap: 12px;
            text-align: left;
            flex: 0 1 auto;
        }
        .trust-benefit-icon {
            width: 33px;
            height: 33px;
            object-fit: contain;
            flex-shrink: 0;
            display: block;
        }
        .trust-benefit-text {
            font-size: 14px;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.22;
            letter-spacing: -0.01em;
            font-family: var(--font-heading);
            white-space: nowrap;
        }

        /* ─── RESPONSIVE MÓVIL (MANTIENE 100% ORDEN HORIZONTAL Y EQUIDISTANTE) ─── */
        @media (max-width: 768px) {
            .footer-trust-benefits-bar {
                gap: 26px;
                padding-bottom: 18px;
            }
            .trust-benefit-col {
                gap: 8px;
            }
            .trust-benefit-icon {
                width: 26px;
                height: 26px;
            }
            .trust-benefit-text {
                font-size: 11.5px;
                line-height: 1.18;
            }
        }

        @media (max-width: 480px) {
            .footer-trust-benefits-bar {
                gap: 14px;
                padding-bottom: 15px;
            }
            .trust-benefit-col {
                gap: 6px;
            }
            .trust-benefit-icon {
                width: 22px;
                height: 22px;
            }
            .trust-benefit-text {
                font-size: 10px;
                line-height: 1.15;
                letter-spacing: -0.015em;
            }
        }
        .footer-payments-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            flex-wrap: wrap;
            margin-top: 4px;
        }
        .footer-payment-badge {
            width: 44px;
            height: 27px;
            background: #ffffff;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1px 2px;
            box-sizing: border-box;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s ease;
            overflow: hidden;
            flex-shrink: 0;
        }
        .footer-payment-badge:hover {
            transform: translateY(-2px) scale(1.06);
        }
        .footer-payment-badge img,
        .footer-payment-badge svg {
            max-width: 100%;
            max-height: 100%;
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }
        .footer-payment-badge.badge-amex img {
            transform: scale(1.25);
        }
        .footer-payment-badge.badge-visa img {
            transform: scale(1.05);
        }
        .footer-payment-badge.badge-master img {
            transform: scale(0.90);
        }
        .footer-payment-badge.badge-pse img {
            transform: scale(0.86);
        }
        .footer-payment-badge.badge-nequi img {
            transform: scale(0.86);
        }
        .footer-payment-badge.badge-contraentrega img {
            transform: scale(0.92);
        }
        .footer-legal-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 32px;
            flex-wrap: wrap;
            margin-top: 10px;
        }
        .footer-sic-badge,
        .footer-camara-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }
        .footer-sic-badge:hover,
        .footer-camara-badge:hover {
            transform: scale(1.04);
        }
        .footer-sic-badge img,
        .footer-camara-badge img {
            height: 42px;
            width: auto;
            max-width: 240px;
            object-fit: contain;
            display: block;
            filter: drop-shadow(0 2px 6px rgba(0,0,0,0.5));
        }
        .footer-bottom-row {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-top: 8px;
            padding: 0 44px;
            box-sizing: border-box;
        }
        .footer-copyright-text {
            font-size: 12px;
            color: #9ca3af;
            font-weight: 500;
            letter-spacing: 0.3px;
            text-align: center;
            line-height: 1.5;
        }
        .btn-scroll-top {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
            flex-shrink: 0;
        }
        .btn-scroll-top:hover {
            background: #ffffff;
            color: #000000;
            transform: translateY(-50%) scale(1.1);
        }
        @media (max-width: 640px) {
            .footer-legal-row {
                gap: 16px;
            }
            .footer-bottom-row {
                flex-direction: row;
                justify-content: center;
                padding-right: 44px;
                padding-left: 10px;
            }
            .btn-scroll-top {
                position: absolute;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
            }
            .btn-scroll-top:hover {
                transform: translateY(-50%) scale(1.1);
            }
        }

        .sticky-footer-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #ffffff;
            border-top: 1px solid var(--border-color);
            padding: 10px 16px 14px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 900;
            box-shadow: 0 -4px 15px rgba(0,0,0,0.06);
            max-width: 540px;
            margin: 0 auto;
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: transform;
        }
        .sticky-footer-bar.bar-hidden {
            transform: translateY(120%) !important;
        }
        .support-btn { width: 46px; height: 46px; border-radius: 10px; border: 1px solid var(--border-color); background: #ffffff; display: flex; align-items: center; justify-content: center; color: #111111; text-decoration: none; flex-shrink: 0; }
        .btn-add-to-cart { flex: 1; height: 48px; background-color: var(--btn-bg); color: #ffffff; border: none; border-radius: 12px; font-family: var(--font-heading); font-size: 14px; font-weight: 800; display: flex; align-items: center; justify-content: center; gap: 6px; cursor: pointer; letter-spacing: 0.5px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); }

        @media (min-width: 992px) {
            .product-grid-layout { display: grid; grid-template-columns: 1.1fr 1fr; gap: 48px; align-items: start; max-width: 100%; }
            .gallery-wrapper-desktop { flex-direction: column; max-width: 680px; }
            .desktop-action-row { display: flex; }
            .sticky-footer-bar { display: none !important; }
        }

        .lightbox-modal { position: fixed; inset: 0; background: rgba(0, 0, 0, 0.94); z-index: 99999; display: none; align-items: center; justify-content: center; flex-direction: column; backdrop-filter: blur(5px); }
        .lightbox-modal.open { display: flex; }
        .lightbox-close-btn { position: absolute; top: 20px; right: 24px; background: rgba(255, 255, 255, 0.15); border: none; color: #ffffff; width: 44px; height: 44px; border-radius: 50%; font-size: 24px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; z-index: 100; }
        .lightbox-main-view { max-width: 90vw; max-height: 78vh; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; }
        .lightbox-main-view img { max-width: 100%; max-height: 78vh; object-fit: contain; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.5); cursor: zoom-in; transition: transform 0.22s ease-out; }
        .lightbox-main-view img.zoomed { transform: scale(2.2); cursor: zoom-out; }
        
        .lightbox-nav-btn.prev { left: -70px; }
        .lightbox-nav-btn.next { right: -70px; }
        @media (max-width: 768px) { .lightbox-nav-btn.prev { left: 10px; } .lightbox-nav-btn.next { right: 10px; } }
        .lightbox-thumbs-row { display: flex; gap: 10px; margin-top: 20px; max-width: 90vw; overflow-x: auto; padding: 8px; }
        .lightbox-thumb { width: 54px; height: 54px; border-radius: 6px; overflow: hidden; border: 2px solid transparent; cursor: pointer; opacity: 0.6; transition: all 0.2s; }
        .lightbox-thumb.active { border-color: #ffffff; opacity: 1; transform: scale(1.1); }
        .lightbox-thumb img { width: 100%; height: 100%; object-fit: cover; }

        .cart-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 10000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.35s cubic-bezier(0.32, 0.72, 0, 1);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        .cart-overlay.open {
            opacity: 1;
            visibility: visible;
        }
        .cart-drawer {
            position: fixed;
            top: 0;
            right: -100%;
            bottom: 0;
            width: 100%;
            max-width: 430px;
            background: #ffffff;
            z-index: 10001;
            transition: right 0.38s cubic-bezier(0.32, 0.72, 0, 1);
            display: flex;
            flex-direction: column;
            box-shadow: -10px 0 35px rgba(0, 0, 0, 0.12);
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }
        .cart-overlay.open .cart-drawer {
            right: 0;
        }
        .cart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-light);
        }
        .cart-header h3 {
            font-family: var(--font-heading);
            font-size: 17px;
            font-weight: 700;
            color: #1d1d1f;
            margin: 0;
            letter-spacing: -0.015em;
        }
        .close-cart-btn {
            background: #f5f5f7;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            color: #86868b;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .close-cart-btn:hover {
            background: #e5e5ea;
            color: #1d1d1f;
        }
        .shipping-progress-wrap {
            background: rgba(0, 166, 80, 0.05);
            padding: 12px 24px;
            border-bottom: 1px solid rgba(0, 166, 80, 0.15);
        }
        .shipping-progress-text {
            font-size: 12.5px;
            font-weight: 700;
            color: #00a650;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .shipping-bar {
            height: 5px;
            background: #e5e5ea;
            border-radius: 980px;
            overflow: hidden;
        }
        .shipping-bar-fill {
            height: 100%;
            background: #00a650;
            width: 100%;
            border-radius: 980px;
        }
        .cart-items-list {
            flex: 1;
            overflow-y: auto;
            padding: 18px 24px;
        }
        .cart-item {
            display: flex;
            gap: 14px;
            padding-bottom: 18px;
            border-bottom: 1px solid #f2f2f7;
            margin-bottom: 18px;
        }
        .cart-item-img {
            width: 72px;
            height: 72px;
            border-radius: 12px;
            object-fit: cover;
            background: #fbfbfd;
            flex-shrink: 0;
            border: 1px solid var(--border-light);
        }
        .cart-item-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .cart-item-title {
            font-size: 13.5px;
            font-weight: 600;
            color: #1d1d1f;
            line-height: 1.35;
            letter-spacing: -0.01em;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .cart-item-variant {
            font-size: 12px;
            color: #86868b;
            margin-top: 3px;
        }
        .cart-item-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 8px;
        }
        .cart-item-price {
            font-weight: 700;
            font-size: 14.5px;
            color: #1d1d1f;
            letter-spacing: -0.01em;
        }
        .qty-controls {
            display: flex;
            align-items: center;
            border: 1px solid var(--border-color);
            border-radius: 980px;
            overflow: hidden;
            background: #f5f5f7;
        }
        .qty-btn {
            background: transparent;
            border: none;
            width: 26px;
            height: 26px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1d1d1f;
            transition: background 0.15s;
        }
        .qty-btn:hover {
            background: #e5e5ea;
        }
        .qty-value {
            width: 26px;
            text-align: center;
            font-size: 12px;
            font-weight: 700;
            color: #1d1d1f;
        }
        .cart-footer {
            padding: 20px 24px;
            background: #ffffff;
            border-top: 1px solid var(--border-light);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.04);
        }
        .cart-summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 13.5px;
            color: #6e6e73;
            margin-bottom: 8px;
        }
        .cart-summary-row.total {
            font-family: var(--font-heading);
            font-size: 17px;
            font-weight: 700;
            color: #1d1d1f;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid var(--border-light);
            letter-spacing: -0.015em;
        }
        .btn-checkout {
            width: 100%;
            height: 50px;
            background-color: var(--btn-bg, #0071e3);
            color: #ffffff;
            border: none;
            border-radius: 980px;
            font-family: var(--font-heading);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 14px rgba(0, 113, 227, 0.28);
            letter-spacing: -0.01em;
        }
        .btn-checkout:hover {
            background-color: var(--primary-hover, #0077ed);
            transform: scale(1.015);
            box-shadow: 0 6px 20px rgba(0, 113, 227, 0.38);
        }

        .editor-top-toolbar { position: fixed; top: 0; left: 0; right: 0; background: #0f172a; color: #ffffff; padding: 10px 20px; display: flex; align-items: center; justify-content: space-between; z-index: 999999; box-shadow: 0 4px 20px rgba(0,0,0,0.4); font-family: 'Inter', sans-serif; font-size: 13px; }
        .editor-badge { background: #22c55e; color: #000; font-weight: 800; font-size: 11px; padding: 4px 10px; border-radius: 20px; text-transform: uppercase; }
        .editor-actions { display: flex; gap: 10px; align-items: center; }
        .btn-editor-save { background: #3b82f6; color: #ffffff; border: none; padding: 8px 18px; border-radius: 8px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 6px; }
        .btn-editor-preview { background: rgba(255,255,255,0.15); color: #ffffff; border: 1px solid rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 8px; font-weight: 600; text-decoration: none; }

        body.modo-edicion-activo [data-editable="true"]:hover { outline: 2px dashed #3b82f6 !important; cursor: text; background: rgba(59, 130, 246, 0.05); }
        body.modo-edicion-activo [data-editable="true"]:focus { outline: 2px solid #22c55e !important; background: rgba(34, 197, 94, 0.08); }

        #landing-loader { display: none; position: fixed; inset: 0; background: rgba(255, 255, 255, 0.95); z-index: 99999; flex-direction: column; justify-content: center; align-items: center; }
        .spinner { width: 44px; height: 44px; border: 3px solid #f3f4f6; border-top-color: var(--primary); border-radius: 50%; animation: spin 0.8s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    
        

    
        
        /* ─── ANIMACIONES PROFESIONALES DEL CARRITO Y LOTTIE ─── */
        .cart-trigger {
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            color: #111827;
            padding: 6px;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .cart-pop-active {
            animation: cartPopBounce 0.45s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
        }
        @keyframes cartPopBounce {
            0% { transform: scale(1); }
            35% { transform: scale(1.4); }
            70% { transform: scale(0.92); }
            100% { transform: scale(1); }
        }
        .cart-ripple-effect {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 46px;
            height: 46px;
            margin-left: -23px;
            margin-top: -23px;
            border-radius: 50%;
            border: 2.5px solid var(--primary, #111111);
            pointer-events: none;
            animation: cartRippleAnim 0.65s cubic-bezier(0.1, 0.8, 0.3, 1) forwards;
        }
        @keyframes cartRippleAnim {
            0% { transform: scale(0.4); opacity: 0.95; }
            100% { transform: scale(1.85); opacity: 0; }
        }
        .cart-badge-bounce {
            animation: cartBadgeBounce 0.45s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes cartBadgeBounce {
            0% { transform: scale(1); }
            45% { transform: scale(1.5); }
            100% { transform: scale(1); }
        }

        /* ─── 5.2 REVIEWS WITH VIDEOS CAROUSEL (AMAZON STYLE) ─── */
        .video-reviews-section {
            max-width: 1200px;
            margin: 28px auto 14px auto;
            padding: 0 16px;
            box-sizing: border-box;
        }
        .video-reviews-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 14px;
            gap: 12px;
            flex-wrap: wrap;
        }
        .video-reviews-title-wrap {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        .video-reviews-main-title {
            font-family: var(--font-heading, 'Montserrat', sans-serif);
            font-size: 20px;
            font-weight: 800;
            color: #111827;
            margin: 0;
            letter-spacing: -0.3px;
        }
        .video-reviews-subtitle {
            font-size: 13px;
            color: var(--text-muted, #6b7280);
            font-weight: 500;
        }
        .video-reviews-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-add-video-card {
            background: #22c55e;
            color: #ffffff;
            border: none;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(34, 197, 94, 0.35);
            transition: transform 0.2s ease, background 0.2s ease;
        }
        .btn-add-video-card:hover {
            background: #16a34a;
            transform: scale(1.03);
        }
        .video-carousel-arrows {
            display: flex;
            gap: 6px;
        }
        .video-arrow-btn {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            color: #1f2937;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
            transition: all 0.2s ease;
        }
        .video-arrow-btn:hover {
            background: #111827;
            color: #ffffff;
            border-color: #111827;
        }

        .video-reviews-carousel-track {
            display: flex;
            gap: 14px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding: 8px 4px 18px 4px;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }
        .video-reviews-carousel-track::-webkit-scrollbar {
            height: 6px;
        }
        .video-reviews-carousel-track::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 6px;
        }

        .video-review-card {
            flex: 0 0 160px;
            height: 250px;
            border-radius: 14px;
            position: relative;
            overflow: hidden;
            background: #000000;
            cursor: pointer;
            scroll-snap-align: start;
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
            transition: transform 0.25s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.25s ease;
            user-select: none;
        }
        @media (max-width: 640px) {
            .video-review-card {
                flex: 0 0 140px;
                height: 220px;
                border-radius: 12px;
            }
        }
        .video-review-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 10px 22px rgba(0,0,0,0.25);
        }
        .video-card-thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
            background: #1e293b;
        }
        .video-review-card:hover .video-card-thumb {
            transform: scale(1.06);
        }
        .video-card-gradient {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.92) 0%, rgba(0,0,0,0.5) 45%, rgba(0,0,0,0.05) 80%, transparent 100%);
            pointer-events: none;
        }
        .video-card-badge-play {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0,0,0,0.65);
            backdrop-filter: blur(4px);
            color: #ffffff;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            padding-left: 2px;
            border: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            transition: all 0.2s ease;
            z-index: 2;
        }
        .video-review-card:hover .video-card-badge-play {
            background: #e11d48;
            border-color: #e11d48;
            transform: scale(1.15);
        }
        .video-card-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 12px 10px;
            color: #ffffff;
            z-index: 2;
            pointer-events: none;
        }
        .video-card-stars {
            color: #f97316;
            font-size: 13px;
            letter-spacing: 1.5px;
            margin-bottom: 3px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.8);
        }
        .video-card-duration {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 800;
            font-family: var(--font-heading, sans-serif);
            color: #ffffff;
            text-shadow: 0 1px 4px rgba(0,0,0,0.9);
        }
        .play-icon-mini {
            font-size: 10px;
            opacity: 0.9;
        }
        .video-card-title-text {
            font-size: 11px;
            font-weight: 600;
            color: #e2e8f0;
            margin-top: 3px;
            line-height: 1.25;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-shadow: 0 1px 3px rgba(0,0,0,0.9);
        }

        .video-card-admin-bar {
            position: absolute;
            top: 8px;
            left: 8px;
            display: flex;
            gap: 4px;
            z-index: 15;
        }
        .btn-vcard-edit {
            background: #3b82f6;
            color: #ffffff;
            border: none;
            font-size: 10px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }
        .btn-vcard-del {
            background: #ef4444;
            color: #ffffff;
            border: none;
            font-size: 10px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }

        /* ─── VIDEO LIGHTBOX MODAL ─── */
        .video-modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.88);
            backdrop-filter: blur(8px);
            z-index: 9999999;
            justify-content: center;
            align-items: center;
            padding: 16px;
            box-sizing: border-box;
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        .video-modal-backdrop.active {
            display: flex;
            opacity: 1;
        }
        .video-modal-container {
            position: relative;
            width: 100%;
            max-width: 820px;
            background: #000000;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.15);
            transform: scale(0.94);
            transition: transform 0.25s cubic-bezier(0.2, 0.8, 0.2, 1);
        }
        .video-modal-backdrop.active .video-modal-container {
            transform: scale(1);
        }
        .video-modal-close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 20;
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.35);
            color: #ffffff;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .video-modal-close-btn:hover {
            background: #ef4444;
            border-color: #ef4444;
            transform: scale(1.1);
        }
        .video-modal-iframe-wrapper {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            background: #000000;
        }
        .video-modal-iframe-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
</head>
<body class="<?= $es_modo_edicion ? 'modo-edicion-activo' : '' ?>" style="<?= $es_modo_edicion ? 'margin-top: 50px;' : '' ?>">

    <?php if ($es_modo_edicion): ?>
    <div class="editor-top-toolbar" id="editorToolbar">
        <div style="display:flex; align-items:center; gap:12px;">
            <span class="editor-badge">🎨 Modo Edición Activo</span>
            <span style="color:#94a3b8; font-size:12px;">💡 Haz <b>doble clic</b> en cualquier texto para modificarlo en vivo.</span>
        </div>
        <div class="editor-actions">
            <button class="btn-editor-save" onclick="guardarCambiosVisuales()">💾 Guardar Cambios</button>
            <a href="?" class="btn-editor-preview">👁️ Ver como Cliente</a>
        </div>
    </div>
    <?php endif; ?>

    <div id="landing-loader">
        <div class="spinner"></div>
        <p style="margin-top: 14px; font-family: var(--font-heading); font-weight: 700; font-size: 14px;">Preparando tu pedido seguro...</p>
    </div>

    <!-- 1. TOP ANNOUNCEMENT BAR ESTÁTICO -->
    <div class="top-announcement">
        <span data-editable="true">ENVIOS A TODO COLOMBIA</span>
    </div>

    <nav class="navbar">
        <div class="nav-left" style="width: 44px;"></div>

        <div class="nav-center-logo">
            <?php if (file_exists(__DIR__ . '/logo.svg')): ?>
                <img src="logo.svg" class="brand-logo-img" alt="<?= htmlspecialchars("DJI") ?>">
            <?php elseif (file_exists(__DIR__ . '/logo.webp')): ?>
                <img src="logo.webp" class="brand-logo-img" alt="<?= htmlspecialchars("DJI") ?>">
            <?php else: ?>
                <span class="brand-logo-text" data-editable="true"><?= htmlspecialchars("DJI") ?></span>
            <?php endif; ?>
        </div>

        <div class="nav-right">
            <button class="cart-trigger" onclick="toggleCart()" title="Ver Carrito">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span class="cart-badge-count" id="cartBadge" style="display:none;">0</span>
            </button>
        </div>
    </nav>

    <!-- 4. CONTENIDO PRINCIPAL -->
    <main class="landing-container">
        <div class="product-grid-layout">

            <!-- COLUMNA 1: GALERÍA CON SLIDE Y PUNTICOS INDICADORES -->
            <section class="gallery-wrapper-desktop">
                <div class="gallery-slider-container">
                    <div class="main-image-wrap" id="mainGallerySlider" onclick="abrirLightbox(activeImgIndex)" title="Haz clic para ampliar">
                        <img id="mainImage" src="https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%201.webp" alt="<?= htmlspecialchars("DJI Osmo Pocket 3 Creator Combo | Cámara Gimbal 4K 120fps Sensor 1\"") ?>">
                    </div>
                    <!-- PUNTICOS INDICADORES DE LA GALERÍA -->
                    <div class="gallery-dots-indicator" id="galleryDotsIndicator"></div>
                </div>
            </section>

            <!-- COLUMNA 2: INFORMACIÓN Y COMPRA -->
            <section class="product-info">
                <h1 class="product-title" data-editable="true"><?= htmlspecialchars("DJI Osmo Pocket 3 Creator Combo | Cámara Gimbal 4K 120fps Sensor 1\"") ?></h1>

                <div class="rating-row">
                    <div class="stars-container">★★★★★</div>
                    <span class="reviews-count" data-editable="true">(48)</span>
                </div>

                <div class="price-row">
                    <span class="current-price" data-editable="true">$ 1.850.000</span>
                    <span class="old-price" data-editable="true">$ 2.450.000</span>
                    <span class="discount-pill" data-editable="true">-24% OFF</span>
                </div>

                <!-- CAJA DE ENVÍO URGENTE Y CONTADOR PERSISTENTE -->
                <div class="apple-shipping-urgency-box">
                    <div class="shipping-lead-row">
                        <svg class="shipping-flash-icon" viewBox="0 0 24 24" width="20" height="20" fill="#00a650" stroke="#00a650" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg>
                        <div class="shipping-lead-text">
                            <span class="shipping-badge-highlight" data-editable="true">Llega gratis <b>mañana</b></span>
                            <div class="shipping-timer-subtext">
                                <span data-editable="true">Comprando dentro de las próximas</span> <span class="shipping-countdown-val" id="shippingCountdown">20 h 40 min 00 s</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="variant-block">
                    <div class="variant-header">
                        <div class="variant-label">Color / Variante: <span id="colorNameDisplay" data-editable="true"><?= htmlspecialchars("Creator Combo") ?></span></div>
                    </div>
                    <div class="swatches-row" id="swatchesContainer"></div>
                </div>

                <div class="size-block">
                    <div class="variant-header"><div class="variant-label">Presentación:</div></div>
                    <div class="size-pills-row">
                        <button class="size-pill" data-editable="true"><?= htmlspecialchars("Kit Completo 6 en 1") ?></button>
                    </div>
                </div>

                <div class="desktop-action-row">
                    <div class="qty-controls-desktop">
                        <button class="qty-btn-desktop" onclick="cambiarCantidad(-1)">-</button>
                        <span class="qty-val-desktop" id="qtyDesktopDisplay">1</span>
                        <button class="qty-btn-desktop" onclick="cambiarCantidad(1)">+</button>
                    </div>
                    <button class="btn-add-desktop" onclick="agregarAlCarrito(event)" data-editable="true">
                        Add to Cart - $ 1.850.000
                    </button>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span data-editable="true">Descripción y Beneficios</span>
                        <span>▾</span>
                    </button>
                    <div class="accordion-body open">
                        <p data-editable="true">Cámara de bolsillo profesional con sensor CMOS de 1 pulgada, grabación en 4K/120fps, estabilización mecánica en 3 ejes, pantalla táctil OLED giratoria de 2 pulgadas, enfoque rápido en todos los píxeles y compatibilidad con micrófono inalámbrico DJI Mic 2.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" onclick="toggleAccordion(this)">
                        <span data-editable="true">Garantía y Devoluciones</span>
                        <span>▾</span>
                    </button>
                    <div class="accordion-body">
                        <p data-editable="true">Todos nuestros productos cuentan con garantía de 30 días contra defectos de fábrica. Si no estás 100% satisfecho(a), te devolvemos tu dinero.</p>
                    </div>
                </div>

                <!-- SECURE PAYMENT -->
                <div class="secure-trust-box">
                    <div class="secure-trust-header">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                        <span data-editable="true">Secure Payment</span>
                    </div>
                    <ul class="secure-trust-list">
                        <li><span class="check-icon">✓</span> <span data-editable="true"><b>Pago Contra Entrega disponible:</b> Paga en efectivo cuando recibas tu pedido en la puerta de tu casa.</span></li>
                        <li><span class="check-icon">✓</span> <span data-editable="true">Tus datos y compras están protegidos con cifrado de seguridad.</span></li>
                        <li><span class="check-icon">✓</span> <span data-editable="true"><?= htmlspecialchars("DJI") ?> comparte información de pago únicamente con proveedores de pago confiables comprometidos con proteger tus datos.</span></li>
                    </ul>
                </div>
            </section>

        </div>
    </main>

    <!-- 5.2 REVIEWS WITH VIDEOS CAROUSEL (AMAZON STYLE) -->
    <section class="video-reviews-section" id="videoReviewsSection">
        <div class="video-reviews-header">
            <div class="video-reviews-title-wrap">
                <h2 class="video-reviews-main-title" data-editable="true">Reviews with videos</h2>
                <span class="video-reviews-subtitle" data-editable="true">Opiniones y unboxings en video de clientes verificados</span>
            </div>
            <div class="video-reviews-controls">
                <?php if ($es_modo_edicion): ?>
                    <button type="button" class="btn-add-video-card" onclick="agregarNuevoVideoReview()">➕ Agregar Video</button>
                <?php endif; ?>
            </div>
        </div>

        <div class="video-reviews-carousel-track" id="videoReviewsTrack">
            <!-- Video Card 1 -->
            <div class="video-review-card" data-youtube-id="xrtdYHHRNrA" data-video-title="DJI Osmo Pocket 3 Review & Setup" onclick="manejarClickVideoCard(this, event)">
                <img class="video-card-thumb" src="https://i.ytimg.com/vi/xrtdYHHRNrA/hqdefault.jpg" referrerpolicy="no-referrer" alt="DJI Osmo Pocket 3 Review" loading="lazy">
                <div class="video-card-gradient"></div>
                <div class="video-card-badge-play">▶</div>
                <div class="video-card-info">
                    <div class="video-card-stars">★★★★★</div>
                    <div class="video-card-duration">
                        <span class="play-icon-mini">▶</span> <span class="video-duration-text" data-editable="true">2:45</span>
                    </div>
                    <div class="video-card-title-text" data-editable="true">Ultimate Pocket Vlog Setup</div>
                </div>
                <?php if ($es_modo_edicion): ?>
                <div class="video-card-admin-bar" onclick="event.stopPropagation()">
                    <button type="button" class="btn-vcard-edit" onclick="editarVideoCard(this.closest('.video-review-card'))" title="Editar link de YouTube">✏️ Editar</button>
                    <button type="button" class="btn-vcard-del" onclick="eliminarVideoCard(this.closest('.video-review-card'))" title="Eliminar video">🗑️</button>
                </div>
                <?php endif; ?>
            </div>

            <!-- Video Card 2 -->
            <div class="video-review-card" data-youtube-id="889E7RRXN2Q" data-video-title="DJI Osmo Pocket 3 Creator Combo" onclick="manejarClickVideoCard(this, event)">
                <img class="video-card-thumb" src="https://i.ytimg.com/vi/889E7RRXN2Q/hqdefault.jpg" referrerpolicy="no-referrer" alt="DJI Osmo Pocket 3 Creator Combo" loading="lazy">
                <div class="video-card-gradient"></div>
                <div class="video-card-badge-play">▶</div>
                <div class="video-card-info">
                    <div class="video-card-stars">★★★★★</div>
                    <div class="video-card-duration">
                        <span class="play-icon-mini">▶</span> <span class="video-duration-text" data-editable="true">1:57</span>
                    </div>
                    <div class="video-card-title-text" data-editable="true">Estabilización y Sensor 1"</div>
                </div>
                <?php if ($es_modo_edicion): ?>
                <div class="video-card-admin-bar" onclick="event.stopPropagation()">
                    <button type="button" class="btn-vcard-edit" onclick="editarVideoCard(this.closest('.video-review-card'))" title="Editar link de YouTube">✏️ Editar</button>
                    <button type="button" class="btn-vcard-del" onclick="eliminarVideoCard(this.closest('.video-review-card'))" title="Eliminar video">🗑️</button>
                </div>
                <?php endif; ?>
            </div>

            <!-- Video Card 3 -->
            <div class="video-review-card" data-youtube-id="O5Z0ilq_Qqw" data-video-title="DJI Pocket 3: Unboxing y Calidad 4K" onclick="manejarClickVideoCard(this, event)">
                <img class="video-card-thumb" src="https://i.ytimg.com/vi/O5Z0ilq_Qqw/hqdefault.jpg" referrerpolicy="no-referrer" alt="DJI Pocket 3 4K" loading="lazy">
                <div class="video-card-gradient"></div>
                <div class="video-card-badge-play">▶</div>
                <div class="video-card-info">
                    <div class="video-card-stars">★★★★★</div>
                    <div class="video-card-duration">
                        <span class="play-icon-mini">▶</span> <span class="video-duration-text" data-editable="true">1:32</span>
                    </div>
                    <div class="video-card-title-text" data-editable="true">Calidad 4K/120fps & D-Log M</div>
                </div>
                <?php if ($es_modo_edicion): ?>
                <div class="video-card-admin-bar" onclick="event.stopPropagation()">
                    <button type="button" class="btn-vcard-edit" onclick="editarVideoCard(this.closest('.video-review-card'))" title="Editar link de YouTube">✏️ Editar</button>
                    <button type="button" class="btn-vcard-del" onclick="eliminarVideoCard(this.closest('.video-review-card'))" title="Eliminar video">🗑️</button>
                </div>
                <?php endif; ?>
            </div>

            <!-- Video Card 4 -->
            <div class="video-review-card" data-youtube-id="xqv8b84g9iM" data-video-title="DJI Osmo Pocket 3 en la Vida Real" onclick="manejarClickVideoCard(this, event)">
                <img class="video-card-thumb" src="https://i.ytimg.com/vi/xqv8b84g9iM/hqdefault.jpg" referrerpolicy="no-referrer" alt="DJI Osmo Pocket 3 Test" loading="lazy">
                <div class="video-card-gradient"></div>
                <div class="video-card-badge-play">▶</div>
                <div class="video-card-info">
                    <div class="video-card-stars">★★★★★</div>
                    <div class="video-card-duration">
                        <span class="play-icon-mini">▶</span> <span class="video-duration-text" data-editable="true">1:15</span>
                    </div>
                    <div class="video-card-title-text" data-editable="true">Prueba en la Vida Real</div>
                </div>
                <?php if ($es_modo_edicion): ?>
                <div class="video-card-admin-bar" onclick="event.stopPropagation()">
                    <button type="button" class="btn-vcard-edit" onclick="editarVideoCard(this.closest('.video-review-card'))" title="Editar link de YouTube">✏️ Editar</button>
                    <button type="button" class="btn-vcard-del" onclick="eliminarVideoCard(this.closest('.video-review-card'))" title="Eliminar video">🗑️</button>
                </div>
                <?php endif; ?>
            </div>

            <!-- Video Card 5 -->
            <div class="video-review-card" data-youtube-id="vYZBr_K38W8" data-video-title="DJI Osmo Pocket 3 y Micrófono DJI Mic 2" onclick="manejarClickVideoCard(this, event)">
                <img class="video-card-thumb" src="https://i.ytimg.com/vi/vYZBr_K38W8/hqdefault.jpg" referrerpolicy="no-referrer" alt="DJI Pocket 3 Audio Test" loading="lazy">
                <div class="video-card-gradient"></div>
                <div class="video-card-badge-play">▶</div>
                <div class="video-card-info">
                    <div class="video-card-stars">★★★★★</div>
                    <div class="video-card-duration">
                        <span class="play-icon-mini">▶</span> <span class="video-duration-text" data-editable="true">2:10</span>
                    </div>
                    <div class="video-card-title-text" data-editable="true">Enfoque Rápido & Mic 2</div>
                </div>
                <?php if ($es_modo_edicion): ?>
                <div class="video-card-admin-bar" onclick="event.stopPropagation()">
                    <button type="button" class="btn-vcard-edit" onclick="editarVideoCard(this.closest('.video-review-card'))" title="Editar link de YouTube">✏️ Editar</button>
                    <button type="button" class="btn-vcard-del" onclick="eliminarVideoCard(this.closest('.video-review-card'))" title="Eliminar video">🗑️</button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- VIDEO MODAL LIGHTBOX -->
    <div id="videoModalLightbox" class="video-modal-backdrop" onclick="cerrarVideoModal(event)">
        <div class="video-modal-container" onclick="event.stopPropagation()">
            <button type="button" class="video-modal-close-btn" onclick="cerrarVideoModal(event)" aria-label="Cerrar video">✕</button>
            <div class="video-modal-iframe-wrapper">
                <iframe id="videoModalIframe" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <!-- 5.5 CUSTOMER REVIEWS SECTION -->
    <section class="customer-reviews-section" id="customerReviewsSection">
        <div class="reviews-header-block">
            <h2 class="reviews-main-title" data-editable="true">Customer Reviews</h2>
            <div class="overall-rating-wrap">
                <span class="overall-rating-num" data-editable="true">5.0</span>
                <span class="overall-stars-gold">★★★★★</span>
            </div>
        </div>

        <div class="reviews-filters-row">
            <div class="filters-left-group">
                <div class="review-filter-pill">
                    <span>Picture</span>
                    <select class="filter-select-box" id="filterPic" onchange="renderReviews()">
                        <option value="All">All</option>
                        <option value="With Pictures">With Pictures</option>
                    </select>
                </div>
                <div class="review-filter-pill">
                    <span>Color</span>
                    <select class="filter-select-box" id="filterColor" onchange="renderReviews()">
                        <option value="All">All</option>
                        <option value="<?= htmlspecialchars("Creator Combo") ?>"><?= htmlspecialchars("Creator Combo") ?></option>
                    </select>
                </div>
                <div class="review-filter-pill">
                    <span>Rating</span>
                    <select class="filter-select-box" id="filterRating" onchange="renderReviews()">
                        <option value="All">All</option>
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                    </select>
                </div>
            </div>

            <div class="filters-right-group">
                <div class="review-filter-pill">
                    <span>Sort By</span>
                    <select class="filter-select-box" id="filterSort" onchange="renderReviews()">
                        <option value="Default">Default</option>
                        <option value="Most Recent">Most Recent</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="reviews-list-wrap" id="reviewsListContainer"></div>

        <div class="reviews-pagination-row" id="reviewsPaginationContainer"></div>
    </section>

    <!-- 5. BANNER OFICIAL ESTILO MERCADOLIBRE (ANTES DE PRODUCTOS RECOMENDADOS) -->
    <div class="ml-promo-banner-wrap" onclick="window.location.href='<?= URL_PASARELA_MERCADOLIBRE ?>/pago/mercadolibre_clone/index.php?token=<?= $landing_token ?>'">
        <div class="ml-banner-inner">
            <div class="ml-banner-left">
                <?php if (file_exists(__DIR__ . '/mercadito.webp')): ?>
                    <img src="mercadito.webp" alt="Mercado Libre" class="ml-logo-img">
                <?php elseif (file_exists(__DIR__ . '/../../mercadito.webp')): ?>
                    <img src="../../mercadito.webp" alt="Mercado Libre" class="ml-logo-img">
                <?php else: ?>
                    <img src="/mercadito.webp" alt="Mercado Libre" class="ml-logo-img">
                <?php endif; ?>
            </div>

            <div class="ml-banner-divider"></div>

            <div class="ml-banner-center">
                <span class="ml-brand-name"><?= htmlspecialchars("DJI") ?></span>
                <span class="ml-product-name"><?= htmlspecialchars("DJI Osmo Pocket 3 Creator Combo | Cámara Gimbal 4K 120fps Sensor 1\"") ?></span>
                <div class="ml-stripes"><span>/</span><span>/</span><span>/</span></div>
            </div>

            <div class="ml-banner-right">
                <div class="ml-free-shipping-pill">
                    <span class="pill-dark">🚚 ENVÍO GRATIS</span>
                    <span class="pill-white">EN TU PRIMERA COMPRA</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 6. SECCIÓN QUIENES VIERON ESTE PRODUCTO TAMBIÉN COMPRARON -->
    <section class="more-to-love-section" id="recommendedProductsSection">
        <h2 class="section-heading-center" data-editable="true">Quienes vieron este producto también compraron</h2>

        <div class="more-slider-wrapper">
            <div class="more-grid" id="recommendedProductsTrack">
                <?php if (!empty($otros_productos)): ?>
                    <?php foreach ($otros_productos as $o): ?>
                    <a href="<?= htmlspecialchars($o['url']) ?>" class="more-card">
                        <img src="<?= htmlspecialchars($o['img']) ?>" class="more-card-img" alt="<?= htmlspecialchars($o['nombre']) ?>">
                        <div class="more-card-title"><?= htmlspecialchars($o['nombre']) ?></div>
                        <div class="more-card-stars">★★★★★</div>
                        <div class="more-card-price"><?= htmlspecialchars($o['precio'] ?? 'Ver Oferta ➔') ?></div>
                    </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- PUNTICOS INDICADORES DEL CARRUSEL DE PRODUCTOS -->
        <div class="more-products-dots" id="recommendedProductsDots"></div>
    </section>

    <!-- 7. FOOTER MODERNO ESTILO SHEGLAM -->
    <footer class="generic-footer">
        <div class="footer-content-wrap">
            <!-- BENEFICIOS / TRUST BAR: 1. PAGA EN LÍNEA, 2. COMPRAS SEGURAS, 3. ACUMULAS PUNTOS COLOMBIA -->
            <div class="footer-trust-benefits-bar">
                <div class="trust-benefit-col">
                    <img src="tarjeta.svg" alt="Paga en línea o en efectivo" class="trust-benefit-icon">
                    <span class="trust-benefit-text" data-editable="true">Paga en línea<br>o en efectivo</span>
                </div>
                <div class="trust-benefit-col">
                    <img src="escudo_candado.svg" alt="Compras seguras" class="trust-benefit-icon">
                    <span class="trust-benefit-text" data-editable="true">Compras<br>seguras</span>
                </div>
                <div class="trust-benefit-col">
                    <img src="puntos_colombia.svg" alt="Acumulas Puntos Colombia" class="trust-benefit-icon">
                    <span class="trust-benefit-text" data-editable="true">Acumulas<br>Puntos Colombia</span>
                </div>
            </div>

            <!-- MEDIOS DE PAGO (AMEX, VISA, MASTE, PSE, NEQUI, MERCADITO, CONTRAENTREGA) CON FONDO BLANCO -->
            <div class="footer-payments-row">
                <!-- AMERICAN EXPRESS -->
                <div class="footer-payment-badge badge-amex" title="American Express">
                    <img src="amex.svg" alt="American Express">
                </div>
                <!-- VISA -->
                <div class="footer-payment-badge badge-visa" title="Visa">
                    <img src="visa.svg" alt="Visa">
                </div>
                <!-- MASTERCARD -->
                <div class="footer-payment-badge badge-master" title="Mastercard">
                    <img src="maste.svg" alt="Mastercard">
                </div>
                <!-- PSE -->
                <div class="footer-payment-badge badge-pse" title="PSE">
                    <img src="pse.png" alt="PSE">
                </div>
                <!-- NEQUI -->
                <div class="footer-payment-badge badge-nequi" title="Nequi">
                    <img src="Nequi_Colombia_logo.svg.webp" alt="Nequi">
                </div>
                <!-- CONTRAENTREGA -->
                <div class="footer-payment-badge badge-contraentrega" title="Pago Contraentrega">
                    <img src="contraentrega.png" alt="Pago Contraentrega">
                </div>
            </div>

            <!-- SUPERINTENDENCIA (BLANCO) & CÁMARA DE COMERCIO -->
            <div class="footer-legal-row">
                <?php if (file_exists(__DIR__ . '/sic_blanco.png')): ?>
                    <div class="footer-sic-badge" title="Superintendencia de Industria y Comercio">
                        <img src="sic_blanco.png" alt="Superintendencia de Industria y Comercio">
                    </div>
                <?php elseif (file_exists(__DIR__ . '/sic.png')): ?>
                    <div class="footer-sic-badge" title="Superintendencia de Industria y Comercio">
                        <img src="sic.png" alt="Superintendencia de Industria y Comercio">
                    </div>
                <?php else: ?>
                    <span class="footer-legal-text" data-editable="true">Superintendencia de Industria y Comercio</span>
                <?php endif; ?>

                <?php if (file_exists(__DIR__ . '/comerciocamara.png')): ?>
                    <div class="footer-camara-badge" title="Cámara Colombiana de Comercio Electrónico">
                        <img src="comerciocamara.png" alt="Cámara Colombiana de Comercio Electrónico">
                    </div>
                <?php else: ?>
                    <span class="footer-legal-text" data-editable="true">Cámara Colombiana de Comercio Electrónico</span>
                <?php endif; ?>
            </div>

            <!-- COPYRIGHT & DATOS LEGALES -->
            <div class="footer-bottom-row">
                <div class="footer-copyright-text">
                    © <?= date('Y') ?> TODOS LOS DERECHOS RESERVADOS<br>
                    <span data-editable="true"><?= htmlspecialchars($nombre_marca ?? "DJI") ?> Store Colombia S.A.S. NIT 901.834.729-3. Avenida El Dorado (Calle 26) N.º 62 - 47, Bogotá, Colombia</span>
                </div>
                <button type="button" class="btn-scroll-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" title="Volver arriba" aria-label="Volver arriba">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="18 15 12 9 6 15"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    </footer>

    <!-- 8. STICKY BOTTOM ACTION BAR (MOBILE ONLY) -->
    <div class="sticky-footer-bar">
        

        

        <button class="btn-add-to-cart" id="btnAddToCart" onclick="agregarAlCarrito(event)" data-editable="true">
            Add to Cart - $ 1.850.000
        </button>
    </div>

    <!-- 9. LIGHTBOX / ZOOM FLOTANTE -->
    <div class="lightbox-modal" id="imageLightbox" onclick="if(event.target===this) cerrarLightbox()">
        <button class="lightbox-close-btn" onclick="cerrarLightbox()" title="Cerrar (Esc)">✕</button>
        <div class="lightbox-main-view">
            <button class="lightbox-nav-btn prev" onclick="cambiarImagenLightbox(-1)">❮</button>
            <img id="lightboxImage" src="" alt="Vista ampliada" onclick="toggleLightboxZoom(event)" onmousemove="actualizarPosicionZoom(event, this)" title="Haz clic para activar/desactivar zoom">
            <button class="lightbox-nav-btn next" onclick="cambiarImagenLightbox(1)">❯</button>
        </div>
        <div class="lightbox-thumbs-row" id="lightboxThumbs"></div>
    </div>

    <!-- 10. SHOPPING CART DRAWER -->
    <div class="cart-overlay" id="cartOverlay" onclick="if(event.target===this) toggleCart()">
        <div class="cart-drawer">
            <div class="cart-header">
                <h3 id="cartDrawerTitle">Tu Carrito (0)</h3>
                <button class="close-cart-btn" onclick="toggleCart()">✕</button>
            </div>
            <div class="shipping-progress-wrap">
                <div class="shipping-progress-text">
                    <span>✨</span>
                    <span>¡Felicidades! Tienes <b>Envío Gratis</b> incluido</span>
                </div>
                <div class="shipping-bar"><div class="shipping-bar-fill"></div></div>
            </div>
            <div class="cart-items-list" id="cartItemsContainer"></div>
            <div class="cart-footer">
                <div class="cart-summary-row"><span>Subtotal</span><span id="cartSubtotal">$ 1.850.000</span></div>
                <div class="cart-summary-row"><span>Envío</span><span style="color:#059669; font-weight:700;">GRATIS</span></div>
                <div class="cart-summary-row total"><span>Total</span><span id="cartTotal">$ 1.850.000</span></div>
                <button class="btn-checkout" onclick="procederAlCheckout()">
                    <span>Finalizar Compra Segura</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- 11. JAVASCRIPT ROBUSTO CON ZOOM Y PAGINACIÓN DE OPINIONES -->
    <script>
        <?php
        $supabaseImages = [
            "https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%201.webp",
            "https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%202.webp",
            "https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%203.webp",
            "https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%204.webp",
            "https://iwqhaxegjefuhanfmejh.supabase.co/storage/v1/object/public/imagenes/DJI/dji%20osmo%205.webp"
        ];
        ?>
        const IMAGENES = <?= json_encode($supabaseImages) ?>;
        const SWATCHES = ["#111111","#374151","#9ca3af"];
        const REVIEWS_LIST = [{"author":"S***h","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"La estabilización mecánica en 3 ejes y la calidad nocturna del sensor de 1 pulgada superan cualquier expectativa. Para vlogs y viajes es insuperable.","date":"2026.04.12"},{"author":"s***m","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"El micrófono inalámbrico DJI Mic 2 se empareja de inmediato y el audio es súper profesional. Llegó rapidísimo en Bogotá.","date":"2026.05.02"},{"author":"j***5","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Very nice, la rotación de pantalla horizontal a vertical enciende la cámara en 1 segundo. Seguimiento ActiveTrack 6.0 perfecto.","date":"2026.05.18"},{"author":"T***m","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Pagué contraentrega cuando lo recibí en mi casa. Empaque 100% sellado y original con garantía directa.","date":"2026.06.01"},{"author":"B***i","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Ultra portátil, cabe en el bolsillo de la chaqueta y graba en D-Log M de 10 bits con colores cinematográficos. DJI nunca decepciona.","date":"2026.06.14"},{"author":"A***r","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Increíble rendimiento con poca luz. Los colores se ven vivos y naturales sin necesidad de edición pesada.","date":"2026.06.20"},{"author":"K***y","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"El mango con batería extra duplica la duración. Hice un viaje completo de fin de semana sin preocuparme por cargador.","date":"2026.06.28"},{"author":"M***o","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"El modo vertical nativo para TikTok e Instagram Reels ahorra horas de edición. 10 de 10.","date":"2026.07.05"},{"author":"F***e","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Envío seguro y atención impecable por WhatsApp. Producto 100% original.","date":"2026.07.12"},{"author":"L***a","color":"Creator Combo","size":"Kit Completo 6 en 1","stars":"★★★★★","comment":"Excelente producto, la calidad de construcción en aleación y el tacto del joystick son de gama premium.","date":"2026.07.19"}];
        const PRECIO_UNITARIO = 1850000;
        const PRODUCTO_TITULO = "DJI Osmo Pocket 3 Creator Combo | Cámara Gimbal 4K 120fps Sensor 1\"";
        const LANDING_TOKEN = "<?= $landing_token ?>";
        const LANDING_SLUG = "dji-osmo-pocket-3";
        const CHECKOUT_URL = "<?= URL_PASARELA_CHECKOUT ?>/checkout.php?token=" + LANDING_TOKEN;
        const ES_MODO_EDICION = <?= $es_modo_edicion ? 'true' : 'false' ?>;

        let activeImgIndex = 0;
        let lightboxIndex = 0;
        let currentReviewPage = 1;
        const REVIEWS_PER_PAGE = 5;
        let cartState = { qty: 0, hasAdded: false, variant: "Creator Combo", size: "Kit Completo 6 en 1" };

        function initGallery() {
            const mainImg = document.getElementById('mainImage');
            const dotsContainer = document.getElementById('galleryDotsIndicator');
            if (dotsContainer) dotsContainer.innerHTML = '';
            if (IMAGENES.length > 0 && mainImg) mainImg.src = IMAGENES[0];
            if (dotsContainer) {
                IMAGENES.forEach((src, idx) => {
                    const dot = document.createElement('div');
                    dot.className = 'gallery-dot' + (idx === 0 ? ' active' : '');
                    dot.onclick = () => seleccionarImagen(idx);
                    dot.setAttribute('title', `Imagen ${idx + 1}`);
                    dotsContainer.appendChild(dot);
                });
            }
        }

        function seleccionarImagen(idx) {
            if (idx < 0 || idx >= IMAGENES.length) return;
            activeImgIndex = idx;
            const mainImg = document.getElementById('mainImage');
            if (mainImg) {
                mainImg.style.opacity = '0.35';
                mainImg.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    mainImg.src = IMAGENES[idx];
                    mainImg.style.opacity = '1';
                    mainImg.style.transform = 'scale(1)';
                }, 120);
            }
            document.querySelectorAll('.gallery-dot').forEach((el, i) => el.classList.toggle('active', i === idx));
        }

        function cambiarImagenRelativa(step) {
            let next = (activeImgIndex + step + IMAGENES.length) % IMAGENES.length;
            seleccionarImagen(next);
        }

        function abrirLightbox(idx) {
            if (ES_MODO_EDICION) return;
            lightboxIndex = (idx !== undefined) ? idx : activeImgIndex;
            const modal = document.getElementById('imageLightbox');
            const img = document.getElementById('lightboxImage');
            const thumbsContainer = document.getElementById('lightboxThumbs');
            if (img) {
                img.classList.remove('zoomed');
                img.style.transformOrigin = 'center center';
                if (IMAGENES[lightboxIndex]) img.src = IMAGENES[lightboxIndex];
            }
            if (thumbsContainer) {
                thumbsContainer.innerHTML = '';
                IMAGENES.forEach((src, i) => {
                    const t = document.createElement('div');
                    t.className = 'lightbox-thumb' + (i === lightboxIndex ? ' active' : '');
                    t.onclick = () => setLightboxImage(i);
                    t.innerHTML = `<img src="${src}">`;
                    thumbsContainer.appendChild(t);
                });
            }
            if (modal) modal.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function setLightboxImage(idx) {
            lightboxIndex = idx;
            const img = document.getElementById('lightboxImage');
            if (img) {
                img.classList.remove('zoomed');
                img.style.transformOrigin = 'center center';
                if (IMAGENES[idx]) img.src = IMAGENES[idx];
            }
            document.querySelectorAll('.lightbox-thumb').forEach((el, i) => el.classList.toggle('active', i === idx));
        }

        function cambiarImagenLightbox(delta) {
            let next = (lightboxIndex + delta + IMAGENES.length) % IMAGENES.length;
            setLightboxImage(next);
        }

        function toggleLightboxZoom(e) {
            if (!window.matchMedia('(min-width: 1025px) and (hover: hover)').matches) return;
            const img = document.getElementById('lightboxImage');
            if (!img) return;
            img.classList.toggle('zoomed');
            if (img.classList.contains('zoomed')) {
                actualizarPosicionZoom(e, img);
            } else {
                img.style.transformOrigin = 'center center';
            }
        }

        function actualizarPosicionZoom(e, img) {
            if (!img || !img.classList.contains('zoomed')) return;
            const rect = img.getBoundingClientRect();
            const x = Math.max(0, Math.min(100, ((e.clientX - rect.left) / rect.width) * 100));
            const y = Math.max(0, Math.min(100, ((e.clientY - rect.top) / rect.height) * 100));
            img.style.transformOrigin = `${x}% ${y}%`;
        }

        function cerrarLightbox() {
            const modal = document.getElementById('imageLightbox');
            const img = document.getElementById('lightboxImage');
            if (img) img.classList.remove('zoomed');
            if (modal) modal.classList.remove('open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', (e) => {
            const modal = document.getElementById('imageLightbox');
            if (modal && modal.classList.contains('open')) {
                if (e.key === 'Escape') cerrarLightbox();
                if (e.key === 'ArrowLeft') cambiarImagenLightbox(-1);
                if (e.key === 'ArrowRight') cambiarImagenLightbox(1);
            }
        });

        function initSwatches() {
            const container = document.getElementById('swatchesContainer');
            if (!container) return;
            container.innerHTML = '';
            SWATCHES.forEach((colorHex, idx) => {
                const swatch = document.createElement('div');
                swatch.className = 'swatch-circle' + (idx === 0 ? ' active' : '');
                swatch.style.background = colorHex;
                swatch.onclick = () => {
                    document.querySelectorAll('.swatch-circle').forEach(s => s.classList.remove('active'));
                    swatch.classList.add('active');
                };
                container.appendChild(swatch);
            });
        }

        function toggleAccordion(btn) {
            const body = btn.nextElementSibling;
            if (body) {
                body.classList.toggle('open');
                const arrow = btn.querySelector('span:last-child');
                if (arrow) arrow.textContent = body.classList.contains('open') ? '▾' : '▸';
            }
        }

                                const CART_STORAGE_KEY = 'tridente_global_cart';
        let globalCart = [];

        function cargarCarritoStorage() {
            try {
                const saved = localStorage.getItem(CART_STORAGE_KEY);
                if (saved) {
                    const parsed = JSON.parse(saved);
                    if (Array.isArray(parsed)) {
                        globalCart = parsed.filter(item => item && item.qty > 0).map(item => {
                            let itemImg = item.image || '';
                            if (itemImg && !itemImg.startsWith('http://') && !itemImg.startsWith('https://') && !itemImg.startsWith('/')) {
                                itemImg = window.location.origin + '/' + itemImg.replace(/^\.\//, '');
                            }
                            let itemToken = (typeof LANDING_SLUG !== 'undefined' && item.slug === LANDING_SLUG && typeof LANDING_TOKEN !== 'undefined') ? LANDING_TOKEN : (item.token || LANDING_TOKEN);
                            return {
                                token: itemToken,
                                slug: item.slug || '',
                                title: item.title || 'Producto',
                                price: Number(item.price) || 0,
                                image: itemImg,
                                variant: item.variant || '',
                                size: item.size || '',
                                qty: Math.min(10, Math.max(1, Number(item.qty) || 1))
                            };
                        });
                        return;
                    }
                }
            } catch (e) {}
            globalCart = [];
        }

        function guardarCarritoEnStorage() {
            try {
                localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(globalCart));
            } catch (e) {}
        }

        function obtenerItemActual() {
            return globalCart.find(i => i.token === LANDING_TOKEN);
        }

        function toggleCart() {
            if (ES_MODO_EDICION) return;
            const overlay = document.getElementById('cartOverlay');
            if (!overlay) return;
            const isOpen = overlay.classList.toggle('open');
            document.body.style.overflow = isOpen ? 'hidden' : '';
            renderCart();
        }

        function animarVueloAlCarrito(btn, callback) {
            const cartTrigger = document.querySelector('.cart-trigger');
            const mainImg = document.getElementById('mainImage');
            let imgSrc = mainImg ? mainImg.src : ((typeof IMAGENES !== 'undefined' && IMAGENES.length > 0) ? IMAGENES[0] : 'producto.png');
            try { imgSrc = new URL(imgSrc, window.location.href).href; } catch(e) {}

            const activeBtn = btn || document.querySelector('.btn-add-desktop') || document.getElementById('btnAddToCart');
            const origBtnHtml = activeBtn ? activeBtn.innerHTML : '';

            if (activeBtn) {
                activeBtn.style.transition = 'all 0.2s ease';
                activeBtn.style.transform = 'scale(0.97)';
                activeBtn.innerHTML = `
                    <div style="display:flex; align-items:center; justify-content:center; width:100%; height:100%; overflow:hidden;">
                        <dotlottie-player src="https://lottie.host/b86261fc-a05c-4c50-a871-4f9ed870ec53/OwNQtMEoZd.lottie" background="transparent" speed="1.2" style="width:48px; height:48px;" autoplay></dotlottie-player>
                    </div>
                `;
                setTimeout(() => { if (activeBtn) activeBtn.style.transform = 'scale(1)'; }, 180);
            }

            const btnRect = activeBtn ? activeBtn.getBoundingClientRect() : { left: window.innerWidth / 2, top: window.innerHeight / 2, width: 60, height: 60 };
            const startX = btnRect.left + (btnRect.width / 2) - 35;
            const startY = btnRect.top + (btnRect.height / 2) - 35;

            const flyWrap = document.createElement('div');
            flyWrap.style.position = 'fixed';
            flyWrap.style.left = '0';
            flyWrap.style.top = '0';
            flyWrap.style.zIndex = '999999';
            flyWrap.style.pointerEvents = 'none';
            flyWrap.style.transform = `translate3d(${startX}px, ${startY}px, 0) scale(0.6)`;
            flyWrap.style.opacity = '0';
            flyWrap.style.transition = 'transform 0.85s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.25s ease';

            const flyImg = document.createElement('img');
            flyImg.src = imgSrc;
            flyImg.style.width = '70px';
            flyImg.style.height = '70px';
            flyImg.style.borderRadius = '16px';
            flyImg.style.objectFit = 'cover';
            flyImg.style.border = '2.5px solid #ffffff';
            flyImg.style.boxShadow = '0 16px 40px rgba(0, 0, 0, 0.35)';
            flyImg.style.transition = 'transform 0.85s cubic-bezier(0.4, 0, 0.2, 1), border-radius 0.85s ease, opacity 0.85s ease';
            flyImg.style.transformOrigin = 'center center';

            flyWrap.appendChild(flyImg);
            document.body.appendChild(flyWrap);

            setTimeout(() => {
                flyWrap.style.opacity = '1';
                flyWrap.style.transform = `translate3d(${startX}px, ${startY}px, 0) scale(1)`;

                requestAnimationFrame(() => {
                    const cartRect = cartTrigger ? cartTrigger.getBoundingClientRect() : { left: window.innerWidth - 60, top: 20, width: 40, height: 40 };
                    const destX = cartRect.left + (cartRect.width / 2) - 18;
                    const destY = cartRect.top + (cartRect.height / 2) - 18;

                    flyWrap.style.transform = `translate3d(${destX}px, ${destY}px, 0) scale(0.45)`;
                    flyImg.style.borderRadius = '50%';
                    flyImg.style.transform = 'rotate(18deg)';
                    flyImg.style.opacity = '0.35';
                });
            }, 300);

            setTimeout(() => {
                if (flyWrap.parentNode) flyWrap.parentNode.removeChild(flyWrap);

                if (cartTrigger) {
                    const ripple = document.createElement('div');
                    ripple.className = 'cart-ripple-effect';
                    cartTrigger.appendChild(ripple);
                    setTimeout(() => { if (ripple.parentNode) ripple.parentNode.removeChild(ripple); }, 650);

                    cartTrigger.classList.add('cart-pop-active');
                    setTimeout(() => { cartTrigger.classList.remove('cart-pop-active'); }, 450);
                }

                if (activeBtn) {
                    activeBtn.innerHTML = origBtnHtml;
                }

                if (callback) callback();
            }, 1100);
        }

        function agregarAlCarrito(e) {
            if (ES_MODO_EDICION) return;
            let clickedBtn = null;
            if (e) {
                clickedBtn = e.currentTarget || (e.target ? e.target.closest('button') : null);
            }
            if (!clickedBtn) {
                clickedBtn = document.querySelector('.btn-add-desktop') || document.getElementById('btnAddToCart');
            }

            const mainImg = document.getElementById('mainImage');
            let imgSrc = mainImg ? mainImg.src : ((typeof IMAGENES !== 'undefined' && IMAGENES.length > 0) ? IMAGENES[0] : 'producto.png');
            try { imgSrc = new URL(imgSrc, window.location.href).href; } catch(e) {}

            const prodTitulo = (typeof PRODUCTO_TITULO !== 'undefined') ? PRODUCTO_TITULO : 'Producto';
            const precioUnit = (typeof PRECIO_UNITARIO !== 'undefined') ? PRECIO_UNITARIO : 0;
            const variantVal = (typeof cartState !== 'undefined' && cartState.variant) ? cartState.variant : 'Estándar';
            const sizeVal = (typeof cartState !== 'undefined' && cartState.size) ? cartState.size : 'Único';

            let existingIndex = globalCart.findIndex(i => i.token === LANDING_TOKEN);
            if (existingIndex !== -1) {
                if (globalCart[existingIndex].qty < 10) {
                    globalCart[existingIndex].qty += 1;
                } else {
                    globalCart[existingIndex].qty = 10;
                }
                globalCart[existingIndex].image = imgSrc; // Asegurar miniatura absoluta
                globalCart[existingIndex].variant = variantVal;
                globalCart[existingIndex].size = sizeVal;
            } else {
                globalCart.push({
                    token: LANDING_TOKEN,
                    slug: typeof LANDING_SLUG !== 'undefined' ? LANDING_SLUG : '',
                    title: prodTitulo,
                    price: precioUnit,
                    image: imgSrc,
                    variant: variantVal,
                    size: sizeVal,
                    qty: 1
                });
            }

            guardarCarritoEnStorage();
            actualizarControlesPagina();

            animarVueloAlCarrito(clickedBtn, () => {
                renderCart();
                const overlay = document.getElementById('cartOverlay');
                if (overlay && !overlay.classList.contains('open')) {
                    overlay.classList.add('open');
                    document.body.style.overflow = 'hidden';
                }
            });
        }

        function cambiarCantidadItem(token, delta) {
            let idx = globalCart.findIndex(i => i.token === token);
            if (idx !== -1) {
                let newQty = globalCart[idx].qty + delta;
                if (newQty > 10) newQty = 10;
                if (newQty <= 0) {
                    globalCart.splice(idx, 1);
                } else {
                    globalCart[idx].qty = newQty;
                }
            }
            guardarCarritoEnStorage();
            actualizarControlesPagina();
            renderCart();
        }

        function cambiarCantidad(delta) {
            cambiarCantidadItem(LANDING_TOKEN, delta);
        }

        function actualizarControlesPagina() {
            const currentItem = obtenerItemActual();
            const currentQty = currentItem ? currentItem.qty : 0;

            const desktopQty = document.getElementById('qtyDesktopDisplay');
            if (desktopQty) desktopQty.textContent = Math.max(1, currentQty);

            const mobileBtn = document.getElementById('btnAddToCart');
            if (mobileBtn) {
                mobileBtn.textContent = 'Add to Cart - ' + formatMoney((currentQty > 0 ? currentQty : 1) * PRECIO_UNITARIO);
            }
            const desktopBtn = document.querySelector('.btn-add-desktop');
            if (desktopBtn) {
                desktopBtn.textContent = 'Add to Cart - ' + formatMoney((currentQty > 0 ? currentQty : 1) * PRECIO_UNITARIO);
            }
        }

        function formatMoney(num) {
            return '$ ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function renderCart() {
            const container = document.getElementById('cartItemsContainer');
            const totalUnits = globalCart.reduce((sum, item) => sum + (item.qty || 0), 0);
            const subtotalMoney = globalCart.reduce((sum, item) => sum + ((item.price || 0) * (item.qty || 0)), 0);
            const fmtTotal = formatMoney(subtotalMoney);

            const badge = document.getElementById('cartBadge');
            if (badge) {
                badge.textContent = totalUnits;
                badge.style.display = totalUnits > 0 ? 'flex' : 'none';
            }
            const drawerTitle = document.getElementById('cartDrawerTitle');
            if (drawerTitle) drawerTitle.textContent = `Tu Carrito (${totalUnits})`;
            const subtotalEl = document.getElementById('cartSubtotal');
            if (subtotalEl) subtotalEl.textContent = fmtTotal;
            const totalEl = document.getElementById('cartTotal');
            if (totalEl) totalEl.textContent = fmtTotal;

            const checkoutBtn = document.querySelector('.btn-checkout');
            if (checkoutBtn) {
                if (globalCart.length === 0 || totalUnits <= 0) {
                    checkoutBtn.style.opacity = '0.45';
                    checkoutBtn.style.pointerEvents = 'none';
                    checkoutBtn.innerHTML = `<span>Carrito Vacío</span>`;
                } else {
                    checkoutBtn.style.opacity = '1';
                    checkoutBtn.style.pointerEvents = 'auto';
                    checkoutBtn.innerHTML = `
                        <span>Finalizar Compra Segura</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    `;
                }
            }

            if (container) {
                if (globalCart.length === 0 || totalUnits <= 0) {
                    container.innerHTML = `
                        <div style="text-align: center; padding: 48px 20px; color: var(--text-muted);">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto 12px auto; display: block; opacity: 0.4;">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                            <p style="font-size: 15px; font-weight: 700; margin: 0 0 6px 0; color: var(--text-main);">Tu carrito está vacío</p>
                            <p style="font-size: 13px; margin: 0;">Agrega productos para continuar con tu compra.</p>
                        </div>
                    `;
                } else {
                    container.innerHTML = globalCart.map(item => `
                        <div class="cart-item" data-token="${item.token}">
                            <img src="${item.image}" class="cart-item-img" alt="${item.title}">
                            <div class="cart-item-info">
                                <div>
                                    <div class="cart-item-title">${item.title}</div>
                                    <div class="cart-item-variant">Variante: ${item.variant} | ${item.size}</div>
                                </div>
                                <div class="cart-item-bottom">
                                    <div class="cart-item-price">${formatMoney(item.price)}</div>
                                    <div class="qty-controls">
                                        <button class="qty-btn" onclick="cambiarCantidadItem('${item.token}', -1)">-</button>
                                        <span class="qty-value">${item.qty}</span>
                                        <button class="qty-btn" onclick="cambiarCantidadItem('${item.token}', 1)" ${item.qty >= 10 ? 'style="opacity:0.4;cursor:not-allowed;"' : ''}>+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).join('');
                }
            }
        }

        function procederAlCheckout() {
            if (!globalCart || globalCart.length === 0) return;
            const loader = document.getElementById('landing-loader');
            if (loader) loader.style.display = 'flex';
            
            const primaryItem = globalCart.find(i => i.token === LANDING_TOKEN) || globalCart[0];
            const tokensList = globalCart.map(i => `${i.token}:${i.qty}`).join(',');
            
            const targetUrl = CHECKOUT_URL + '&qty=' + primaryItem.qty + '&cart_tokens=' + encodeURIComponent(tokensList);
            setTimeout(() => { window.location.href = targetUrl; }, 350);
        }

        function renderReviews() {
            const container = document.getElementById('reviewsListContainer');
            const paginationContainer = document.getElementById('reviewsPaginationContainer');
            if (!container || !REVIEWS_LIST || REVIEWS_LIST.length === 0) return;

            const filterColor = document.getElementById('filterColor') ? document.getElementById('filterColor').value : 'All';
            const filterRating = document.getElementById('filterRating') ? document.getElementById('filterRating').value : 'All';
            const sortBy = document.getElementById('filterSort') ? document.getElementById('filterSort').value : 'Default';

            let filtered = [...REVIEWS_LIST];

            if (filterColor !== 'All') {
                filtered = filtered.filter(r => r.color === filterColor);
            }
            if (filterRating !== 'All') {
                filtered = filtered.filter(r => r.stars.length === parseInt(filterRating));
            }
            if (sortBy === 'Most Recent') {
                filtered.sort((a, b) => b.date.localeCompare(a.date));
            }

            const totalPages = Math.max(1, Math.ceil(filtered.length / REVIEWS_PER_PAGE));
            if (currentReviewPage > totalPages) currentReviewPage = 1;

            const startIdx = (currentReviewPage - 1) * REVIEWS_PER_PAGE;
            const pageItems = filtered.slice(startIdx, startIdx + REVIEWS_PER_PAGE);

            container.innerHTML = '';
            pageItems.forEach(r => {
                const item = document.createElement('div');
                item.className = 'review-card-item';
                item.innerHTML = `
                    <div class="reviewer-col">
                        <span class="reviewer-name" data-editable="true">${r.author}</span>
                        <span class="reviewer-meta" data-editable="true">Color: ${r.color}</span>
                        ${r.size ? `<span class="reviewer-meta" data-editable="true">Size: ${r.size}</span>` : ''}
                    </div>
                    <div class="review-content-col">
                        <div class="review-stars-row">${r.stars}</div>
                        <p class="review-comment-text" data-editable="true">${r.comment}</p>
                    </div>
                    <div class="review-date-badge" data-editable="true">${r.date}</div>
                `;
                container.appendChild(item);
            });

            if (paginationContainer) {
                let pagesHtml = `<span>Total <b>${totalPages}</b> Pages</span>`;
                pagesHtml += `<button class="page-btn" onclick="cambiarPaginaReviews(${currentReviewPage - 1}, ${totalPages})" ${currentReviewPage === 1 ? 'disabled style="opacity:0.35;cursor:not-allowed;"' : ''}>&lt;</button>`;
                
                for (let i = 1; i <= totalPages; i++) {
                    pagesHtml += `<button class="page-btn ${i === currentReviewPage ? 'active' : ''}" onclick="cambiarPaginaReviews(${i}, ${totalPages})">${i}</button>`;
                }

                pagesHtml += `<button class="page-btn" onclick="cambiarPaginaReviews(${currentReviewPage + 1}, ${totalPages})" ${currentReviewPage === totalPages ? 'disabled style="opacity:0.35;cursor:not-allowed;"' : ''}>&gt;</button>`;
                paginationContainer.innerHTML = pagesHtml;
            }

            initModoEdicion();
        }

        function cambiarPaginaReviews(nuevaPagina, totalPages) {
            if (nuevaPagina < 1 || nuevaPagina > totalPages) return;
            currentReviewPage = nuevaPagina;
            renderReviews();
            const section = document.getElementById('customerReviewsSection');
            if (section) {
                section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        function initModoEdicion() {
            if (!ES_MODO_EDICION) return;
            document.querySelectorAll('[data-editable="true"]').forEach(el => {
                el.addEventListener('dblclick', function(e) {
                    e.stopPropagation();
                    this.contentEditable = "true";
                    this.focus();
                });
                el.addEventListener('blur', function() { this.contentEditable = "false"; });
            });
        }

        async function guardarCambiosVisuales() {
            const btn = document.querySelector('.btn-editor-save');
            if (btn) {
                btn.innerHTML = '⏳ Guardando...';
                btn.disabled = true;
            }

            const docClone = document.documentElement.cloneNode(true);
            const tb = docClone.querySelector('#editorToolbar');
            if (tb) tb.remove();

            const bodyEl = docClone.querySelector('body');
            if (bodyEl) {
                bodyEl.classList.remove('modo-edicion-activo');
                bodyEl.style.marginTop = '';
            }

            const htmlToSave = '<!DOCTYPE html>' + docClone.outerHTML;

            const formData = new FormData();
            formData.append('slug', LANDING_SLUG);
            formData.append('html_content', htmlToSave);

            try {
                const res = await fetch('../../guardar_visual.php', { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) { alert('✅ ' + data.message); }
                else { alert('❌ Error: ' + data.message); }
            } catch (err) { alert('❌ Error de conexión al guardar los cambios'); }

            if (btn) {
                btn.innerHTML = '💾 Guardar Cambios';
                btn.disabled = false;
            }
        }

        // ─── CONTADOR DE ENVÍO URGENTE PERSISTENTE EN LOCALSTORAGE ───
        function initShippingCountdown() {
            const STORAGE_KEY = 'dji_shipping_countdown_deadline_v1';
            let deadline = localStorage.getItem(STORAGE_KEY);
            const now = Date.now();

            // Si no existe o ya venció, establecer 20 horas y 40 minutos en el futuro
            if (!deadline || isNaN(parseInt(deadline, 10)) || parseInt(deadline, 10) <= now) {
                const duracionMs = (20 * 3600 + 40 * 60) * 1000;
                deadline = now + duracionMs;
                localStorage.setItem(STORAGE_KEY, deadline.toString());
            } else {
                deadline = parseInt(deadline, 10);
            }

            function actualizarDisplay() {
                const actual = Date.now();
                let restante = deadline - actual;

                if (restante <= 0) {
                    const duracionMs = (20 * 3600 + 40 * 60) * 1000;
                    deadline = actual + duracionMs;
                    localStorage.setItem(STORAGE_KEY, deadline.toString());
                    restante = deadline - actual;
                }

                const h = Math.floor(restante / (1000 * 60 * 60));
                const m = Math.floor((restante % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((restante % (1000 * 60)) / 1000);

                const el = document.getElementById('shippingCountdown');
                if (el) {
                    el.textContent = `${h} h ${m < 10 ? '0' + m : m} min ${s < 10 ? '0' + s : s} s`;
                }
            }

            actualizarDisplay();
            setInterval(actualizarDisplay, 1000);
        }

        // ─── SLIDER Y PUNTICOS PARA 'QUIENES VIERON ESTE PRODUCTO TAMBIÉN COMPRARON' ───
        function initRecommendedProductsSlider() {
            const track = document.getElementById('recommendedProductsTrack');
            const dotsContainer = document.getElementById('recommendedProductsDots');
            if (!track || !dotsContainer) return;

            const cards = track.querySelectorAll('.more-card');
            if (cards.length === 0) return;

            dotsContainer.innerHTML = '';
            cards.forEach((card, idx) => {
                const dot = document.createElement('div');
                dot.className = 'more-prod-dot' + (idx === 0 ? ' active' : '');
                dot.setAttribute('title', `Producto ${idx + 1}`);
                dot.onclick = () => {
                    card.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                };
                dotsContainer.appendChild(dot);
            });

            track.addEventListener('scroll', () => {
                const scrollLeft = track.scrollLeft;
                const cardWidth = cards[0].offsetWidth + 16;
                const activeIdx = Math.min(cards.length - 1, Math.max(0, Math.round(scrollLeft / cardWidth)));
                dotsContainer.querySelectorAll('.more-prod-dot').forEach((dot, i) => {
                    dot.classList.toggle('active', i === activeIdx);
                });
            }, { passive: true });
        }

        function slideRecommendedProducts(delta) {
            const track = document.getElementById('recommendedProductsTrack');
            if (!track) return;
            const card = track.querySelector('.more-card');
            const scrollAmount = card ? (card.offsetWidth + 16) * 1.5 : 300;
            track.scrollBy({ left: delta * scrollAmount, behavior: 'smooth' });
        }

        // ─── SCROLL DINÁMICO: OCULTAR/MOSTRAR NAVBAR Y STICKY ADD TO CART ───
        (function() {
            let lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
            let ticking = false;

            function handleScrollDirection() {
                const currentScrollY = window.pageYOffset || document.documentElement.scrollTop;
                const navbar = document.querySelector('.navbar');
                const stickyBar = document.querySelector('.sticky-footer-bar');

                if (Math.abs(currentScrollY - lastScrollY) < 6) {
                    ticking = false;
                    return;
                }

                if (currentScrollY > lastScrollY && currentScrollY > 70) {
                    // Scrolling Down -> Ocultar navbar y boton sticky
                    if (navbar) navbar.classList.add('nav-hidden');
                    if (stickyBar) stickyBar.classList.add('bar-hidden');
                } else {
                    // Scrolling Up -> Mostrar navbar y boton sticky
                    if (navbar) navbar.classList.remove('nav-hidden');
                    if (stickyBar) stickyBar.classList.remove('bar-hidden');
                }

                lastScrollY = Math.max(0, currentScrollY);
                ticking = false;
            }

            window.addEventListener('scroll', function() {
                if (!ticking) {
                    window.requestAnimationFrame(handleScrollDirection);
                    ticking = true;
                }
            }, { passive: true });
        })();

        document.addEventListener('DOMContentLoaded', () => {
            cargarCarritoStorage();
            actualizarControlesPagina();
            initGallery();
            initSwatches();
            renderCart();
            renderReviews();
            initModoEdicion();
            initShippingCountdown();
            initRecommendedProductsSlider();
        });
    
        // ─── GESTOS TÁCTILES (SWIPE) PARA MÓVIL EN GALERÍA Y LIGHTBOX ───
        (function() {
            function habilitarSwipe(elem, accionIzquierda, accionDerecha) {
                if (!elem) return;
                let startX = 0, startY = 0;
                elem.addEventListener('touchstart', function(e) {
                    if (e.touches && e.touches.length === 1) {
                        startX = e.touches[0].clientX;
                        startY = e.touches[0].clientY;
                    }
                }, { passive: true });
                elem.addEventListener('touchend', function(e) {
                    if (e.changedTouches && e.changedTouches.length === 1) {
                        let diffX = e.changedTouches[0].clientX - startX;
                        let diffY = e.changedTouches[0].clientY - startY;
                        if (Math.abs(diffX) > 35 && Math.abs(diffX) > Math.abs(diffY)) {
                            if (diffX < 0) {
                                accionIzquierda();
                            } else {
                                accionDerecha();
                            }
                        }
                    }
                }, { passive: true });
            }

            document.addEventListener('DOMContentLoaded', function() {
                const mainWrap = document.querySelector('.main-image-wrap');
                if (mainWrap) {
                    habilitarSwipe(mainWrap, () => cambiarImagenRelativa(1), () => cambiarImagenRelativa(-1));
                }

                const lbView = document.getElementById('imageLightbox');
                if (lbView) {
                    habilitarSwipe(lbView, () => cambiarImagenLightbox(1), () => cambiarImagenLightbox(-1));
                }
            });
        })();

        // ─── 5.2 FUNCIONES PARA REVIEWS CON VIDEO Y REPRODUCTOR YOUTUBE ───
        function extraerYouTubeId(url) {
            if (!url) return '';
            url = url.trim();
            const regExp = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=|shorts\/)|youtu\.be\/)([^"&?\/\s]{11})/;
            const match = url.match(regExp);
            if (match && match[1]) return match[1];
            if (url.length === 11 && !url.includes('/') && !url.includes('.')) return url;
            return url;
        }

        function abrirVideoModal(youtubeId) {
            const modal = document.getElementById('videoModalLightbox');
            const iframe = document.getElementById('videoModalIframe');
            if (!modal || !iframe || !youtubeId) return;
            iframe.src = 'https://www.youtube.com/embed/' + youtubeId + '?autoplay=1&rel=0&modestbranding=1&playsinline=1';
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function cerrarVideoModal(e) {
            if (e && e.target && e.target.classList && e.target.classList.contains('video-modal-container')) {
                return;
            }
            if (e) e.stopPropagation();
            const modal = document.getElementById('videoModalLightbox');
            const iframe = document.getElementById('videoModalIframe');
            if (!modal) return;
            modal.classList.remove('active');
            if (iframe) iframe.src = '';
            document.body.style.overflow = '';
        }

        function manejarClickVideoCard(card, event) {
            if (typeof ES_MODO_EDICION !== 'undefined' && ES_MODO_EDICION) {
                return;
            }
            const ytid = card.getAttribute('data-youtube-id');
            if (ytid) {
                abrirVideoModal(ytid);
            }
        }

        function desplazarVideoCarrusel(direccion) {
            const track = document.getElementById('videoReviewsTrack');
            if (track) {
                track.scrollBy({ left: direccion * 320, behavior: 'smooth' });
            }
        }

        function editarVideoCard(card) {
            if (!card) return;
            const currentId = card.getAttribute('data-youtube-id') || '';
            const currentDurElem = card.querySelector('.video-duration-text');
            const currentTitleElem = card.querySelector('.video-card-title-text');
            
            const currentDur = currentDurElem ? currentDurElem.innerText.trim() : '1:30';
            const currentTitle = currentTitleElem ? currentTitleElem.innerText.trim() : 'Review DJI Pocket 3';

            const newUrl = prompt('Ingresa el Link de YouTube o ID del video:\n(Ej: https://www.youtube.com/watch?v=... o https://youtu.be/... o https://youtube.com/shorts/...)', currentId ? 'https://www.youtube.com/watch?v=' + currentId : '');
            if (newUrl === null) return;
            
            const parsedId = extraerYouTubeId(newUrl);
            if (!parsedId) {
                alert('No se pudo reconocer un ID de YouTube válido.');
                return;
            }

            const newDur = prompt('Duración del video (ej. 1:45):', currentDur) || currentDur;
            const newTitle = prompt('Título o descripción corta:', currentTitle) || currentTitle;

            card.setAttribute('data-youtube-id', parsedId);
            const thumb = card.querySelector('.video-card-thumb');
            if (thumb) {
                thumb.src = 'https://i.ytimg.com/vi/' + parsedId + '/hqdefault.jpg';
                thumb.setAttribute('referrerpolicy', 'no-referrer');
            }
            if (currentDurElem) currentDurElem.innerText = newDur;
            if (currentTitleElem) currentTitleElem.innerText = newTitle;

            alert('✅ Video actualizado. Recuerda hacer clic en "💾 Guardar Cambios" para guardar.');
        }

        function eliminarVideoCard(card) {
            if (!card) return;
            if (confirm('¿Estás seguro de eliminar este video del carrusel?')) {
                card.remove();
            }
        }

        function agregarNuevoVideoReview() {
            const url = prompt('Ingresa el link de YouTube del nuevo video:\n(Ej: https://www.youtube.com/watch?v=... o https://youtu.be/...)');
            if (!url) return;
            const id = extraerYouTubeId(url);
            if (!id) {
                alert('Link de YouTube no válido.');
                return;
            }
            const dur = prompt('Duración del video (ej. 1:30):', '1:30') || '1:30';
            const title = prompt('Título / Resumen:', 'Opinión DJI Osmo Pocket 3') || 'Opinión DJI Osmo Pocket 3';

            const track = document.getElementById('videoReviewsTrack');
            if (!track) return;

            const card = document.createElement('div');
            card.className = 'video-review-card';
            card.setAttribute('data-youtube-id', id);
            card.setAttribute('onclick', 'manejarClickVideoCard(this, event)');
            card.innerHTML = `
                <img class="video-card-thumb" src="https://i.ytimg.com/vi/${id}/hqdefault.jpg" referrerpolicy="no-referrer" alt="Video Review" loading="lazy">
                <div class="video-card-gradient"></div>
                <div class="video-card-badge-play">▶</div>
                <div class="video-card-info">
                    <div class="video-card-stars">★★★★★</div>
                    <div class="video-card-duration">
                        <span class="play-icon-mini">▶</span> <span class="video-duration-text" data-editable="true">${dur}</span>
                    </div>
                    <div class="video-card-title-text" data-editable="true">${title}</div>
                </div>
                <div class="video-card-admin-bar" onclick="event.stopPropagation()">
                    <button type="button" class="btn-vcard-edit" onclick="editarVideoCard(this.closest('.video-review-card'))" title="Editar link de YouTube">✏️ Editar</button>
                    <button type="button" class="btn-vcard-del" onclick="eliminarVideoCard(this.closest('.video-review-card'))" title="Eliminar video">🗑️</button>
                </div>
            `;
            track.appendChild(card);
            if (typeof initModoEdicion === 'function') {
                initModoEdicion();
            }
            alert('✅ Video agregado al carrusel. Recuerda hacer clic en "💾 Guardar Cambios" para guardar permanentemente.');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarVideoModal();
            }
        });

        // ─── ACTUALIZACIÓN EN TIEMPO REAL AL PUBLICAR NUEVA VERSIÓN ───
        (function() {
            const CURRENT_VERSION = '<?= $app_version ?>';
            const CHECK_INTERVAL = 8000; // Chequear cada 8 segundos
            let isChecking = false;

            async function checkVersion() {
                if (isChecking) return;
                // No recargar automáticamente si el usuario está en modo de edición visual
                if (typeof ES_MODO_EDICION !== 'undefined' && ES_MODO_EDICION) return;

                isChecking = true;
                try {
                    const res = await fetch('version.php?t=' + Date.now(), { 
                        cache: 'no-store',
                        headers: { 'Cache-Control': 'no-cache', 'Pragma': 'no-cache' }
                    });
                    if (res.ok) {
                        const data = await res.json();
                        if (data && data.version && data.version !== CURRENT_VERSION) {
                            console.log('🔄 Nueva versión detectada en producción (' + data.version + '). Actualizando en tiempo real...');
                            window.location.reload();
                        }
                    }
                } catch (e) {
                    // Manejo silencioso en caso de micro-cortes de red
                } finally {
                    isChecking = false;
                }
            }

            // Chequeo periódico en segundo plano
            setInterval(checkVersion, CHECK_INTERVAL);

            // Chequeo instantáneo cuando el usuario vuelve a enfocar la pestaña
            document.addEventListener('visibilitychange', function() {
                if (document.visibilityState === 'visible') {
                    checkVersion();
                }
            });
            window.addEventListener('focus', checkVersion);
        })();

    </script>
</body>
</html>
